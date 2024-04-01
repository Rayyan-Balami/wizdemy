<?php

class Middleware{
  const MAP = [
    'auth' => 'AuthMiddleware',
    'guest' => 'GuestMiddleware',
    'admin' => 'AdminMiddleware',
    'apiAuth' => 'ApiAuthMiddleware',
    'apiAdmin' => 'ApiAdminMiddleware',
  ];

  public static function resolve($middleware){
    if(! $middleware) return;

    $middleware = self::MAP[$middleware] ?? false;

    if(! $middleware){
      throw new \Exception("Middleware {$middleware} not found");
    }

    $middleware::handle();
  }
}
