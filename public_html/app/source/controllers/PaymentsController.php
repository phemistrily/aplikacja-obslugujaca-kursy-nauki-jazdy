<?php
class PaymentsController extends BaseController
{
  private $payments;

  public function __construct()
  {
    parent::model('Payments');
    $this->payments = new Payments();
  }



  public function myPaymentsView(){
    parent::$applicationData['headTitle'] = 'MORD | Moje płatności';

    parent::$applicationData['myPaymentsList'] = $this->payments->getMyPaymentsList();

    ModuleController::$applicationData = parent::$applicationData;
    ModuleController::$template = 'mojePlatnosci';
    
  }

  public function mojeRatyView(){
    parent::$applicationData['headTitle'] = 'MORD | Moje raty';

    parent::$applicationData['mojeRatyList'] = $this->payments->getMojeRatyList();

    ModuleController::$applicationData = parent::$applicationData;
    ModuleController::$template = 'mojeRaty';
    
  }


  
  public function wlaczRaty($post){
    
    $result = $this->payments->wlaczRaty($post);
    parent::redirect('/?mod=mojeplatnosci&msg=w_wlaczonoRaty');
  }
}