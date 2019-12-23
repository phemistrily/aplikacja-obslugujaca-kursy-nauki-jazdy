<?php
include 'DisplayHandler.php';
require_once('routing/GetModHandler.php');
require_once('routing/PostFormHandler.php');
require_once 'modules/connector/ConnectionManager.php';
require_once 'modules/connector/sql.php';
class ModuleController extends DisplayHandler
{
  public static $applicationData;
  public static $template;

  public function __construct()
  {
    parent::__construct();
    Sql::connectSql1();
    $this->initialize();
  }

  private function initialize()
  {
    if(isset($_GET['mod']))
    {
      $module = new GetModHandler();
    }
    else if (isset($_POST['form']))
    {
      $form = new PostFormHandler();
    }
    else 
    {
      ModuleController::$applicationData['headTitle'] = 'MORD | Strona główna';
      ModuleController::$template = 'index';
    }
    parent::render(self::$applicationData, self::$template);
  }
}