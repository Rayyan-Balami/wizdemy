<?php


class ApiAuthMiddleware
{
    public static function handle()
    {
        if (!isset($_SESSION['user'])) {
            header('Content-Type: application/json');
            echo json_encode([
                'status' => 'error',
                'message' => 'Unauthorized'
            ]);
            die();
        }
    }
}