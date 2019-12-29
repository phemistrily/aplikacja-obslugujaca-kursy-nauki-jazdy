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

    public function getMojeKursyList(){
        $params = [
            'kursantId' => $_SESSION['userId']
        ];
        $query = "SELECT kkpj.*, kpj.*, k.nazwa as kategoria, u.imie as imieI, u.nazwisko as nazwiskoI FROM kursantkursprawajazdy kkpj INNER JOIN kursprawajazdy kpj ON kpj.idKursPrawaJazdy = kkpj.idKursPrawaJazdy INNER JOIN kategoria k ON k.idKategoria = kpj.idKategoria INNER JOIN users u ON u.id = kpj.idInstruktor WHERE kkpj.idKursant = :kursantId AND kkpj.rezygnacja != 1";
        Sql::$sql1->run($query, $params);
        return Sql::$sql1->toArray();
    }


    public function zapiszNaKurs($kursData){
        $params = [
            'kursId' => $kursData['kursId'],
            'kursantId' => $_SESSION['userId']
        ];

        $query = "SELECT * FROM kursantkursprawajazdy WHERE idKursant = :kursantId AND idKursPrawaJazdy = :kursId AND rezygnacja != 1";
        Sql::$sql1->run($query, $params);
        if(Sql::$sql1->toArray()){
            return false;
        } else {
            $query = "INSERT INTO kursantkursprawajazdy(idKursant, idKursPrawaJazdy) VALUES(:kursantId, :kursId)";
            Sql::$sql1->run($query, $params);

            $terminPlat = strtotime($kursData['kursData']);
            $terminPlat = strtotime('+7 day', $terminPlat);
            $terminPlat = date('Y-m-d', $terminPlat);
            $params['terminPlatnosci'] = $terminPlat;
            $params['kursCena'] = $kursData['kursCena'];

            $query = "INSERT INTO platnosc(idKursant, kwota, terminPlatnosci, idKursPrawaJazdy) VALUES(:kursantId, :kursCena, :terminPlatnosci, :kursId)";
            Sql::$sql1->run($query, $params);
            return true;
        }
    }

    public function rezygnujKurs($kursData){
        $params = [
            'kursId' => $kursData['kursId'],
            'kursantId' => $_SESSION['userId']
        ];

        $query = "UPDATE kursantkursprawajazdy SET rezygnacja = '1' WHERE idKursant = :kursantId AND idKursPrawaJazdy = :kursId AND rezygnacja = 0";
        Sql::$sql1->run($query, $params);

        $query = "UPDATE platnosc SET rezygnacja = '1' WHERE idKursant = :kursantId AND idKursPrawaJazdy = :kursId AND rezygnacja = 0";
        Sql::$sql1->run($query, $params);

        return true;
    }
}

?>