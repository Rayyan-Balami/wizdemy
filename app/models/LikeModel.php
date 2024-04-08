<?php

class LikeModel extends Model
{
    public function __construct(string $table = 'likes')
    {
        parent::__construct($table);
        $this->fillable = [
            'user_id',
            'material_id'
        ];
    }

    public function isLiked($user_id, $material_id)
    {
        $like = $this->select([
            'user_id',
            'material_id'
        ])
            ->where('user_id = :user_id AND material_id = :material_id')
            ->bind(['user_id' => $user_id, 'material_id' => $material_id])
            ->get();
        return $like ? true : false;
    }
    public function like($user_id, $material_id)
    {
        $like = $this->insert([
            'user_id' => $user_id,
            'material_id' => $material_id
        ])->execute();
        return $like;
    }

    public function unlike($user_id, $material_id)
    {
        $unlike = $this->delete()
            ->where('user_id = :user_id AND material_id = :material_id')
            ->bind(['user_id' => $user_id, 'material_id' => $material_id])
            ->execute() ;
        return $unlike;
    }
    public function getLikes($user_id)
    {
        return $this->select([
            'mv.*',
        ], 'l')
            ->leftJoin('material_view as mv', 'mv.material_id = l.material_id')
            ->where('l.user_id = :user_id')
            ->bind(['user_id' => $user_id])
            ->getAll();
    }
}