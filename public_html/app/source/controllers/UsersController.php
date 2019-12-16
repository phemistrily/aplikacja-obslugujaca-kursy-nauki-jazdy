<?php
class UsersController extends Controller
{
  public function __construct()
  {
    parent::model('Users');
  }

  public function getUsers()
  {
    $query = "SELECT * FROM users";

    Sql::$sql1->run($query);
    return Sql::$sql1->toArray();
  }
}