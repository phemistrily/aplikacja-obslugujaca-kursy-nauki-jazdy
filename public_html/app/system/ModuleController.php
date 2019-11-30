<?php
include 'DisplayHandler.php';
require_once('routing/GetModHandler.php');
require_once('routing/PostFormHandler.php');
class ModuleController extends DisplayHandler
{
  public $applicationData;

  public function __construct()
  {
    parent::__construct();
    $this->initialize();
  }

  private function initialize()
  {
    if(isset($_GET['mod']))
    {
      new GetModHandler();
    }
    else if (isset($_POST['form']))
    {
      new PostFromHandler();
    }
    parent::render($this->applicationData);
  }
}