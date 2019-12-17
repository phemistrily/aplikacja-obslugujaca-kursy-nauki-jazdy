<?php
require_once 'Handler.php';

class GetModHandler extends Handler
{
  //private $applicationData = [];

  public function __construct()
  {
    $this->runHandler();
  }

  private function runHandler()
  {
    switch ($_GET['mod']) {
      case 'logowanie':
        parent::controller('Users');
        $users = new UsersController();
        //$this->applicationData['userList'] = $users->getUsers();
        break;
      
      default:
        # code...
        break;
    }
  }
  /*
  public function getApplicationData()
  {
    return $this->applicationData;
  }*/
}