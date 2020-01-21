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
      case 'editUser':
        parent::controller('Users');
        $this->controller = new UsersController();
        $this->controller->editUser($_POST);
        die();
      break;
      case 'editCar':
        parent::controller('Cars');
        $this->controller = new CarsController();
        $this->controller->editCar($_POST);
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

      case 'registerDriving':
        parent::controller('Driving');
        $this->controller = new DrivingController();
        $this->controller->registerDriving($_POST);
        die();
        break;
        
      case 'buyDriving':
        parent::controller('Driving');
        $this->controller = new DrivingController();
        $this->controller->buyDriving($_POST);
        die();
        break;

      case 'paymentCourse':
        parent::controller('Payments');
        $this->controller = new PaymentsController();
        $this->controller->paymentCourse($_POST);
        die();
        break;

      case 'paymentPartCourse':
        parent::controller('Payments');
        $this->controller = new PaymentsController();
        $this->controller->paymentPartCourse($_POST);
        die();
        break;

      case 'chooseTheoryExam':
        parent::controller('Exams');
        $this->controller = new ExamsController();
        $this->controller->chooseTheoryExam($_POST);
        die();
        break;

      case 'choosePracticalExam':
        parent::controller('Exams');
        $this->controller = new ExamsController();
        $this->controller->choosePracticalExam($_POST);
        die();
        break;
      case 'zmienInstruktora':
        parent::controller('Courses');
        $this->controller = new CoursesController();
        $this->controller->changeInstructorForCourse($_POST);
        die();
        break;
      case 'addOpinionCourse':
        parent::controller('Courses');
        $this->controller = new CoursesController();
        $this->controller->addOpinionCourse($_POST);
        die();
        break;
      case 'zaliczEgzamin':
        parent::controller('Exams');
        $this->controller = new ExamsController();
        $this->controller->zaliczExam($_POST);
        die();
        break;
      case 'nieZaliczEgzamin':
        parent::controller('Exams');
        $this->controller = new ExamsController();
        $this->controller->nieZaliczExam($_POST);
        die();
        break;
      case 'addExam':
        parent::controller('Exams');
        $this->controller = new ExamsController();
        $this->controller->addExam($_POST);
        break;
      default:
        # code...
        break;
    }
  }
}