<?php
class PostFormHandler
{
  public $applicationData;

  public function __construct()
  {
    $this->runHandler();
  }

  private function runHandler()
  {
    switch ($_GET['mod']) {
      case 'value':
        # code...
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