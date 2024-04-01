<?php
class TestController extends Controller
{
    public function __construct()
    {
        parent::__construct('UserModel');
    }
    public function test($p1, $p2)
    {
        echo "Test Controller: $p1, $p2";
    }

}