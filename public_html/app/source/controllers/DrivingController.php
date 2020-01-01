<?php
class DrivingController extends BaseController
{
  private $driving;

  public function __construct()
  {
    parent::model('Driving');
    $this->driving = new Driving();
  }


  public function myDrivingView(){
    parent::$applicationData['headTitle'] = 'MORD | Moje jazdy';

    parent::$applicationData['myDrivingList'] = $this->driving->getMyDrivingList();

    ModuleController::$applicationData = parent::$applicationData;
    ModuleController::$template = 'mojejazdy';
    
  }

  public function chooseDrivingDate(){
    parent::$applicationData['headTitle'] = 'MORD | Ustal termin jazdy';

    ModuleController::$applicationData = parent::$applicationData;
    ModuleController::$template = 'terminjazdy';
    
  }

  public function buyDrivingDate(){
    parent::$applicationData['headTitle'] = 'MORD | Wykup dodatkową jazdę';

    ModuleController::$applicationData = parent::$applicationData;
    ModuleController::$template = 'wykupjazde';
    
  }


  public function registerDriving($post){
    $result = $this->driving->registerDriving($post);
    
    parent::redirect('/?mod=mojejazdy&msg=w_ustalonoJazde');
    
  }

  public function buyDriving($post){
    $result = $this->driving->buyDriving($post);
    
    parent::redirect('/?mod=mojejazdy&msg=w_wykupionoJazde');
    
  }
  


  

  

}