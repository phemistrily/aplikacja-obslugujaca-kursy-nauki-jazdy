<?php
class PostFormHandler
{
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
}