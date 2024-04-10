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
            "c.*",
            "u.username",
        ], 'c')
        ->leftJoin('users u', 'c.user_id = u.user_id')
        ->where('material_id = :material_id')
        ->bind(['material_id' => $material_id])
        ->orderBy('c.created_at', 'DESC')
        ->limit(10)
        ->getAll();

    }

    public function addComment($material_id, $user_id, $comment)
    {

        return $this->insert([
                'material_id' => $material_id,
                'user_id' => $user_id,
                'comment' => $comment
            ])->execute();

        
    }

    public function deleteComment($comment_id)
    {
        return $this->delete()
            ->where('comment_id = :comment_id')
            ->bind(['comment_id' => $comment_id])
            ->execute();
    }
}