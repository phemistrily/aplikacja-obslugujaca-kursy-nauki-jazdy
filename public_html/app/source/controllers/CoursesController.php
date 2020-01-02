<?php
class CoursesController extends BaseController
{
  private $courses;

  public function __construct()
  {
    parent::model('Courses');
    $this->courses = new Courses();
  }


  public function coursesView(){
    parent::$applicationData['headTitle'] = 'MORD | Kursy';

    parent::$applicationData['coursesList'] = $this->courses->getCoursesList();

    ModuleController::$applicationData = parent::$applicationData;
    ModuleController::$template = 'kursy';
    
  }

  public function myCoursesView(){
    parent::$applicationData['headTitle'] = 'MORD | Moje kursy';

    parent::$applicationData['myCoursesList'] = $this->courses->getMyCoursesList();

    ModuleController::$applicationData = parent::$applicationData;
    ModuleController::$template = 'mojeKursy';
    
  }


  public function zapiszNaKurs($post){
    
    if(isset($_SESSION['userId'])) {
      $result = $this->courses->zapiszNaKurs($post);
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
    
    $this->courses->rezygnujKurs($post);
    parent::redirect('/?mod=mojekursy&msg=w_rezygnacjaKurs');
  }

  

}