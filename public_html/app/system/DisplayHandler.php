<?php
class DisplayHandler
{
  private $smarty;

  public function __construct()
  {
    $this->templateInitialize();
    $this->classesInitialize();
  }

  protected function templateInitialize()
  {
    $this->smarty = new Smarty();
    $this->smarty->setTemplateDir(CONFIG['templatesPath'].'/templates/'.CONFIG['themeFolder'].'/');
    $this->smarty->setCompileDir(CONFIG['templatesPath'].'/templates_c');
    $this->smarty->setCacheDir(CONFIG['templatesPath'].'/cache');
    $this->smarty->setConfigDir(CONFIG['templatesPath'].'/configs');
  }

  protected function classesInitialize()
  {
    //
  }

  protected function render($applicationData)
  {
    if (isset($_SESSION) && !empty($_SESSION))
    {
      $this->systemData = [
        'session' => $_SESSION,
        'get' => $_GET,
        'post'=> $_POST
      ];
    }
    else
    {
      $this->systemData = [
        'get' => $_GET,
        'post' => $_POST
      ];
    }
    
    

    $this->smarty->assign('applicationData',$applicationData);
    $this->smarty->assign('systemData',$this->systemData);
    $this->smarty->display('index.html');
    if(CONFIG['debug'] == true)
    {
        var_dump($this->smarty->tpl_vars['systemData']->value);
        var_dump($this->smarty->tpl_vars['applicationData']->value);
    }
  }
}