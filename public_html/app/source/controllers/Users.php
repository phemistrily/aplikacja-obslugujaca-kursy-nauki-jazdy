<?php
class Users
{
  public function __construct()
  {
    include_once('app/system/modules/connector/ConnectionManager.php');
    $this->sql = new ConnectionManager('mysql');
  }

  public function getUsers()
  {
    $query = "SELECT * FROM users";

    $this->sql->run($query);
    return $this->sql->toArray();
  }
}