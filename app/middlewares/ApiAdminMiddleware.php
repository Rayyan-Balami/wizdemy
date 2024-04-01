<?php

class ApiAdminMiddleware {
  public static function handle() {
    if (!isset($_SESSION['admin'])) {
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'error',
            'message' => 'Unauthorized'
        ]);
        http_response_code(401);
        die();
    }
  }
}