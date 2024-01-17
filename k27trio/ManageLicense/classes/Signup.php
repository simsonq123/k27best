<?php

class Signup extends Dbcon
{

    //Obsługa zapytań związanych z Rejestracją (baza danych)

    protected function editUser($uid, $name, $surename, $email, $role)
    {
//        znaki ? zapobiegają SQL Injection ponieważ odzielamy dane od zapytania
        $stmt = $this->connect()->prepare("UPDATE users SET users_name=?,users_surename=?,users_email=?, users_role=? WHERE users_id=?");

        if (!$stmt->execute(array($name, $surename, $email, $role, $uid))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        $stmt = null;
    }

    protected function setUser($name, $surename, $pwd, $email, $role, $pesel)
    {

//        znaki ? zapobiegają SQL Injection ponieważ odzielamy dane od zapytania
        $stmt = $this->connect()->prepare('INSERT INTO users (users_name,users_surename, users_pwd, users_email, users_role, users_pesel) VALUES (?,?, ?, ?,?,?)');

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        if (!$stmt->execute(array($name, $surename, $hashedPwd, $email, $role, $pesel))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        $stmt = null;
    }


    protected function checkUser($email)
    {
//        znaki ? zapobiegają SQL Injection ponieważ odzielamy dane od zapytania
        $stmt = $this->connect()->prepare('SELECT users_email FROM users WHERE users_email = ?;');

        if (!$stmt->execute(array($email))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $resultCheck = false;

        $loginData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($loginData) > 0) {
            $resultCheck = false;
        } else {
            $resultCheck = true;
        }
        return $resultCheck;
    }
}