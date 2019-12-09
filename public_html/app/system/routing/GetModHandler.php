<?php
class GetModHandler
{
  public function __construct()
  {
    $this->runHandler();
  }

  private function runHandler()
  {
    switch ($_GET['mod']) {
      case 'test':
        # code...
        break;
      
      default:
        # code...
        break;
    }
  }
}