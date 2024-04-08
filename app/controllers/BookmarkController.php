<?php

class BookmarkController extends Controller
{
    public function __construct()
    {
        parent::__construct(new BookmarkModel());
    }
    public function index()
    {
        $user_id = Session::get('user')['user_id'];
        $bookmarks = $this->model->getBookmarks($user_id);
        View::render('bookmarks', ['bookmarks' => $bookmarks]);
    }
    public function bookmark($material_id)
    {
        $user_id = Session::get('user')['user_id'];
        $bookmark = $this->model->bookmark($user_id, $material_id);
    
        if ($bookmark) {
            $this->buildJsonResponse([
                'status' => 'success',
                'message' => 'Material bookmarkd successfully'
            ]);
        } else {

            $this->buildJsonResponse([
                'status' => 'error',
                'message' => 'Material already bookmarkd'
            ], 400);
        }
    }

    public function unbookmark($material_id)
    {
        $user_id = Session::get('user')['user_id'];
        $unbookmark = $this->model->unbookmark($user_id, $material_id);
        if ($unbookmark) {
            $this->buildJsonResponse([
                'status' => 'success',
                'message' => 'Material unbookmarkd successfully'
            ]);
        } else {
            $this->buildJsonResponse([
                'status' => 'error',
                'message' => 'Material already unbookmarkd'
            ], 400);
        }
    }
}