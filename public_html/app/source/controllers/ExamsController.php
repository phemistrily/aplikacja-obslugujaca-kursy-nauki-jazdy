<?php
class ExamsController extends BaseController
{
  private $exams;

  public function __construct()
  {
    parent::model('Exams');
    $this->exams = new Exams();
  }


  public function examsView(){
    parent::$applicationData['headTitle'] = 'MORD | Egzaminy';

    parent::$applicationData['examsList'] = $this->exams->getExamsList();

    ModuleController::$applicationData = parent::$applicationData;
    ModuleController::$template = 'egzaminy';
  }

  public function myExamsView(){
    parent::$applicationData['headTitle'] = 'MORD | Moje egzaminy';

    parent::$applicationData['myExamsList'] = $this->exams->getMyExamsList();

    ModuleController::$applicationData = parent::$applicationData;
    ModuleController::$template = 'mojeEgzaminy';
  }
}