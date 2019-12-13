<?php
abstract class Sql {
    public static $sql1;
    public static $sql2;

    public static function connectSql1(){
        self::$sql1 = new ConnectionManager('mysql');
    }

    public static function connectSql2(){
        //self::$sql2 = new ConnectionManager('...');
    }
}
?>