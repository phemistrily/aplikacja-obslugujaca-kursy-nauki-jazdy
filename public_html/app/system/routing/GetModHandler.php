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
      case 'stronaGlowna':
        break;
      default:
        header('location: /?mod=stronaGlowna');
        die();
        break;
    }
  }
}