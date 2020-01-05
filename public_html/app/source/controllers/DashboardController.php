<?php
class DashboardController extends BaseController
{
  private $dashboard;

  public function __construct()
  {
    parent::model('Dashboard');
    $this->dashboard = new Dashboard();
  }

  public function getOsrodekView(){
    parent::$applicationData['headTitle'] = 'MORD | O osrodku';
    parent::$applicationData['oosrodkuList'] = $this->dashboard->getoOsrodkuList();
    //var_dump(parent::$applicationData);
    ModuleController::$applicationData = parent::$applicationData;
    ModuleController::$template = 'oOsrodku';
    
  }
  public function getInfoView(){
    parent::$applicationData['headTitle'] = 'MORD | Informacje';
    parent::$applicationData['getInfoList'] = $this->dashboard->getInfoList();
    //var_dump(parent::$applicationData);
    ModuleController::$applicationData = parent::$applicationData;
    ModuleController::$template = 'Informacje';
    
  }
}