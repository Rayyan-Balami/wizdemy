<?php
class ProjectController extends Controller
{

  public function __construct()
  {
    parent::__construct('ProjectModel');
  }

  //project page
  public function index()
  {
      $projects = $this->model->show();

      for($i = 0; $i < count($projects); $i++) {
          $projects[$i]['repo_thumbnailUrl'] = $this->fetchRepoThumbnailLink($projects[$i]['repo_link']);
      }
  
      // Render the view with the updated projects
      View::render('projects', ['projects' => $projects]);
  }  

  //project create page
  public function create()
  {
    View::render('projectForm');
  }

  //project store
  public function store()
  {
    //verify github repo link
    $repoLink = $_POST['repo-link'];

    //match github repo link
    $pattern = '/^(https:\/\/github.com\/)([a-zA-Z0-9-]+)\/([a-zA-Z0-9-]+)$/';
    if (!preg_match($pattern, $repoLink)) {
      Session::flash('errors', ['repo-link' => 'Invalid Github repository link']);
      $this->redirect('/project/create');
    }

    //store project
    $userId = Session::get('user')['user_id'];
    $result = $this->model->store($userId, $repoLink);

    if ($result) {
      Session::flash('success', ['project' => 'Project added successfully']);
      $this->redirect('/project');
    } else {
      Session::flash('errors', ['project' => 'Failed to add project']);
      $this->redirect('/project/create');
    }
  }

  private function fetchRepoThumbnailLink($repoLink)
  {
    $html = file_get_contents($repoLink);

    // Extract the social thumbnail URL from the HTML
    preg_match('/<meta property="og:image" content="(.*?)"/', $html, $matches);
    $repo_thumbnailUrl = isset($matches[1]) ? $matches[1] : null;

    return $repo_thumbnailUrl;
  }
}