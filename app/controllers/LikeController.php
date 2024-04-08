<?php

class LikeController extends Controller
{
    public function __construct()
    {
        parent::__construct(new LikeModel());
    }
    public function index()
    {
        $user_id = Session::get('user')['user_id'];
        $likes = $this->model->getLikes($user_id);
        View::render('likes', ['likes' => $likes]);
    }

    public function like($material_id)
    {
        $user_id = Session::get('user')['user_id'];
        $like = $this->model->like($user_id, $material_id);

        if ($like) {
            $this->buildJsonResponse([
                'status' => 'success',
                'message' => 'Material liked successfully'
            ]);
        } else {

            $this->buildJsonResponse([
                'status' => 'error',
                'message' => 'Material already liked'
            ], 400);
        }
    }

    public function unlike($material_id)
    {
        $user_id = Session::get('user')['user_id'];
        $unlike = $this->model->unlike($user_id, $material_id);
        if ($unlike) {
            $this->buildJsonResponse([
                'status' => 'success',
                'message' => 'Material unliked successfully'
            ]);
        } else {
            $this->buildJsonResponse([
                'status' => 'error',
                'message' => 'Material already unliked'
            ], 400);
        }
    }
}