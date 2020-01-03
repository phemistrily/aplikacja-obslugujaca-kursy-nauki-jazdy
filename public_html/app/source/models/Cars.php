<?php
class Cars
{
    public function __construct()
    {
        Sql::connectSql1();
    }

    public function getCars()
    {
        $query = "SELECT * FROM samochod";

        Sql::$sql1->run($query);
        return Sql::$sql1->toArray();
    }
}