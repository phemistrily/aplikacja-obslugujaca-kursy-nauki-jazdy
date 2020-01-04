<?php
class CarsController extends BaseController
{
  private $cars;

  public function __construct()
  {
    parent::model('Cars');
    $this->cars = new Cars();
  }


  public function getCarsView()
  {
    parent::$applicationData['headTitle'] = 'MORD | Sprawdź pojazdy';

    parent::$applicationData['cars'] = $this->cars->getCars();
    $this->setTemplate('sprawdzPojazdy');
    
  }

  public function getEditCarView()
  {
    parent::$applicationData['headTitle'] = 'MORD | Edytuj pojazd';

    parent::$applicationData['car'] = $this->cars->getCar($_GET['id']);
    $this->setTemplate('edytujPojazd');
  }

  public function editCar($post)
  {
    $car = $this->cars->editCar($post);
    if($car)
    {
      parent::redirect('/?mod=edytujPojazd&id='.$car.'&msg=s_editCar');
    }
    else
    {
      parent::redirect('/?msg=w_somethingHappened');
    }
    die();
  }


  private function setTemplate($templateName)
  {
    ModuleController::$applicationData = parent::$applicationData;
    ModuleController::$template = $templateName;
  }
}