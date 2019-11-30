<?php
include 'ModuleController.php';
class InitializeApplication
{
  public function __construct()
  {
    new ModuleController();
  }
}