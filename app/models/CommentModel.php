<?php

class CommentModel extends Model
{
    public function __construct(string $table = 'comments')
    {
        parent::__construct($table);
        $this->fillable = [
            'material_id',
            'user_id',
            'comment'
        ];
    }
    public function getComments($material_id)
    {
        return $this->select([
            'COUNT(c.comment_id) as no_of_comments',
            'c.*',
            'upv.username'
        ], 'c')
            ->leftJoin('user_profile_view as upv', 'upv.user_id = c.user_id')
            ->where('c.material_id = :material_id')
            ->bind(['material_id' => $material_id])
            ->getAll();
    }

    public function addComment($material_id, $user_id, $comment)
    {

        $result =$this->insert([
                'material_id' => $material_id,
                'user_id' => $user_id,
                'comment' => $comment
            ])->execute();

        return false;
    }

    public function deleteComment($comment_id)
    {
        return $this->delete()
            ->where('comment_id = :comment_id')
            ->bind(['comment_id' => $comment_id])
            ->execute();
    }
}