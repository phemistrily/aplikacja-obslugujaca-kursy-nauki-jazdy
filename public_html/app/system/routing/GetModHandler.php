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
      case 'kursy':
        parent::controller('Kursy');
        $this->controller = new KursyController();
        $this->controller->kursyView();
        break;
      case 'egzaminy':
        parent::controller('Egzaminy');
        $this->controller = new EgzaminyController();
        $this->controller->egzaminyView();
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