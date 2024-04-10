<?php
class HomeController extends Controller
{

  public function __construct()
  {
    parent::__construct(new MaterialViewModel());
  }

  //index (notes page)
  public function index()
  {
    $notes = $this->model->show();
    View::render('notes', ['notes' => $notes]);
  }

  //question page
  public function question()
  {
    $questions = $this->model->show('question');
    View::render('questions', ['questions' => $questions]);
  }

  //lab report page
  public function labreport()
  {
    $labreports = $this->model->show('labreport');
    View::render('labreports', ['labreports' => $labreports]);
  }

  //view page
  public function view($material_id = null)
  {
    $current_user = Session::get('user')['user_id'] ?? null;

    if (!$material_id) {
      $this->redirect('/');
      return;
    }
    //add view use cookie to prevent multiple views
    if (!isset($_COOKIE['viewed_material_' . $material_id])) {
      $ip_address = $_SERVER['REMOTE_ADDR'];
      $user_agent = $_SERVER['HTTP_USER_AGENT'];
      (new ViewModel)->addView($material_id, $current_user, $ip_address, $user_agent);
      setcookie('viewed_material_' . $material_id, true, time() + 60 * 60 * 24, '/');//24 hours
    }

    $material = $this->model->view($material_id);

    if (!$material || $material['status'] == 'suspend') {
      View::render('viewMaterial', ['material' => null]);
      return;
    }


    $isPrivate = $material['private'];
    $isOwnMaterial = $current_user == $material['user_id'];
    $isCurrentUserFollower = !$isOwnMaterial ? (new FollowRelationModel)->isFollowing($current_user, $material['user_id']) : false;
    


    //check like status
    $isLiked = (new LikeModel)->isLiked($current_user, $material_id);
    $isBookmarked = (new BookmarkModel)->isBookmarked($current_user, $material_id);
    $hasCommented = (new CommentModel)->hasCommented($material_id, $current_user)? true : false;
    
    $material['is_liked'] = $isLiked;
    $material['is_bookmarked'] = $isBookmarked;
    $material['has_commented'] = $hasCommented;

    $comments = (new CommentModel)->getComments($material_id);
    // dd($comments);
    //if its own material
    if ($isOwnMaterial) {
      View::render('viewMaterial', [
        'material' => $material,
        'isPrivate' => $isPrivate,
        'isCurrentUserFollower' => $isCurrentUserFollower,
        'isOwnMaterial' => $isOwnMaterial,
        'comments' => $comments
      ]);
      return;
    }



    //check if material is by private user and current user is not a follower
    if ($isPrivate && !$isCurrentUserFollower) {
      View::render('viewMaterial', [
        'material' => null,
        'isPrivate' => $isPrivate,
        'isCurrentUserFollower' => $isCurrentUserFollower,
        'isOwnMaterial' => $isOwnMaterial,
        'comments' => $comments
      ]);
      return;
    }

    View::render('viewMaterial', [
      'material' => $material,
      'isPrivate' => $isPrivate,
      'isCurrentUserFollower' => $isCurrentUserFollower,
      'isOwnMaterial' => $isOwnMaterial,
      'comments' => $comments
    ]);

  }

}

