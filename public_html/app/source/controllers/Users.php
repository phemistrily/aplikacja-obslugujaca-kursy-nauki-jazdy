<?php
class Users
{
  public function __construct()
  {
    //include_once('app/system/modules/connector/ConnectionManager.php');
    //$this->sql = new ConnectionManager('mysql');
    Sql::connectSql1();
  }

  public function getUsers()
  {
    $query = "SELECT * FROM users";

    //$this->sql->run($query);
    //return $this->sql->toArray();
    Sql::$sql1->run($query);
    return Sql::$sql1->toArray();
  }
}