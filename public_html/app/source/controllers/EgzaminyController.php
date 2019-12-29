<?php
class EgzaminyController extends BaseController
{
  private $egzaminy;

  public function __construct()
  {
    parent::model('Egzaminy');
    $this->egzaminy = new Egzaminy();
  }


  public function egzaminyView(){
    parent::$applicationData['headTitle'] = 'MORD | Egzaminy';

    parent::$applicationData['egzaminyList'] = $this->egzaminy->getEgzaminyList();

    ModuleController::$applicationData = parent::$applicationData;
    ModuleController::$template = 'egzaminy';
  }
}