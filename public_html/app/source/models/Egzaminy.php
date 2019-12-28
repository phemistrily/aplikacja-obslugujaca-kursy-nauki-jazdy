<?php
class Egzaminy
{
    public function __construct()
    {
        Sql::connectSql1();
    }

    public function getEgzaminyList()
    {
        $query = "SELECT e.*, k.nazwa as kategoria, ui.imie as imieI, ui.nazwisko as nazwiskoI, ke.idKursant, uk.imie as imieK, uk.nazwisko as nazwiskoK FROM egzamin e INNER JOIN kategoria k ON k.idKategoria = e.idKategoria INNER JOIN users ui ON ui.id = e.idInstruktor INNER JOIN kursantegzamin ke ON ke.idEgzamin = e.idEgzamin INNER JOIN users uk ON uk.id = ke.idKursant";

        Sql::$sql1->run($query);
        return Sql::$sql1->toArray();
    }
}

?>