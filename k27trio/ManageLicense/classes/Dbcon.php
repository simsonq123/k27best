<?php


class Dbcon
{
//Klasa służąca do łączenia się z bazą danych

    protected function connect()
    {
        try {
            $username = "root";
            $password = "";
            $dbcon = new PDO('mysql:host=localhost;dbname=wojciech', $username, $password);
            return $dbcon;
        } catch (PDOException $e) {
            print "Errooooooooor!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function getConnection()
    {
        return $this->connect();
    }

}

$dbcon = new Dbcon(); // Tworzenie instancji klasy Dbcon
$connection = $dbcon->getConnection(); // Nawiązywanie połączenia z bazą danych
