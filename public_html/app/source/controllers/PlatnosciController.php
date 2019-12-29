<?php
class PlatnosciController extends BaseController
{
  private $platnosci;

  public function __construct()
  {
    parent::model('Platnosci');
    $this->platnosci = new Platnosci();
  }



  public function mojePlatnosciView(){
    parent::$applicationData['headTitle'] = 'MORD | Moje płatności';

    parent::$applicationData['mojePlatnosciList'] = $this->platnosci->getMojePlatnosciList();

    ModuleController::$applicationData = parent::$applicationData;
    ModuleController::$template = 'mojePlatnosci';
    
  }

  public function mojeRatyView(){
    parent::$applicationData['headTitle'] = 'MORD | Moje raty';

    parent::$applicationData['mojeRatyList'] = $this->platnosci->getMojeRatyList();

    ModuleController::$applicationData = parent::$applicationData;
    ModuleController::$template = 'mojeRaty';
    
  }


  
  public function wlaczRaty($post){
    
    $result = $this->platnosci->wlaczRaty($post);
    parent::redirect('/?mod=mojeplatnosci&msg=w_wlaczonoRaty');
  }
}