<?php
//include 'ConnectionInterface.php';
class SqlConnector// implements ConnectionInterface
{
  public function __construct() 
  {
    $this->setConnection();
    $this->connect();
  }

  private function setConnection()
  {
    $this->setConfig();
  }
  private function setConfig() 
  {
    $this->database = 'mord';
    $this->user =     'root';
    $this->password = '';
    $this->host =     'localhost';
  }
  private function connect()
  {
    $this->link = new \PDO('mysql:host='. $this->host .';dbname='. $this->database .';port=3306', $this->user, $this->password);
    $this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  public function run($query, $parms=null, $method=null)
  {
    $this->link->query('SET NAMES utf8');
    if($parms !== null)
    {
      $this->parms = $parms;
    }
    if(!empty($this->parms))
    {
      $this->response = $this->link->prepare($query);
      foreach($this->parms as $key => $value)
      {
        $this->response->bindValue(":$key", $value, PDO::PARAM_STR);
      }
      $this->response->execute();
      //$this->insertedID = $this->link->lastInsertedId();
    }
    else
    {
      $this->response = $this->link->query($query);
      //$this->insertedID = $this->response->lastInsertId(); change to fetchColumn(); from LAST_INSERTED_ID
    }
  
  }
  public function getInsertedID()
  {
    return $this->insertedID;
  }

  public function getRow()
  {
      $response = $this->response->fetch(PDO::FETCH_ASSOC);
      return $response;
  }

  public function toArray()
  {
    $dataArray = array();
    while($row = $this->response->fetch(PDO::FETCH_ASSOC))
    {
      
      $dataArray[] = $row;
    }
    return $dataArray;
  }
}