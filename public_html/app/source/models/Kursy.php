<?php
class Kursy
{
    public function __construct()
    {
        Sql::connectSql1();
    }


    public function getKursyList()
    {
        $query = "SELECT kj.*, k.nazwa as kategoria, u.imie, u.nazwisko FROM kursprawajazdy kj INNER JOIN kategoria k ON k.idKategoria = kj.idKategoria INNER JOIN users u ON u.id = kj.idInstruktor";

        Sql::$sql1->run($query);
        return Sql::$sql1->toArray();
    }

}

?>