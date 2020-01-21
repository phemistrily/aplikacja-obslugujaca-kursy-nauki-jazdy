<?php
class Payments
{
    public function __construct()
    {
        Sql::connectSql1();
    }

    public function getMyPaymentsList(){
        $params = [
            'kursantId' => $_SESSION['userId']
        ];
        $query = "SELECT * FROM platnosc WHERE idKursant = :kursantId AND rezygnacja != 1 ORDER BY idPlatnosc DESC";
        Sql::$sql1->run($query, $params);
        return Sql::$sql1->toArray();
    }

    public function getMojeRatyList(){
        $params = [
            'kursantId' => $_SESSION['userId']
        ];
        $query = "SELECT * FROM raty WHERE idKursant = :kursantId AND rezygnacja = 0 ORDER BY idPlatnosc DESC, terminPlatnosci ASC";
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


    public function paymentCourse($paymentData){
        $paymentDate = date('Y-m-d');

        $params = [
            'dataWplaty' => $paymentDate,
            'platnoscId' => $paymentData['platnoscId']
        ];
        $query = "UPDATE platnosc SET oplacone = 1 ,dataWplaty = :dataWplaty  WHERE idPlatnosc = :platnoscId";
        Sql::$sql1->run($query, $params);
        return true;
    }


    public function paymentPartCourse($paymentData){
        $paymentDate = date('Y-m-d');
        
        $idRaty = $paymentData['ratyId'];
        $idPlatnosc = $paymentData['platnoscId'];

       

        $params = [
            'dataWplaty' => $paymentDate,
            'ratyId' => $idRaty
        ];
        $query = "UPDATE raty SET dataWplaty = :dataWplaty  WHERE idRaty = :ratyId";
        Sql::$sql1->run($query, $params);


        $params = [
            'platnoscId' => $idPlatnosc
        ];
        $query = "SELECT SUM(kwota) AS amountSum FROM raty WHERE idPlatnosc = :platnoscId";
        Sql::$sql1->run($query, $params);
        $rowAmountSum = Sql::$sql1->toArray();
        $amountSum = $rowAmountSum[0]['amountSum'];

        $query = "SELECT SUM(kwota) AS paymentSum FROM raty WHERE idPlatnosc = :platnoscId AND dataWplaty != ''";
        Sql::$sql1->run($query, $params);
        $rowPaymentSum = Sql::$sql1->toArray();
        $paymentSum = $rowPaymentSum[0]['paymentSum'];

        
        if($paymentSum == $amountSum) 
        {
            $params = [
                'dataWplaty' => $paymentDate,
                'platnoscId' => $idPlatnosc
            ];
            $query = "UPDATE platnosc SET dataWplaty = :dataWplaty  WHERE idPlatnosc = :platnoscId";
            Sql::$sql1->run($query, $params);
        }
        return true;
    }
    
}

?>