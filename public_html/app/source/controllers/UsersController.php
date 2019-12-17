<?php
class UsersController extends Controller
{
  private $users;

  public function __construct()
  {
    parent::model('Users');
    $this->users = new Users();
    $this->getUsers();
  }

  public function getUsers()
  {
    $query = "SELECT * FROM users";
    
    Sql::$sql1->run($query);
    parent::$applicationData['userList'] = Sql::$sql1->toArray();

    ModuleController::$applicationData = parent::$applicationData;
    ModuleController::$template = 'index';
  }
}