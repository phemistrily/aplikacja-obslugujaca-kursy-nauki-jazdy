<?php
class Courses
{
    public function __construct()
    {
        Sql::connectSql1();
    }


    public function getCoursesList()
    {
        $query = "SELECT kj.*, k.nazwa as kategoria, u.imie, u.nazwisko FROM kursprawajazdy kj INNER JOIN kategoria k ON k.idKategoria = kj.idKategoria INNER JOIN users u ON u.id = kj.idInstruktor";

        Sql::$sql1->run($query);
        return Sql::$sql1->toArray();
    }

    public function getMyCoursesList(){
        $params = [
            'kursantId' => $_SESSION['userId']
        ];
        $query = "SELECT kkpj.*, kkpj.idInstruktor as potrzebujeTegoRobcieToCzytelniej, kpj.*, k.nazwa as kategoria, CONCAT(u.imie,' ',u.nazwisko) AS instruktorKursu, CONCAT(uj.imie,' ',uj.nazwisko) AS instruktorJazd, kkpj.opinia FROM kursantkursprawajazdy kkpj INNER JOIN kursprawajazdy kpj ON kpj.idKursPrawaJazdy = kkpj.idKursPrawaJazdy INNER JOIN kategoria k ON k.idKategoria = kpj.idKategoria INNER JOIN users u ON u.id = kpj.idInstruktor INNER JOIN users uj ON uj.id = kkpj.idInstruktor WHERE kkpj.idKursant = :kursantId AND kkpj.rezygnacja != 1";
        Sql::$sql1->run($query, $params);   
        return Sql::$sql1->toArray();
    }

    public function editCourseUser($courseData)
    {
        if(!$courseData['id'] && !is_numeric($courseData['id']))
        {
            return false;
        }
        foreach ($courseData as $key => $value) {
            $toUpdate = '';
            switch ($key) {
                case 'idInstruktor':
                case 'opinia':
                    $toUpdate = $key;
                    break;
                
                default:
                    # code...
                    break;
            }
            if ($toUpdate)
            {
                $query = "UPDATE kursantkursprawajazdy SET $toUpdate = '$value' WHERE idKursantKursPrawaJazdy = " . $courseData['id'];
                Sql::$sql1->run($query);
            }
        }
        return $courseData['id'];
    }


    public function zapiszNaKurs($courseData){
        $params = [
            'kursId' => $courseData['kursId'],
            'kursantId' => $_SESSION['userId'],
        ];

        $query = "SELECT * FROM kursantkursprawajazdy WHERE idKursant = :kursantId AND idKursPrawaJazdy = :kursId AND rezygnacja != 1";
        Sql::$sql1->run($query, $params);
        if(Sql::$sql1->toArray()){
            return false;
        } else {
            $params['instruktorId'] = 4;
            $params['samochodId'] = 3;
            $query = "INSERT INTO kursantkursprawajazdy(idKursant, idKursPrawaJazdy, idInstruktor, idSamochod) VALUES(:kursantId, :kursId, :instruktorId, :samochodId)";
            Sql::$sql1->run($query, $params);

            $params = [
                'kursId' => $courseData['kursId'],
                'kursantId' => $_SESSION['userId'],
            ];
            $terminPlat = strtotime($courseData['kursData']);
            $terminPlat = strtotime('+7 day', $terminPlat);
            $terminPlat = date('Y-m-d', $terminPlat);
            $params['terminPlatnosci'] = $terminPlat;
            $params['kursCena'] = $courseData['kursCena'];

            $query = "INSERT INTO platnosc(idKursant, kwota, terminPlatnosci, idKursPrawaJazdy) VALUES(:kursantId, :kursCena, :terminPlatnosci, :kursId)";
            Sql::$sql1->run($query, $params);
            return true;
        }
    }

    public function rezygnujKurs($courseData){
        $params = [
            'kursId' => $courseData['kursId'],
            'kursantId' => $_SESSION['userId']
        ];

        $query = "UPDATE kursantkursprawajazdy SET rezygnacja = '1' WHERE idKursant = :kursantId AND idKursPrawaJazdy = :kursId AND rezygnacja = 0";
        Sql::$sql1->run($query, $params);

        $query = "SELECT idPlatnosc FROM platnosc WHERE idKursant = :kursantId AND idKursPrawaJazdy = :kursId AND rezygnacja = 0";
        Sql::$sql1->run($query, $params);
        $rowPaymantId = Sql::$sql1->toArray();

        $query = "UPDATE platnosc SET rezygnacja = '1' WHERE idKursant = :kursantId AND idKursPrawaJazdy = :kursId AND rezygnacja = 0";
        Sql::$sql1->run($query, $params);

        $params = [
            'kursantId' => $_SESSION['userId'],
            'platnoscId' => $rowPaymantId[0]['idPlatnosc']
        ];
        $query = "UPDATE raty SET rezygnacja = '1' WHERE idKursant = :kursantId AND idPlatnosc = :platnoscId AND rezygnacja = 0";
        Sql::$sql1->run($query, $params);

        return true;
    }
}

?>