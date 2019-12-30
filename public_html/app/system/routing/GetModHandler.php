<?php
require_once 'Handler.php';

class GetModHandler extends Handler
{
  private $controller;

  public function __construct()
  {
    $this->runHandler();
  }

  private function runHandler()
  {
    switch ($_GET['mod']) {
      case 'logowanie':
        parent::controller('Users');
        $this->controller = new UsersController();
        $this->controller->loginView();
        break;
      case 'rejestracja':
        parent::controller('Users');
        $this->controller = new UsersController();
        $this->controller->registerView();
        break;
      case 'wyloguj':
        parent::controller('Users');
        $this->controller = new UsersController();
        $this->controller->logout();
        break;

      case 'kursy':
        parent::controller('Courses');
        $this->controller = new CoursesController();
        $this->controller->coursesView();
        break;
      case 'mojekursy':
        parent::controller('Courses');
        $this->controller = new CoursesController();
        $this->controller->myCoursesView();
        break;
      case 'egzaminy':
        parent::controller('Exams');
        $this->controller = new ExamsController();
        $this->controller->examsView();
        break;
      case 'mojeegzaminy':
        parent::controller('Exams');
        $this->controller = new ExamsController();
        $this->controller->myExamsView();
        break;

      case 'mojeplatnosci':
        parent::controller('Payments');
        $this->controller = new PaymentsController();
        $this->controller->myPaymentsView();
        break;
      case 'mojeraty':
        parent::controller('Payments');
        $this->controller = new PaymentsController();
        $this->controller->mojeRatyView();
        break;

      case 'kursanci':
        parent::controller('Users');
        $this->controller = new UsersController();
        $this->controller->kursanciView();
        break;
      case 'instruktorzy':
        parent::controller('Users');
        $this->controller = new UsersController();
        $this->controller->instruktorzyView();
        break;


      case 'mojejazdy':
        parent::controller('Driving');
        $this->controller = new DrivingController();
        $this->controller->myDrivingView();
        break;

      case 'terminjazdy':
        parent::controller('Driving');
        $this->controller = new DrivingController();
        $this->controller->chooseDrivingDate();
        break;

      default:
        header('location: /');
        die();
        break;
    }
  }
}