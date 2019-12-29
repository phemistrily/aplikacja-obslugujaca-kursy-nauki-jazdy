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
        parent::controller('Kursy');
        $this->controller = new KursyController();
        $this->controller->kursyView();
        break;
      case 'mojekursy':
        parent::controller('Kursy');
        $this->controller = new KursyController();
        $this->controller->mojeKursyView();
        break;
      case 'egzaminy':
        parent::controller('Egzaminy');
        $this->controller = new EgzaminyController();
        $this->controller->egzaminyView();
        break;
      case 'mojeegzaminy':
        parent::controller('Egzaminy');
        $this->controller = new EgzaminyController();
        $this->controller->mojeEgzaminyView();
        break;

      case 'mojeplatnosci':
        parent::controller('Platnosci');
        $this->controller = new PlatnosciController();
        $this->controller->mojePlatnosciView();
        break;
      case 'mojeraty':
        parent::controller('Platnosci');
        $this->controller = new PlatnosciController();
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
      default:
        header('location: /');
        die();
        break;
    }
  }
}