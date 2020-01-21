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
    if($_SESSION['typKonta'] == 'kursant')
    {
      parent::$applicationData['myExamsList'] = $this->exams->getMyExamsList();
      parent::$applicationData['myPlannedExamsList'] = $this->exams->getMyPlannedExamsList();
    }
    else if($_SESSION['typKonta'] == 'instruktor')
    {
      parent::$applicationData['myExamsList'] = $this->exams->getExamsForInstruktor($_SESSION['userId']);
    }
    
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

  public function zaliczExam($post)
  {
    if($post['egzaminId'])
    {
      $this->exams->zaliczExam($post['egzaminId']);
      parent::redirect('?mod=mojeegzaminy&msg=s_examStatusChanged');
    }
    else
    {
      parent::redirect('?msg=w_somethingHappened');
    }
  }

  public function nieZaliczExam($post)
  {
    if($post['egzaminId'])
    {
      $this->exams->nieZaliczExam($post['egzaminId']);
      parent::redirect('?mod=mojeegzaminy&msg=s_examStatusChanged');
    }
    else
    {
      parent::redirect('?msg=w_somethingHappened');
    }
  }

  public function addExamView()
  {
    ModuleController::$applicationData = parent::$applicationData;
    ModuleController::$template = 'dodajEgzamin';
  }

  public function addExam($post)
  {
    $this->exams->addExam($post);
    parent::redirect('?mod=mojeegzaminy');
  }
}