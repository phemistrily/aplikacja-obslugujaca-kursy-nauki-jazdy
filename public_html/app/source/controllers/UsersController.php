<?php
class UsersController extends BaseController
{
  private $users;

  public function __construct()
  {
    parent::model('Users');
    $this->users = new Users();
  }


  public function loginView(){
    parent::$applicationData['headTitle'] = 'MORD | Logowanie';

    ModuleController::$applicationData = parent::$applicationData;
    ModuleController::$template = 'logowanie';
    
  }

  
  public function registerView()
  {
    parent::$applicationData['headTitle'] = 'MORD | Rejestracja';

    ModuleController::$applicationData = parent::$applicationData;
    ModuleController::$template = 'rejestracja';
  }


  public function loginUser($post)
  {
    $user = $this->users->loginUser($post['email'], $post['password']);
    if($user)
    {
      parent::redirect('/?mod=dashboard&msg=s_loggedIn');
    }
    else
    {
      parent::redirect('/?mod=logowanie&msg=w_errLogin');
    }
  }

  public function registerUser()
  {

  }

  public function instruktorzyView(){
    parent::$applicationData['headTitle'] = 'MORD | Instruktorzy';

    parent::$applicationData['instruktorList'] = $this->users->getInstruktorList();

    ModuleController::$applicationData = parent::$applicationData;
    ModuleController::$template = 'instruktorzy';
    
  }

  public function kursanciView(){
    parent::$applicationData['headTitle'] = 'MORD | Kursanci';

    parent::$applicationData['kursantList'] = $this->users->getKursantList();

    ModuleController::$applicationData = parent::$applicationData;
    ModuleController::$template = 'kursanci';
    
  }
}