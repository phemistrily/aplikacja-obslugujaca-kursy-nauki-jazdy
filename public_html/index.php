<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE); 
require_once('../vendor/autoload.php');
require_once('app/system/config/config.php');
include 'app/system/InitializeApplication.php';
new InitializeApplication();
var_dump($_SESSION);