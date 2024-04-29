<?php

class UserModel extends Model
{

    public function __construct(string $table = 'users')
    {
        parent::__construct($table);
        $this->fillable = [
            'full_name',
            'email',
            'username',
            'password',
            'private',
            'bio',
            'email',
            'user_type',
            'education_level',
            'enrolled_course',
            'school_name',
            'phone_number',
            'allow_email',
            'allow_phone',
            'status',
            'deleted_at'
        ];

    }

    public function login($email_username, $password)
    {
        $user = $this->select(['user_id', 'username', 'email', 'password', 'status'])
            ->where('(username = :username OR 
                    email = :email) AND 
                    deleted_at IS NULL')
            ->bind(['username' => $email_username, 'email' => $email_username])
            ->get();

        if ($user && password_verify($password, $user['password'])) {
            return [
                'status' => true,
                'user' => $user,
                'message' => $user['username'] . ' ' . SITE_NAME . ' welcomes you'
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Invalid username, email or password'
            ];
        }
    }

    public function signup($fullName, $email, $password)
    {

        // Check if email already exists
        $user = $this->select(['user_id'])
            ->where('email = :email')
            ->bind(['email' => $email])
            ->get();

        if ($user) {
            return [
                'status' => false,
                'message' => 'Email already exists | GO LOGIN'
            ];
        }


        $user = $this->insert([
            'full_name' => $fullName,
            'username' => substr($email, 0, strpos($email, '@')),
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT)
        ])->execute();

        if ($user) {
            return [
                'status' => true,
                'message' => substr($fullName, 0, strpos($fullName, ' ')) . ' registered successfully | GO LOGIN'
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Signup failed'
            ];
        }
    }


    public function userDetails($user_id)
    {
        return $this->select([
            'user_id',
            'full_name',
            'username',
            'email',
            'bio',
            'user_type',
            'education_level',
            'enrolled_course',
            'school_name',
            'phone_number',
            'created_at',
            'status'
        ])
            ->where('user_id = :user_id
                    AND deleted_at IS NULL')
            ->bind(['user_id' => $user_id])
            ->get();
    }

    public function usernameExists($userName)
    {
        return $this->select(['user_id'])
            ->where('username = :username')
            ->bind(['username' => $userName])
            ->get();
    }

    public function updateUserDetails($user_id, $data)
    {
        $result = $this->update($data)
            ->where('user_id = :user_id
                    AND deleted_at IS NULL')
            ->appendBindings(['user_id' => $user_id])
            ->execute();

        if ($result) {
            return [
                'status' => true,
                'message' => 'Profile updated successfully'
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Profile update failed'
            ];
        }
    }

    public function userPreferences($user_id)
    {
        return $this->select(['private', 'allow_email', 'allow_phone', 'phone_number'])
            ->where('user_id = :user_id
                    AND deleted_at IS NULL')
            ->bind(['user_id' => $user_id])
            ->get();
    }

    public function updatePassword($user_id, $currentPassword, $newPassword)
    {
        $password = $this->select(['password'])
            ->where('user_id = :user_id
                    AND deleted_at IS NULL')
            ->bind(['user_id' => $user_id])
            ->get();

        if (!password_verify($currentPassword, $password['password'])) {
            return [
                'status' => false,
                'message' => Session::get('user')['username'] . ' OOOPS! Current password is incorrect'
            ];
        }

        $result = $this->update(['password' => password_hash($newPassword, PASSWORD_BCRYPT)])
            ->where('user_id = :user_id
                    AND deleted_at IS NULL')
            ->appendBindings(['user_id' => $user_id])
            ->execute();

        if ($result) {
            return [
                'status' => true,
                'message' => Session::get('user')['username'] . ' Password updated successfully'
            ];
        } else {
            return [
                'status' => false,
                'message' => Session::get('user')['username'] . ' Password update failed'
            ];
        }

    }

    public function adminUpdatePassword($user_id, $newPassword)
    {
        $result = $this->update(['password' => password_hash($newPassword, PASSWORD_BCRYPT)])
            ->where('user_id = :user_id
                    AND deleted_at IS NULL')
            ->appendBindings(['user_id' => $user_id])
            ->execute();

        if ($result) {
            return [
                'status' => true,
                'message' => 'Password updated successfully'
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Password update failed'
            ];
        }
    }

    public function updatePreferences($user_id, $data)
    {
        //if aloow phone is set 1, then check if phone number is set in db
        if ($data['allow_phone'] == 1) {
            $phone = $this->select(['phone_number'])
                ->where('user_id = :user_id
                        AND deleted_at IS NULL')
                ->bind(['user_id' => $user_id])
                ->get();
            if ($phone['phone_number'] == null) {
                return [
                    'status' => false,
                    'message' => Session::get('user')['username'] . ' OOOPS! Phone number is not set'
                ];
            }
        }

        $result = $this->update($data)
            ->where('user_id = :user_id
                    AND deleted_at IS NULL')
            ->appendBindings(['user_id' => $user_id])
            ->execute();

        if ($result) {
            return [
                'status' => true,
                'message' => Session::get('user')['username'] . ' Preferences updated successfully'
            ];
        } else {
            return [
                'status' => false,
                'message' => Session::get('user')['username'] . ' Preferences update failed'
            ];
        }
    }


    public function updateStatus($user_id, $status)
    {
        $result = $this->update([
            'status' => $status
        ])
            ->where('user_id = :user_id
                    AND deleted_at IS NULL')
            ->appendBindings(['user_id' => $user_id])
            ->execute();
        if ($result) {
            return [
                'status' => true,
                'message' => 'User status changed successfully'
            ];
        } else {
            return [
                'status' => false,
                'message' => 'User status change failed'
            ];
        }
    }
    public function deleteUser($user_id)
    {
        // $result = $this->delete()
        //     ->where('user_id = :user_id')
        //     ->appendBindings(['user_id' => $user_id])
        //     ->execute();
        $result = $this->update([
            'deleted_at' => date('Y-m-d H:i:s'),
        ])
            ->where('user_id = :user_id')
            ->appendBindings(['user_id' => $user_id])
            ->execute();

        if ($result) {
            return [
                'status' => true,
                'message' => 'User deleted successfully'
            ];
        } else {
            return [
                'status' => false,
                'message' => 'User delete failed'
            ];
        }
    }

    public function restoreUser($user_id)
    {
        $result = $this->update([
            'deleted_at' => null
        ])
            ->where('user_id = :user_id')
            ->appendBindings(['user_id' => $user_id])
            ->execute();

        if ($result) {
            return [
                'status' => true,
                'message' => 'User restored successfully'
            ];
        } else {
            return [
                'status' => false,
                'message' => 'User restore failed'
            ];
        }
    }


    public function getCounts()
    {
        return [
            'total' => $this->count()->get()['total'],
            'active' => $this->count()->where('status = "active"')->get()['total'],
            'suspend' => $this->count()->where('status = "suspend"')->get()['total'],
            'student' => $this->count()->where('user_type = "student"')->get()['total'],
            'teacher' => $this->count()->where('user_type = "teacher"')->get()['total'],
            'institution' => $this->count()->where('user_type = "institution"')->get()['total'],
            'deleted' => $this->count()->where('deleted_at IS NOT NULL')->get()['total']
        ];
    }



    private function baseQuery()
    {
        return $this->select([
            'u.user_id',
            'u.status',
            'u.private',
            'u.allow_email',
            'u.allow_phone',
            'u.username',
            'u.full_name',
            'u.email',
            'u.phone_number',
            'u.education_level',
            'u.enrolled_course',
            'u.bio',
            'u.created_at',
            'u.updated_at',
            'u.deleted_at',
            'u.user_type',
            'COUNT(DISTINCT f1.follower_id) as followers_count',
            'COUNT(DISTINCT f2.following_id) as following_count',
            'COUNT(DISTINCT r.request_id) as requests_count',
            'COUNT(DISTINCT m.material_id) as materials_count',
            'COUNT(DISTINCT p.project_id) as project_count',
            'COUNT(DISTINCT CASE WHEN s.request_id IS NOT NULL THEN s.user_id END) as responded_requests_count'
        ], 'u')
            ->leftJoin('follow_relation as fr', 'u.user_id = fr.following_id')
            ->leftJoin('follow_relation as f1', 'f1.following_id = u.user_id')
            ->leftJoin('follow_relation as f2', 'f2.follower_id = u.user_id')
            ->leftJoin('study_material_requests as r', 'r.user_id = u.user_id')
            ->leftJoin('study_materials as m', 'm.user_id = u.user_id')
            ->leftJoin('github_projects as p', 'p.user_id = u.user_id')
            ->leftJoin('study_materials as s', 's.user_id = u.user_id AND s.request_id IS NOT NULL');
    }

    public function profileData($user_id)
    {
        return $this->baseQuery()
            ->where('u.user_id = :user_id AND u.deleted_at IS NULL')
            ->bind(['user_id' => $user_id])
            ->groupBy('u.user_id')
            ->get();
    }

    public function getUserById($user_id)
    {
        return $this->baseQuery()
            ->where('u.user_id = :user_id AND u.deleted_at IS NULL')
            ->bind(['user_id' => $user_id])
            ->groupBy('u.user_id')
            ->get();
    }

    public function search($search)
    {
        return $this->baseQuery()
            ->where('(u.username LIKE :search
    OR u.full_name LIKE :search
    OR u.email LIKE :search
    OR u.phone_number LIKE :search
    OR u.user_type LIKE :search
    OR u.education_level LIKE :search
    OR u.enrolled_course LIKE :search
    ) AND u.deleted_at IS NULL
    AND u.status <> :status
    ')
            ->bind(['search' => '%' . $search . '%', 'status' => 'suspend'])
            ->groupBy('u.user_id')
            ->orderBy('followers_count', 'DESC')
            ->getAll();
    }

    public function searchSuggestions($search)
    {
        return $this->select([
            'DISTINCT u.username as title',
        ], 'u')
            ->where('(
              u.username LIKE :search 
          OR u.full_name LIKE :search
          OR u.email LIKE :search
          OR u.phone_number LIKE :search
          OR u.user_type LIKE :search
          OR u.education_level LIKE :search
          OR u.enrolled_course LIKE :search
    ) AND u.status <> :status
      AND u.deleted_at IS NULL
    ')
            ->bind(['search' => '%' . $search . '%', 'status' => 'suspend'])
            ->limit(5)
            ->getAll();
    }

    public function getUserForAdmin($search, $page = 1)
    {
        $limit = 10;
        $offset = ($page - 1) * $limit;

        return $this->baseQuery()
            ->where('(u.username LIKE :search
    OR u.full_name LIKE :search
    OR u.email LIKE :search
    OR u.phone_number LIKE :search
    OR u.user_type LIKE :search
    OR u.education_level LIKE :search
    OR u.enrolled_course LIKE :search
    OR u.status LIKE :search)
    AND u.deleted_at IS NULL
    ')
            ->bind(['search' => '%' . $search . '%'])
            ->groupBy('u.user_id')
            ->orderBy('u.created_at', 'DESC')
            ->limit($limit)
            ->offset($offset)
            ->getAll();
    }

    public function getUserCountForAdmin($search)
    {

        return $this->select([
            'COUNT(u.user_id) as total'
        ], 'u')
            ->where('(u.username LIKE :search
    OR u.full_name LIKE :search
    OR u.email LIKE :search
    OR u.phone_number LIKE :search
    OR u.user_type LIKE :search
    OR u.education_level LIKE :search
    OR u.enrolled_course LIKE :search
    OR u.status LIKE :search)
    AND u.deleted_at IS NULL
    ')
            ->bind(['search' => '%' . $search . '%'])
            ->get()['total'];
    }

    public function getDeletedUser($search, $page = 1)
    {
        $limit = 10;
        $offset = ($page - 1) * $limit;

        return $this->baseQuery()
            ->where('(u.username LIKE :search
    OR u.full_name LIKE :search
    OR u.email LIKE :search
    OR u.phone_number LIKE :search
    OR u.user_type LIKE :search
    OR u.education_level LIKE :search
    OR u.enrolled_course LIKE :search
    OR u.status LIKE :search)
    AND u.deleted_at IS NOT NULL
    ')
            ->bind(['search' => '%' . $search . '%'])
            ->groupBy('u.user_id')
            ->orderBy('u.created_at', 'DESC')
            ->limit($limit)
            ->offset($offset)
            ->getAll();
    }

    public function getDeletedUserCount($search)
    {
        return $this->select([
            'COUNT(u.user_id) as total'
        ], 'u')
            ->where('(u.username LIKE :search
    OR u.full_name LIKE :search
    OR u.email LIKE :search
    OR u.phone_number LIKE :search
    OR u.user_type LIKE :search
    OR u.education_level LIKE :search
    OR u.enrolled_course LIKE :search
    OR u.status LIKE :search)
    AND u.deleted_at IS NOT NULL
    ')
            ->bind(['search' => '%' . $search . '%'])
            ->get()['total'];
    }
}
