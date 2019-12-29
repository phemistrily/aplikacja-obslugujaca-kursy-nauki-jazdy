<?php
class Platnosci
{
    public function __construct()
    {
        Sql::connectSql1();
    }

    public function getMojePlatnosciList(){
        $params = [
            'kursantId' => $_SESSION['userId']
        ];
        $query = "SELECT * FROM platnosc WHERE idKursant = :kursantId AND rezygnacja != 1";
        Sql::$sql1->run($query, $params);
        return Sql::$sql1->toArray();
    }

    public function getMojeRatyList(){
        $params = [
            'kursantId' => $_SESSION['userId']
        ];
        $query = "SELECT * FROM raty WHERE idKursant = :kursantId";
        Sql::$sql1->run($query, $params);
        return Sql::$sql1->toArray();
    }
    

    public function wlaczRaty($platnosciData){
        

        $kwota = $platnosciData['platnoscKwota'];
        $kwotaRaty = $kwota / 3;

        $dataKursuStart = strtotime($platnosciData['terminPlatnosci']);
        $dataKursuStart = strtotime('-7 day', $dataKursuStart);
        
        $dataRaty1 = strtotime('+10 day', $dataKursuStart);
        $dataRaty1 = date('Y-m-d', $dataRaty1);

        $dataRaty2 = strtotime('+20 day', $dataKursuStart);
        $dataRaty2 = date('Y-m-d', $dataRaty2);

        $dataRaty3 = strtotime('+30 day', $dataKursuStart);
        $dataRaty3 = date('Y-m-d', $dataRaty3);

        $params = [
            'platnoscId' => $platnosciData['platnoscId'],
            'terminPlatnosci' => $dataRaty3
        ];
        $query = "UPDATE platnosc SET raty = '1', terminPlatnosci = :terminPlatnosci WHERE idPlatnosc = :platnoscId";
        Sql::$sql1->run($query, $params);


        $params['kursantId'] = $_SESSION['userId'];
        $params['kwotaRaty'] = $kwotaRaty;
        $params['terminPlatnosci'] = $dataRaty1;
        $query = "INSERT INTO raty(idPlatnosc, kwota, terminPlatnosci, idKursant) VALUES(:platnoscId, :kwotaRaty, :terminPlatnosci, :kursantId)";
        Sql::$sql1->run($query, $params);
        
        $params['terminPlatnosci'] = $dataRaty2;
        $query = "INSERT INTO raty(idPlatnosc, kwota, terminPlatnosci, idKursant) VALUES(:platnoscId, :kwotaRaty, :terminPlatnosci, :kursantId)";
        Sql::$sql1->run($query, $params);

        $params['terminPlatnosci'] = $dataRaty3;
        $query = "INSERT INTO raty(idPlatnosc, kwota, terminPlatnosci, idKursant) VALUES(:platnoscId, :kwotaRaty, :terminPlatnosci, :kursantId)";
        Sql::$sql1->run($query, $params);
    }

    
}

?>