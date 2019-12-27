<?php
class Users
{
    public function __construct()
    {
        Sql::connectSql1();
    }

    public function getUsers()
    {
        $query = "SELECT * FROM users";

        Sql::$sql1->run($query);
        return Sql::$sql1->toArray();
    }

    public function loginUser($email, $password)
    {
        $parms = [
        'email' => $email,
        'password' => $password
        ];
        $query = "SELECT id, email FROM users WHERE email = :email AND password = :password";
        Sql::$sql1->run($query, $parms);
        return Sql::$sql1->toArray();
    }

    public function getInstruktorList()
    {
        $query = "SELECT * FROM users WHERE typKonta = 'instruktor'";

        Sql::$sql1->run($query, $parms);
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