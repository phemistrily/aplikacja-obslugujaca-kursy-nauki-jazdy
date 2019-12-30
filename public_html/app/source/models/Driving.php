<?php
class Driving
{
    public function __construct()
    {
        Sql::connectSql1();
    }


    public function getMyDrivingList(){
        $params = [
            'kursantId' => $_SESSION['userId']
        ];
        $query = "SELECT js.*, u.imie as imieI, u.nazwisko as nazwiskoI, CONCAT(s.marka,' ',s.model) AS samochod FROM jazdaszkoleniowa js INNER JOIN users u ON u.id = js.idInstruktor INNER JOIN samochod s ON s.idSamochod = js.idSamochod WHERE js.idKursant = 8";
        Sql::$sql1->run($query, $params);
        return Sql::$sql1->toArray();
    }


    public function registerDriving($drivingData){
        $params = [
            'kursantId' => $_SESSION['userId'],
        ];

        $query = "SELECT idInstruktor, idSamochod FROM kursantkursprawajazdy WHERE idKursant = :kursantId AND rezygnacja != 1";
        Sql::$sql1->run($query, $params);
        $rowIdInstruktor = Sql::$sql1->toArray();
        
        $params = [
            'kursantId' => $_SESSION['userId'],
            'dataJazdy' => $drivingData['dataJazdy'],
            'godzStart' => $drivingData['godzStart'],
            'godzStop' => $drivingData['godzStop'],
            'instruktorId' => $rowIdInstruktor[0]['idInstruktor'],
            'samochodId' => $rowIdInstruktor[0]['idSamochod']
        ];

        $query = "INSERT INTO jazdaszkoleniowa(data, godzinaRozpoczecia, godzinaZakonczenia, idKursant, idInstruktor, idSamochod) VALUES(:dataJazdy, :godzStart, :godzStop, :kursantId, :instruktorId, :samochodId)";
        Sql::$sql1->run($query, $params);

        return true;
    }
}
?>