<?php
include 'DisplayHandler.php';
require_once('routing/GetModHandler.php');
require_once('routing/PostFormHandler.php');
require_once 'modules/connector/ConnectionManager.php';
require_once 'modules/connector/sql.php';
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
      $module = new GetModHandler();
      $this->applicationData = $module->getApplicationData();
    }
    else if (isset($_POST['form']))
    {
      $form = new PostFromHandler();
      $this->applicationData = $form->getApplicationData();
    }
    parent::render($this->applicationData);
  }
}