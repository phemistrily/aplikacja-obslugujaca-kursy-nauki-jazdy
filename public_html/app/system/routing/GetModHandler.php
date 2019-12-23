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
        break;
      case 'rejestracja':
      break;
      case 'stronaGlowna':
      break;
      default:
        header('location: /?mod=stronaGlowna');
        die();
        break;
    }
  }
  public function getApplicationData()
  {
    return $this->applicationData;
  }
}