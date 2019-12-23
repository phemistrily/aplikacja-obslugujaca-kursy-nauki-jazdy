<?php
class PostFormHandler
{
  public $applicationData;
  public $user;

  public function __construct()
  {
    $this->prepareClasses();
    $this->runHandler();
  }

  private function prepareClasses()
  {
    require_once('app/source/controllers/Users.php');
    $this->user = new Users();
  }

  private function runHandler()
  {
    switch ($_POST['form']) {
      case 'login':
        $user = $this->user->loginUser($_POST['email'],$_POST['password']);
        if($user)
        {
          header('location: /?mod=dashboard&msg=s_loggedIn');
        }
        else
        {
          header('location: /?mod=logowanie&msg=w_errLogin');
        }
        die();
        break;
      
      default:
        # code...
        break;
    }
  }

  public function getApplicationData()
  {
    return $this->applicationData;
  }
}