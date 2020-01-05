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
        case 'Informacje':
          parent::controller('Dashboard');
          $this->controller = new DashboardController;
          $this->controller->getInfoView();
          break;
      case 'oOsrodku':
        parent::controller('Dashboard');
        $this->controller = new DashboardController;
        $this->controller->getOsrodekView();
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
      case 'egzaminteoretyczny':
        parent::controller('Exams');
        $this->controller = new ExamsController();
        $this->controller->chooseTheoryExamsView();
        break;
      case 'egzaminpraktyczny':
        parent::controller('Exams');
        $this->controller = new ExamsController();
        $this->controller->choosePraticalExamsView();
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
      
      case 'zarzadzajUzytkownikami':
        parent::controller('Users');
        $this->controller = new UsersController();
        $this->controller->setUserSettingsView();
        break;
      case 'edytujUzytkownika':
        parent::controller('Users');
        $this->controller = new UsersController();
        $this->controller->getUserEditView();
        break;
      case 'sprawdzPojazdy':
        parent::controller('Cars');
        $this->controller = new CarsController();
        $this->controller->getCarsView();
        
        break;
      case 'edytujPojazd':
        parent::controller('Cars');
        $this->controller = new CarsController();
        $this->controller->getEditCarView();
        break;
      case 'wykupjazde':
        parent::controller('Driving');
        $this->controller = new DrivingController();
        $this->controller->buyDrivingDate();
        break;
      case 'opiniaKurs':
        parent::controller('Courses');
        $this->controller = new CoursesController();
        $this->controller->setOpinionView();
        break;

        

      default:
        header('location: /');
        die();
        break;
    }
  }
}