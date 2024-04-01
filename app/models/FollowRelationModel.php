<?php

class FollowRelationModel extends Model
{
    public function __construct(string $table = 'follow_relation')
    {
        parent::__construct($table);
        $this->fillable = ['follower_id', 'followed_id'];
    }

    public function isFollowing($current_user, $user_id)
    {
        return $this->select()
            ->where('following_id = :following_id AND follower_id = :follower_id')
            ->bind(['following_id' => $user_id, 'follower_id' => $current_user])
            ->get();
    }

    public function follow($current_user, $user_id)
    {
        //check if the user is already following
        $isFollowing = $this->isFollowing($current_user, $user_id);

        if ($isFollowing) {
            return [
                'status' => false,
                'message' => 'You are already following this user'
            ];
        }

        $result = $this->insert([
            'following_id' => $user_id,
            'follower_id' => $current_user
        ])->execute();

        if ($result) {
            return [
                'status' => true,
                'message' => 'You are now following this user'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Something went wrong'
            ];
        }
    }

    public function unfollow($current_user, $user_id)
    {
        //check if the user is already non-following
        $isFollowing = $this->isFollowing($current_user, $user_id);

        if (!$isFollowing) {
            return [
                'status' => false,
                'message' => 'You are not following this user'
            ];
        }

        $result = $this->delete()
            ->where('following_id = :following_id AND follower_id = :follower_id')
            ->bind(['following_id' => $user_id, 'follower_id' => $current_user])
            ->execute();

        if ($result) {
            return [
                'status' => true,
                'message' => 'You are no longer following this user'
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Something went wrong'
            ];
        }
    }
}