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

    $this->setTemplate('logowanie');
    
  }

  
  public function registerView()
  {
    parent::$applicationData['headTitle'] = 'MORD | Rejestracja';

    $this->setTemplate('rejestracja');
  }


  public function loginUser($post)
  {
    $user = $this->users->loginUser($post);
    if($user)
    {
      $_SESSION['userId'] = $user[0]['id'];
      $_SESSION['userName'] = ucfirst($user[0]['imie']).' '.ucfirst($user[0]['nazwisko']);
      $_SESSION['typKonta'] = $user[0]['typKonta'];
      parent::redirect('/?mod=dashboard&msg=s_loggedIn');
    }
    else
    {
      parent::redirect('/?mod=logowanie&msg=w_errLogin');
    }
  }

  public function logout()
  {
    unset($_SESSION['userId']);
    unset($_SESSION['userName']);
    unset($_SESSION['typKonta']);
    parent::redirect('/');
  }

  public function registerUser($post)
  {
    $user = $this->users->registerUser($post);
    if($user)
    {
      parent::redirect('/?mod=logowanie&msg=s_register');
    }
    else
    {
      parent::redirect('/?mod=rejestracja&msg=w_userExist');
    }
  }

  public function instruktorzyView(){
    parent::$applicationData['headTitle'] = 'MORD | Instruktorzy';

    parent::$applicationData['instruktorList'] = $this->users->getInstruktorList();

    $this->setTemplate('instruktorzy');
  }

  public function kursanciView(){
    parent::$applicationData['headTitle'] = 'MORD | Kursanci';

    parent::$applicationData['kursantList'] = $this->users->getKursantList();

    $this->setTemplate('kursanci');
  }

  public function setUserSettingsView()
  {
    parent::$applicationData['headTitle'] = 'MORD | Zarządzaj użytkownikami';
    if($_SESSION['typKonta'] == 'admin')
    {
      parent::$applicationData['userList'] = $this->users->getUsers();
      $this->setTemplate('zarzadzanieUzytkownikami');
    }
    else
    {
      $this->setTemplate('youShallNotPass');
    }
  }

  public function getUserEditView()
  {
    if($_SESSION['typKonta'] == 'admin')
    {
      parent::$applicationData['userData'] = $this->users->getUser($_GET['id']);
      parent::$applicationData['headTitle'] = 'MORD | Edytuj użytkownika ' . parent::$applicationData['userData'][0]['email'];
      $this->setTemplate('edytujUzytkownika');
    }
    else
    {
      $this->setTemplate('youShallNotPass');
    }
  }

  public function editUser($post)
  {
    var_dump($post);
    die();
  }

  private function setTemplate($templateName)
  {
    ModuleController::$applicationData = parent::$applicationData;
    ModuleController::$template = $templateName;
  }
}