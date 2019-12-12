<?php
class GetModHandler
{
  private $applicationData = [];

  public function __construct()
  {
    $this->runHandler();
  }

  private function runHandler()
  {
    switch ($_GET['mod']) {
      case 'logowanie':
        include_once('app/source/controllers/Users.php');
        $users = new Users();
        $this->applicationData['userList'] = $users->getUsers();
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