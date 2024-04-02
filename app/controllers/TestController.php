<?php
class TestController extends Controller
{
    public function __construct()
    {
        parent::__construct(new UserModel());
    }
    public function test($p1, $p2)
    {
        echo "Test Controller: $p1, $p2";
    }
    public function testPut($p1, $p2)
    {
        $_PUT = json_decode(file_get_contents("php://input"), true);
        // print_r($_PUT);
        $this->buildJsonResponse( $_PUT, 200);
    }


}