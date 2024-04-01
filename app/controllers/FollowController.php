<?php

class FollowController extends Controller
{
    public function __construct()
    {
        parent::__construct(new FollowRelationModel());
    }

    // api to follow a user
    public function follow($user_id = null)
    {
        $current_user = Session::get('user')['user_id'] ?? null;
        if (!$current_user || !$user_id) {
            $this->buildJsonResponse(
                [
                    'status' => 'error',
                    'message' => 'Unauthorized'
                ],
                401
            );
        }
        if ($current_user == $user_id) {
            $this->buildJsonResponse(
                [
                    'status' => 'error',
                    'message' => 'You cannot follow yourself'
                ],
                400
            );
        }
        $FollowRelationModel = new FollowRelationModel();
        $follow = $FollowRelationModel->follow($current_user, $user_id);
        if ($follow['status']) {
            $this->buildJsonResponse(
                [
                    'status' => 'success',
                    'message' => $follow['message']
                ],
                200
            );
        } else {
            $this->buildJsonResponse(
                [
                    'status' => 'error',
                    'message' => $follow['message']
                ],
                400
            );
        }
    }

    public function unfollow($user_id = null)
    {
        
        $current_user = Session::get('user')['user_id'] ?? null;
        if (!$current_user || !$user_id) {
            $this->buildJsonResponse(
                [
                    'status' => 'error',
                    'message' => 'Unauthorized'
                ],
                401
            );
        }
        $FollowRelationModel = new FollowRelationModel();
        $isFollowing = $FollowRelationModel->isFollowing($current_user, $user_id);
        if (!$isFollowing) {
            $this->buildJsonResponse(
                [
                    'status' => 'error',
                    'message' => 'You are not following this user'
                ],
                400
            );
        }
        $unfollow = $FollowRelationModel->unfollow($current_user, $user_id);
        if ($unfollow['status']) {
            $this->buildJsonResponse(
                [
                    'status' => 'success',
                    'message' => $unfollow['message']
                ],
                200
            );
        } else {
            $this->buildJsonResponse(
                [
                    'status' => 'error',
                    'message' => $unfollow['message']
                ],
                400
            );
        }
    }
}