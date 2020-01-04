<?php
class Cars
{
    public function __construct()
    {
        Sql::connectSql1();
    }

    public function getCars()
    {
        $query = "SELECT * FROM samochod";

        Sql::$sql1->run($query);
        return Sql::$sql1->toArray();
    }

    public function getCar($id)
    {
        if(!$id)
        {
            return false;
        }
        $query = "SELECT * FROM samochod WHERE idSamochod = $id";
        Sql::$sql1->run($query);
        return Sql::$sql1->toArray();
    }

    public function editCar($carData)
    {
        if(!$carData['id'] && !is_numeric($carData['id']))
        {
            return false;
        }
        foreach ($carData as $key => $value) {
            $toUpdate = '';
            switch ($key) {
                case 'marka':
                case 'model':
                case 'rokProdukcji':
                case 'numerRejestracyjny':
                case 'vin':
                case 'status':
                    $toUpdate = $key;
                    break;
                
                default:
                    # code...
                    break;
            }
            if ($toUpdate)
            {
                $query = "UPDATE samochod SET $toUpdate = '$value' WHERE idSamochod = " . $carData['id'];
                Sql::$sql1->run($query);
            }
        }
        return $carData['id'];
    }
}