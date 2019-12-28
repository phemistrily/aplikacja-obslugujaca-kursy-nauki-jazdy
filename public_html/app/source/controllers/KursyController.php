<?php
class KursyController extends BaseController
{
  private $users;

  public function __construct()
  {
    parent::model('Kursy');
    $this->users = new Kursy();
  }


  public function kursyView(){
    parent::$applicationData['headTitle'] = 'MORD | Kursy';

    parent::$applicationData['kursyList'] = $this->users->getKursyList();

    ModuleController::$applicationData = parent::$applicationData;
    ModuleController::$template = 'kursy';
    
  }


  public function zapiszNaKurs(){
    
    //parent::redirect('/?mod=kursy');
  }


}