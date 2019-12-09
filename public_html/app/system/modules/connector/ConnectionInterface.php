<?php
namespace App\System\Connector;

interface ConnectionInterface
{
    public function run($dataString,$parm,$method);
    public function toArray();
    public function getRow();
    public function getInsertedID();
}
?>