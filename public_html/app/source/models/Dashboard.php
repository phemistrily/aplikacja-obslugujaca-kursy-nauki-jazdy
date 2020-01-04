<?php
class Dashboard
{
    public function __construct()
    {
        Sql::connectSql1();
    }

    public function getoOsrodkuList()
    {
        $query = "SELECT * from users";

        Sql::$sql1->run($query);
        return Sql::$sql1->toArray();
    }

}

?>