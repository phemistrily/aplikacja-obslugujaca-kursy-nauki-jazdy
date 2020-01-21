<?php
class Exams
{
    public function __construct()
    {
        Sql::connectSql1();
    }

    public function getExamsList()
    {
        $query = "SELECT e.*, 
        k.nazwa as kategoria,
        ui.imie as imieI,
        ui.nazwisko as nazwiskoI, 
        ke.idKursant, 
        uk.imie as imieK, 
        uk.nazwisko as nazwiskoK 
        FROM egzamin e 
        INNER JOIN kategoria k ON k.idKategoria = e.idKategoria 
        INNER JOIN users ui ON ui.id = e.idInstruktor 
        INNER JOIN kursantegzamin ke ON ke.idEgzamin = e.idEgzamin 
        INNER JOIN users uk ON uk.id = ke.idKursant";

        Sql::$sql1->run($query);
        return Sql::$sql1->toArray();
    }

    public function getMyExamsList()
    {
        $params = [
            'kursantId' => $_SESSION['userId']
        ];
        $query = "SELECT e.*,
         k.nazwa as kategoria,
         ui.imie as imieI,
         ui.nazwisko as nazwiskoI,
         ke.idKursant, 
         uk.imie as imieK, 
         uk.nazwisko as nazwiskoK 
         FROM egzamin e 
         INNER JOIN kategoria k ON k.idKategoria = e.idKategoria 
         INNER JOIN users ui ON ui.id = e.idInstruktor 
         INNER JOIN kursantegzamin ke ON ke.idEgzamin = e.idEgzamin 
         INNER JOIN users uk ON uk.id = ke.idKursant 
         WHERE ke.idKursant = :kursantId";

        Sql::$sql1->run($query, $params);
        return Sql::$sql1->toArray();
    }

    public function getExamsForInstruktor($instruktorId)
    {
        $parms = [
            'instruktorId' => $instruktorId
        ];

        $query = "SELECT e.*,
        k.nazwa as kategoria,
        ui.imie as imieI,
        ui.nazwisko as nawziskoI,
        ke.idKursant,
        uk.imie as imieK,
        uk.nazwisko as nazwiskoK,
        IF(e.data > NOW(), 0, 1) as dataStart
        FROM egzamin e 
        LEFT JOIN kategoria k ON k.idKategoria = e.idKategoria 
        INNER JOIN users ui ON ui.id = e.idInstruktor 
        INNER JOIN kursantegzamin ke ON ke.idEgzamin = e.idEgzamin 
        INNER JOIN users uk ON uk.id = ke.idKursant WHERE e.idInstruktor = :instruktorId
        ";

        Sql::$sql1->run($query,$parms);
        return Sql::$sql1->toArray();
    }

    public function getMyPlannedExamsList()
    {
        $params = [
            'kursantId' => $_SESSION['userId']
        ];
        $query = "SELECT * FROM kursantegzamin ke 
        INNER JOIN egzamin e 
        ON ke.idEgzamin = e.idEgzamin 
        WHERE ke.idKursant = :kursantId 
        AND wynik = ''";

        Sql::$sql1->run($query, $params);
        return Sql::$sql1->toArray();
    }


    public function getMyPracticalExamList()
    {
        $params = [
            'kursantId' => $_SESSION['userId']
        ];
        $query = "SELECT e.*, 
        k.nazwa as kategoria, 
        ui.imie as imieI, 
        ui.nazwisko as nazwiskoI, 
        ke.idKursant, 
        uk.imie as imieK, 
        uk.nazwisko as nazwiskoK FROM egzamin e 
        INNER JOIN kategoria k ON k.idKategoria = e.idKategoria 
        INNER JOIN users ui ON ui.id = e.idInstruktor 
        INNER JOIN kursantegzamin ke ON ke.idEgzamin = e.idEgzamin 
        INNER JOIN users uk ON uk.id = ke.idKursant 
        WHERE ke.idKursant = :kursantId";

        Sql::$sql1->run($query, $params);
        return Sql::$sql1->toArray();
    }



    public function getTheoryExamsList()
    {
        $query = "SELECT * FROM egzamin WHERE typ = 'teoretyczny' AND selected = 0";

        Sql::$sql1->run($query);
        return Sql::$sql1->toArray();
    }

    public function getPraticalExamsList()
    {
        $query = "SELECT * FROM egzamin WHERE typ = 'praktyczny' AND selected = 0";

        Sql::$sql1->run($query);
        return Sql::$sql1->toArray();
    }



    public function chooseTheoryExam($examData){
        $params = [
            'egzaminId' => $examData['egzaminId']
        ];
        $query = "UPDATE egzamin SET selected = '1'  WHERE idEgzamin = :egzaminId";
        Sql::$sql1->run($query, $params);


        $params = [
            'kursantId' => $_SESSION['userId'],
            'egzaminId' => $examData['egzaminId']
        ];
        $query = "INSERT INTO kursantegzamin (idKursant, idEgzamin) VALUES(:kursantId, :egzaminId)";
        Sql::$sql1->run($query, $params);


        $paymentTime = strtotime(date('Y-m-d'));
        $paymentTime = strtotime('+3 day', $paymentTime);
        $paymentTime = date('Y-m-d', $paymentTime);

        $params = [
            'kursantId' => $_SESSION['userId'],
            'egzaminId' => $examData['egzaminId'],
            'kwota' => '30',
            'terminPlatnosci' => $paymentTime,
        ];
        $query = "INSERT INTO platnosc (idKursant, kwota, terminPlatnosci, idEgzamin) 
        VALUES(:kursantId, :kwota, :terminPlatnosci, :egzaminId)";
        Sql::$sql1->run($query, $params);

        return true;
    }

    public function choosePracticalExam($examData){
        $params = [
            'egzaminId' => $examData['egzaminId']
        ];
        $query = "UPDATE egzamin SET selected = '1'  WHERE idEgzamin = :egzaminId";
        Sql::$sql1->run($query, $params);


        $params = [
            'kursantId' => $_SESSION['userId'],
            'egzaminId' => $examData['egzaminId']
        ];
        $query = "INSERT INTO kursantegzamin (idKursant, idEgzamin) VALUES(:kursantId, :egzaminId)";
        Sql::$sql1->run($query, $params);


        $paymentTime = strtotime(date('Y-m-d'));
        $paymentTime = strtotime('+3 day', $paymentTime);
        $paymentTime = date('Y-m-d', $paymentTime);

        $params = [
            'kursantId' => $_SESSION['userId'],
            'egzaminId' => $examData['egzaminId'],
            'kwota' => '140',
            'terminPlatnosci' => $paymentTime,
        ];
        $query = "INSERT INTO platnosc (idKursant, kwota, terminPlatnosci, idEgzamin) VALUES(:kursantId, :kwota, :terminPlatnosci, :egzaminId)";
        Sql::$sql1->run($query, $params);

        return true;
    }

    public function zaliczExam($examId)
    {
        $parms = [
            'egzaminId' => $examId
        ];
        $query = "UPDATE egzamin SET wynik = 'pozytywny' WHERE idEgzamin = :egzaminId";
        
        Sql::$sql1->run($query, $parms);
        return true;
    }

    public function nieZaliczExam($examId)
    {
        $parms = [
            'egzaminId' => $examId
        ];
        $query = "UPDATE egzamin SET wynik = 'negatywny' WHERE idEgzamin = :egzaminId";
        
        Sql::$sql1->run($query, $parms);
        return true;
    }

    public function addExam($examData)
    {
        $examData['date'] = str_replace('T', ' ',$examData['date']).':00';
        $query = "CALL addNewEgzaminDate('".$examData['date']."','".$examData['type']."')";
        Sql::$sql1->run($query);
        return true;
    }
}

?>