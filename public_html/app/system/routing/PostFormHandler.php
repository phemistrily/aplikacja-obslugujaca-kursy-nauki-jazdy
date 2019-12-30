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
      case 'register':
        parent::controller('Users');
        $this->controller = new UsersController();
        $this->controller->registerUser($_POST);
        die();
      break;
      case 'zapiszNaKurs':
        parent::controller('Courses');
        $this->controller = new CoursesController();
        $this->controller->zapiszNaKurs($_POST);
        die();
        break;
      case 'rezygnujKurs':
        parent::controller('Courses');
        $this->controller = new CoursesController();
        $this->controller->rezygnujKurs($_POST);
        die();
        break;
      case 'wlaczRaty':
        parent::controller('Payments');
        $this->controller = new PaymentsController();
        $this->controller->wlaczRaty($_POST);
        die();
        break;
        
      default:
        # code...
        break;
    }
  }
}