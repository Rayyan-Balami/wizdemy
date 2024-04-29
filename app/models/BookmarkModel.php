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

    public function getBookmarks($user_id)
    {

        return $this->select([
            'DISTINCT m.*',
            'u1.private',
            'u1.username',
            'u1.deleted_at as user_deleted_at',
            'u1.status as user_status',
            'u2.username as responded_to',
            'COUNT(DISTINCT l.like_id) as likes_count',
            'COUNT(DISTINCT c.comment_id) as comments_count',
            'COUNT(DISTINCT v.view_id) as views_count'
        ], 'b')
            ->leftJoin('study_materials as m', 'm.material_id = b.material_id')
            ->leftJoin('users as u1', 'u1.user_id = m.user_id')
            ->leftJoin('study_material_requests as r', 'r.request_id = m.request_id')
            ->leftJoin('users as u2', 'u2.user_id = r.user_id')
            ->leftJoin('likes as l', 'l.material_id = m.material_id')
            ->leftJoin('comments as c', 'c.material_id = m.material_id')
            ->leftJoin('views as v', 'v.material_id = m.material_id')
            ->leftJoin('follow_relation as fr', 'fr.following_id = m.user_id')
            ->where('b.user_id = :user_id
            AND m.status <> :status
            AND u1.status <> :status
            AND u1.deleted_at IS NULL')
            ->bind(['user_id' => $user_id, 'status' => 'suspend'])
            ->groupBy('m.material_id')
            ->getAll();

    }

}