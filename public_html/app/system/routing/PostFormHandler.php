<?php
class PostFormHandler extends Handler
{
  private $controller;

  public function __construct()
  {
    //$this->prepareClasses();
    $this->runHandler();
  }

  /*
  //?? czy to konieczne?
  private function prepareClasses()
  {
    require_once('app/source/controllers/Users.php');
    $this->user = new Users();
  }*/

  private function runHandler()
  {
    switch ($_POST['form']) {
      case 'login':
        parent::controller('Users');
        $this->controller = new UsersController();
        $this->controller->loginUser($_POST);
        die();
        break;
      
      case 'zapiszNaKurs':
        parent::controller('Kursy');
        $this->controller = new KursyController();
        $this->controller->zapiszNaKurs($_POST);
        die();
        break;

      default:
        # code...
        break;
    }
  }
}