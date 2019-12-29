<?php
class KursyController extends BaseController
{
  private $kursy;

  public function __construct()
  {
    parent::model('Kursy');
    $this->kursy = new Kursy();
  }


  public function kursyView(){
    parent::$applicationData['headTitle'] = 'MORD | Kursy';

    parent::$applicationData['kursyList'] = $this->kursy->getKursyList();

    ModuleController::$applicationData = parent::$applicationData;
    ModuleController::$template = 'kursy';
    
  }


  public function zapiszNaKurs(){
    
    if(isset($_SESSION['userId'])) {
      $this->kursy->zapiszNaKurs($_POST);
      
    } else {
      parent::redirect('/?mod=logowanie&msg=w_zapiszNaKurs');
    }
    //parent::redirect('/?mod=kursy');
  }


}