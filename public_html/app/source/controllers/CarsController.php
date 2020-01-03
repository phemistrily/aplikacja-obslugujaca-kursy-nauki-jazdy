<?php
class CarsController extends BaseController
{
  private $cars;

  public function __construct()
  {
    parent::model('Cars');
    $this->cars = new Cars();
  }


  public function getCarsView(){
    parent::$applicationData['headTitle'] = 'MORD | Sprawdź pojazdy';

    parent::$applicationData['cars'] = $this->cars->getCars();
    var_dump(parent::$applicationData);
    $this->setTemplate('sprawdzPojazdy');
    
  }


  private function setTemplate($templateName)
  {
    ModuleController::$applicationData = parent::$applicationData;
    ModuleController::$template = $templateName;
  }
}