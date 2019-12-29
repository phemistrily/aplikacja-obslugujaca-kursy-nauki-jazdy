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

  public function mojeKursyView(){
    parent::$applicationData['headTitle'] = 'MORD | Moje kursy';

    parent::$applicationData['mojeKursyList'] = $this->kursy->getMojeKursyList();

    ModuleController::$applicationData = parent::$applicationData;
    ModuleController::$template = 'mojeKursy';
    
  }


  public function zapiszNaKurs($post){
    
    if(isset($_SESSION['userId'])) {
      $result = $this->kursy->zapiszNaKurs($post);
      if($result){
        parent::redirect('/?mod=mojekursy&msg=w_zapisanoNaKurs');
      } else {
        parent::redirect('/?mod=kursy&msg=w_juzZapisanyNaKurs');
      }
      
    } else {
      parent::redirect('/?mod=logowanie&msg=w_zapiszNaKurs');
    }
  }

  public function rezygnujKurs($post){
    
    $this->kursy->rezygnujKurs($post);
    parent::redirect('/?mod=mojekursy&msg=w_rezygnacjaKurs');
  }

  

}