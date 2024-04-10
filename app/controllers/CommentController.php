<?php


class CommentController extends Controller
{
    public function __construct()
    {
        parent::__construct(new CommentModel());
    }

    public function getComments($material_id)
    {
        $comments = $this->model->getComments($material_id);
        return $comments;
    }

    public function addComment($material_id)
    {
        $user_id = Session::get('user')['user_id'];
        $comment = trim($_POST['comment']);

        $comment = $this->model->addComment($material_id, $user_id, $comment);
        if ($comment) {
            $this->buildJsonResponse([
                'status' => 'success',
                'message' => 'Comment added successfully'
            ]);
        } else {
            $this->buildJsonResponse('Failed to add comment', 400);
        }
    }

    public function deleteComment($comment_id)
    {
        $comment = $this->model->deleteComment($comment_id);
        if ($comment) {
            $this->buildJsonResponse([
                'status' => 'success',
                'message' => 'Comment deleted successfully'
            ]);
        } else {
            $this->buildJsonResponse('Failed to delete comment', 400);
        }
    }
}