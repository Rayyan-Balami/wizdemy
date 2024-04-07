<?php

class BookmarkModel extends Model
{
    public function __construct(string $table = 'bookmarks')
    {
        parent::__construct($table);
        $this->fillable = ['user_id', 'material_id'];
    }

    public function isBookmarked(int $userId, int $materialId): bool
    {
        $bookmark = $this->select()
            ->where('user_id = :user_id AND material_id = :material_id')
            ->bind(['user_id' => $userId, 'material_id' => $materialId])
            ->get();
        return $bookmark ? true : false;
    }

    public function bookmark(int $userId, int $materialId): bool
    {
        $bookmark = $this->insert([
            'user_id' => $userId,
            'material_id' => $materialId
        ])->execute();
        return $bookmark ? true : false;
    }
    public function unbookmark(int $userId, int $materialId): bool
    {
        $bookmark = $this->delete()
            ->where('user_id = :user_id AND material_id = :material_id')
            ->bind([
                'user_id' => $userId,
                'material_id' => $materialId
            ])
            ->execute();
        return $bookmark ? true : false;
    }

}