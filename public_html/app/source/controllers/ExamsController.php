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
    parent::$applicationData['myPlannedExamsList'] = $this->exams->getMyPlannedExamsList();
    //parent::$applicationData['myPracticalExamList'] = $this->exams->getMyPracticalExamList();

    ModuleController::$applicationData = parent::$applicationData;
    ModuleController::$template = 'mojeEgzaminy';
  }


  public function chooseTheoryExamsView(){
    parent::$applicationData['headTitle'] = 'MORD | Ustal egzamin teoretyczny';

    parent::$applicationData['theoryExamsList'] = $this->exams->getTheoryExamsList();

    ModuleController::$applicationData = parent::$applicationData;
    ModuleController::$template = 'egzaminteoretyczny';
  }


  public function choosePraticalExamsView(){
    parent::$applicationData['headTitle'] = 'MORD | Ustal egzamin praktyczny';

    parent::$applicationData['praticalExamsList'] = $this->exams->getPraticalExamsList();

    ModuleController::$applicationData = parent::$applicationData;
    ModuleController::$template = 'egzaminpraktyczny';
  }


  public function chooseTheoryExam($post){
    
    $result = $this->exams->chooseTheoryExam($post);
    parent::redirect('/?mod=mojeplatnosci&msg=w_oplacEgzaminTeoretyczny');
  }


  public function choosePracticalExam($post){
    
    $result = $this->exams->choosePracticalExam($post);
    parent::redirect('/?mod=mojeplatnosci&msg=w_oplacEgzaminPraktyczny');
  }
}