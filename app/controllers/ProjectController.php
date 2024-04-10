<?php
class ProjectController extends Controller
{

  public function __construct()
  {
    parent::__construct(new GithubProjectModel());
  }

  //project page
  public function index()
  {
    $projects = $this->model->show();

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
    $pattern = '/^(https:\/\/github.com\/)([a-zA-Z0-9-._]+)\/([a-zA-Z0-9-._]+)$/';
    if (!preg_match($pattern, $repoLink)) {
      Session::flash('errors', ['repo-link' => 'Invalid Github repository link']);
      Session::flash('old', ['repo-link' => $repoLink]);
      $this->redirect('/project/create');
    }



    $userId = Session::get('user')['user_id'];

    //check if project is already added by user
    $project = $this->model->isDuplicate($userId, $repoLink);
    if ($project) {
      Session::flash('errors', ['project' => Session::get('user')['username'] . ' this project already exists !!!']);
      $this->redirect('/project/create');
    }

    //validate github repo link is accessible
    if (!Validate::accessibleUrl($repoLink)) {
      Session::flash('errors', ['repo-link' => 'Github repository link is not accessible']);
      Session::flash('old', ['repo-link' => $repoLink]);
      $this->redirect('/project/create');
    }

    //store project
    $result = $this->model->store($userId, $repoLink);

    if ($result) {
      Session::flash('success', ['project' => 'Project added successfully']);
      $this->redirect('/project');
    } else {
      Session::flash('errors', ['project' => 'Failed to add project']);
      $this->redirect('/project/create');
    }
  }

  public function edit($project_id = null)
  {
    $project_id = $project_id ?? Session::get('post')['project_id'] ?? null;

    if (!$project_id) {
      Session::flash('error', ['message' => 'Invalid project']);
      $this->redirect('/project/create');
      return;
  }

  $projectDetails = $this->model->getProjectDetailById($project_id);
  if (!$projectDetails || $projectDetails['user_id'] != Session::get('user')['user_id']) {
      Session::flash('error', ['message' => 'Project not found']);
      $this->redirect('/project/create');
      return;
  }

    View::render('editProjectForm', ['projectDetails' => $projectDetails]);
  }
  public function update($project_id)
  {
    if ($project_id) {
      $projectDetails = $this->model->getProjectDetailById($project_id);
      if (!$projectDetails || $projectDetails['user_id'] != Session::get('user')['user_id']) {
        Session::flash('error', ['message' => 'Project not found']);
        $this->redirect('/project/create');
        return;
      }
    }

    $repoLink = $_POST['repo-link'];

    //match github repo link
    $pattern = '/^(https:\/\/github.com\/)([a-zA-Z0-9-._]+)\/([a-zA-Z0-9-._]+)$/';
    if (!preg_match($pattern, $repoLink)) {
      Session::flash('post', ['project_id' => $project_id]);
      Session::flash('errors', ['repo-link' => 'Invalid Github repository link']);
      Session::flash('old', ['repo-link' => $repoLink]);
      $this->redirect('/project/edit');
    }

    //validate github repo link is accessible
    if (!Validate::accessibleUrl($repoLink)) {
      Session::flash('post', ['project_id' => $project_id]);
      Session::flash('errors', ['repo-link' => 'Github repository link is not accessible']);
      Session::flash('old', ['repo-link' => $repoLink]);
      $this->redirect('/project/edit');
    }

    $result = $this->model->updateProject($project_id, $repoLink);

    if ($result) {
      Session::flash('success', ['project' => 'Project updated successfully']);
      $this->redirect('/project');
    } else {
      Session::flash('post', ['project_id' => $project_id]);
      Session::flash('errors', ['project' => 'Failed to update project']);
      $this->redirect('/project/edit');
    }

  }


  public function delete($project_id)
  {
    if (!$project_id) {
      $this->buildJsonResponse([
        'status' => false,
        'message' => 'Invalid project'
      ], 400);
    }
    // check if the project belongs to the user
    $project = $this->model->getProjectDetailById($project_id);
    if (!$project || $project['user_id'] != Session::get('user')['user_id']) {
      $this->buildJsonResponse([
        'status' => false,
        'message' => 'Invalid project'
      ], 400);
    }

    $result = $this->model->deleteProject($project_id);

    if ($result['status']) {
      $this->buildJsonResponse([
        'status' => true,
        'message' => $result['message']
      ]);
    } else {
      $this->buildJsonResponse([
        'status' => false,
        'message' => $result['message']
      ], 400);
    }
  }

  public function infiniteScroll()
  {
    $page = $_POST['page'] ?? 1;
    $projects = $this->model->show($page);

    $this->buildJsonResponse([
      'status' => true,
      'projects' => $projects
    ]);
  }

}