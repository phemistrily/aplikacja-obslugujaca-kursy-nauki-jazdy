<?php
class UsersController extends Controller
{
  private $users;

  public function __construct()
  {
    parent::model('Users');
    $this->users = new Users();
  }


  public function loginView(){
    parent::$applicationData['headTitle'] = 'MORD | Logowanie';

    ModuleController::$applicationData = parent::$applicationData;
    ModuleController::$template = 'logowanie';
    
  }

  
  public function registerView()
  {
    parent::$applicationData['headTitle'] = 'MORD | Rejestracja';

    ModuleController::$applicationData = parent::$applicationData;
    ModuleController::$template = 'rejestracja';
  }


  public function loginUser()
  {

  }

  public function registerUser()
  {

  }
  /*
  public function getUsers()
  {
    $query = "SELECT * FROM users";
    
    Sql::$sql1->run($query);
    parent::$applicationData['userList'] = Sql::$sql1->toArray();

    ModuleController::$applicationData = parent::$applicationData;
    ModuleController::$template = 'index';
  }
  */
}