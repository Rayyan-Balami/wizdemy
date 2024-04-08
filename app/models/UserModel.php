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
            'status'
        ];

    }

    public function login($email_username, $password)
    {
        $user = $this->select(['user_id', 'username', 'email', 'password','status'])
            ->where('username = :username OR email = :email')
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
            'phone_number'
        ])
            ->where('user_id = :user_id')
            ->bind(['user_id' => $user_id])
            ->get();
    }

    public function updateUserDetails($user_id, $data)
    {
        $result = $this->update($data)
            ->where('user_id = :user_id')
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
            ->where('user_id = :user_id')
            ->bind(['user_id' => $user_id])
            ->get();
    }

    public function updatePassword($user_id, $currentPassword, $newPassword)
    {
        $password = $this->select(['password'])
            ->where('user_id = :user_id')
            ->bind(['user_id' => $user_id])
            ->get();

        if (!password_verify($currentPassword, $password['password'])) {
            return [
                'status' => false,
                'message' => Session::get('user')['username'] . ' OOOPS! Current password is incorrect'
            ];
        }

        $result = $this->update(['password' => password_hash($newPassword, PASSWORD_BCRYPT)])
            ->where('user_id = :user_id')
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
            ->where('user_id = :user_id')
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
                ->where('user_id = :user_id')
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
            ->where('user_id = :user_id')
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


    public function getUserStatus($user_id)
    {
        return $this->select(['status'])
            ->where('user_id = :user_id')
            ->bind(['user_id' => $user_id])
            ->get();
    }
    public function updateUserStatus($user_id, $status)
    {
        $result = $this->update([
            'status' => $status
        ])
            ->where('user_id = :user_id')
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
    public function deleteUserById($user_id)
    {
        $result = $this->delete()
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
    public function getTotalUsersCount()
    {
        $result = $this->count()->get();
        return $result['total'];
    }

}