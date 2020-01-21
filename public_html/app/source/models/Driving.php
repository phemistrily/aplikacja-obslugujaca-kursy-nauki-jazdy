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
        $query = "SELECT js.*, 
        u.imie as imieI, 
        u.nazwisko as nazwiskoI, 
        CONCAT(s.marka,' ',s.model) AS samochod 
        FROM jazdaszkoleniowa js 
        INNER JOIN users u ON u.id = js.idInstruktor 
        INNER JOIN samochod s ON s.idSamochod = js.idSamochod 
        WHERE js.idKursant = :kursantId";
        Sql::$sql1->run($query, $params);
        return Sql::$sql1->toArray();
    }


    public function registerDriving($drivingData){
        $params = [
            'kursantId' => $_SESSION['userId'],
        ];

        $query = "SELECT idInstruktor, 
        idSamochod 
        FROM kursantkursprawajazdy 
        WHERE idKursant = :kursantId AND rezygnacja != 1";
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

        $query = "INSERT INTO jazdaszkoleniowa(data, 
        godzinaRozpoczecia, 
        godzinaZakonczenia, 
        idKursant, 
        idInstruktor, 
        idSamochod) 
        VALUES(:dataJazdy, :godzStart, :godzStop, :kursantId, :instruktorId, :samochodId)";
        Sql::$sql1->run($query, $params);

        return true;
    }


    public function buyDriving($drivingData){
        $params = [
            'kursantId' => $_SESSION['userId'],
        ];

        $query = "SELECT idInstruktor, 
        idSamochod FROM kursantkursprawajazdy 
        WHERE idKursant = :kursantId AND rezygnacja != 1";
        Sql::$sql1->run($query, $params);
        $rowIdInstruktor = Sql::$sql1->toArray();
        
        $params = [
            'kursantId' => $_SESSION['userId'],
            'dataJazdy' => $drivingData['dataJazdy'],
            'godzStart' => $drivingData['godzStart'],
            'godzStop' => $drivingData['godzStop'],
            'instruktorId' => $rowIdInstruktor[0]['idInstruktor'],
            'samochodId' => $rowIdInstruktor[0]['idSamochod'],
            'buy' => '1'
        ];

        $time = $drivingData['godzStop'] - $drivingData['godzStart'];
        $drivingPrice = $time * 30;

        $terminPlatnosci = strtotime(date('Y-m-d'));
        $terminPlatnosci = strtotime('+3 day', $terminPlatnosci);
        $terminPlatnosci = date('Y-m-d', $terminPlatnosci);
        
        $query = "INSERT INTO jazdaszkoleniowa(data, godzinaRozpoczecia, godzinaZakonczenia, idKursant, idInstruktor, idSamochod, buy) VALUES(:dataJazdy, :godzStart, :godzStop, :kursantId, :instruktorId, :samochodId, :buy)";
        Sql::$sql1->run($query, $params);

        $params = [
            'kursantId' => $_SESSION['userId'],
        ];
        $query = "SELECT idJazdaSzkoleniowa 
        FROM jazdaszkoleniowa 
        WHERE idKursant = :kursantId AND buy = 1 ORDER BY idJazdaSzkoleniowa DESC LIMIT 1";
        Sql::$sql1->run($query, $params);
        $rowIdDriving = Sql::$sql1->toArray();
        
        $params = [
            'kursantId' => $_SESSION['userId'],
            'jazdaSzkoleniowaId' => $rowIdDriving[0]['idJazdaSzkoleniowa'],
            'kwota' => $drivingPrice,
            'terminPlatnosci' => $terminPlatnosci
        ];
        $query = "INSERT INTO platnosc(idKursant, kwota, terminPlatnosci, idJazdaSzkoleniowa) 
        VALUES(:kursantId, :kwota, :terminPlatnosci, :jazdaSzkoleniowaId)";
        Sql::$sql1->run($query, $params);
        
        return true;
    }
}
?>