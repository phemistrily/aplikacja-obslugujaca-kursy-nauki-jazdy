<?php
class ConnectionManager
{
  public $source;

  protected $data;

  public function __construct($source)
  {
    $this->source = $source;
  }

  public function chooseDataSource()
  {
    switch ($this->source) {
      case 'mysql':
        include 'SqlConnector.php';
        $this->data = new SqlConnector();
        break;
      default:
        # code...
        break;
    }
  }

  public function run($dataString, $parms = null, $method = null)
  {
    if(empty($this->data))
    {
      $this->chooseDataSource();
    }
    $this->data->run($dataString, $parms, $method);
  }

  public function toArray()
  {
    return $this->data->toArray();
  }

  public function getRow()
  {
    return $this->data->getRow();
  }

  public function getInsertedId()
  {
    return $this->data->getInsertedId();
  }
}