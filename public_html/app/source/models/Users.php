<?php
class Users
{
    public function __construct()
    {
        Sql::connectSql1();
    }

    public function getUsers()
    {
        $query = "SELECT id,
        email,
        imie,
        nazwisko,
        dataUrodzenia,
        pesel,
        adresZamieszkania,
        numerTelefonu,
        typKonta FROM users";

        Sql::$sql1->run($query);
        return Sql::$sql1->toArray();
    }

    public function getUser($id)
    {
        $query = "SELECT id,
        email,
        imie,
        nazwisko,
        dataUrodzenia,
        pesel,
        adresZamieszkania,
        numerTelefonu,
        typKonta FROM users
        WHERE id = $id";

        Sql::$sql1->run($query);
        return Sql::$sql1->toArray();
    }

    public function editUser($userData)
    {
        if(!$userData['id'] && !is_numeric($userData['id']))
        {
            return false;
        }
        foreach ($userData as $key => $value) {
            var_dump($key);
            var_dump($value);
            $toUpdate = '';
            switch ($key) {
                case 'imie':
                case 'nazwisko':
                case 'dataUrodzenia':
                case 'pesel':
                case 'adresZamieszkania':
                case 'numerTelefonu':
                    $toUpdate = $key;
                    break;
                
                default:
                    # code...
                    break;
            }
            if ($toUpdate)
            {
                $query = "UPDATE users SET $toUpdate = '$value'";
                var_dump($query);
                //Sql::$sql1->run($query);
            }
        }
    }

    public function loginUser($loginData)
    {
        $parms = [
        'email' => $loginData['email'],
        'password' => sha1($loginData['password'])
        ];
        $query = "SELECT id, email, imie, nazwisko, typKonta FROM users WHERE email = :email AND password = :password";
        Sql::$sql1->run($query, $parms);
        return Sql::$sql1->toArray();
    }

    public function registerUser($userData)
    {
        $login = $userData['email'];
        $password = sha1($userData['password']);
        $imie = $userData['imie'];
        $nazwisko = $userData['nazwisko'];
        $dataUrodzenia = $userData['dataUrodzenia'];
        $pesel = $userData['pesel'];
        $adres = $userData['adres'];
        $numerTelefonu = $userData['numerTelefonu'];

        if(empty($login))
        {
            return false;
        }
        if(empty($password))
        {
            return false;
        }
        if($this->checkUserExist($login))
        {
            return false;
        }

        $parms = [
            'login' => $login,
            'password' => $password,
            'imie' => $imie,
            'nazwisko' => $nazwisko,
            'dataUrodzenia' => $dataUrodzenia,
            'pesel' => $pesel,
            'adres' => $adres,
            'numerTelefonu' => $numerTelefonu
        ];
        $query = "INSERT INTO users (email,password,imie,nazwisko,dataUrodzenia,pesel,adresZamieszkania,numerTelefonu,typKonta) VALUES (:login,:password,:imie,:nazwisko,:dataUrodzenia,:pesel,:adres,:numerTelefonu,'kursant')";
        Sql::$sql1->run($query, $parms);
        return true;
    }

    private function checkUserExist($login)
    {
        $query = "SELECT id FROM users where email = :login";
        $parms = [
            'login' => $login
        ];
        Sql::$sql1->run($query, $parms);
        return Sql::$sql1->getRow();
    }

    public function getInstruktorList()
    {
        $query = "SELECT * FROM users WHERE typKonta = 'instruktor'";

        Sql::$sql1->run($query);
        return Sql::$sql1->toArray();
    }

    public function getKursantList()
    {
        $query = "SELECT * FROM users WHERE typKonta = 'kursant'";

        Sql::$sql1->run($query);
        return Sql::$sql1->toArray();
    }
}

?>