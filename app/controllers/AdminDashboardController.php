<?php

class dashboardController extends Controller
{
  public function __construct()
  {
    parent::__construct(new AdminModel());
  }

  public function index()
  {
    View::render('admin/dashboard');
  }

}