<?php

class Middleware{
  const MAP = [
    'auth' => 'AuthMiddleware',
    'guest' => 'GuestMiddleware'
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