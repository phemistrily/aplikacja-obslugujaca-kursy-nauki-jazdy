<?php
class EgzaminyController extends BaseController
{
  private $users;

  public function __construct()
  {
    parent::model('Egzaminy');
    $this->users = new Egzaminy();
  }


  public function egzaminyView(){
    parent::$applicationData['headTitle'] = 'MORD | Egzaminy';

    parent::$applicationData['egzaminyList'] = $this->users->getEgzaminyList();

    ModuleController::$applicationData = parent::$applicationData;
    ModuleController::$template = 'egzaminy';
  }
}