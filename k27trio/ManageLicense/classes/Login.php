<?php

class Login extends Dbcon
{

    //Obsługa zapytań związanych z Logowaniem (baza danych)

    protected function getUser($email, $pwd, &$errors)
    {

//        znaki ? zapobiegają SQL Injection ponieważ odzielamy dane od zapytania
        $stmt = $this->connect()->prepare('SELECT users_pwd FROM users WHERE users_email = ?;');
        $isValid = true;

        if (!$stmt->execute(array($email))) {
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $loginData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($loginData) == 0) {
            $errors['email'] = "Nie ma takiego Emaila";
            $isValid = false;
        } else {
            $checkPwd = password_verify($pwd, $loginData[0]["users_pwd"]);

            if ($checkPwd == false) {
                $errors['pwd'] = "Nieprawidłowe hasło";
                $isValid = false;
            } elseif ($checkPwd == true) {
                $stmt = $this->connect()->prepare('SELECT * FROM users WHERE users_email = ? AND users_pwd = ?;');


                if (!$stmt->execute(array($email, $loginData[0]["users_pwd"]))) {
                    $stmt = null;
                    $errors['email'] = "stmtfailed";
                    $isValid = false;
                }

                $loginData = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($loginData) == 0) {
                    $stmt = null;
                    $errors['email'] = "Nie ma takiego użytkownika";
                    $isValid = false;
                }


                if ($isValid) {

                    session_start();

                    $_SESSION['logged_in'] = true;
                    $_SESSION["userid"] = $loginData[0]["users_id"];
                    $_SESSION["email"] = $loginData[0]["users_email"];
                    $_SESSION["role"] = $loginData[0]["users_role"];
                    $name = $loginData[0]["users_name"];
                    $surename = $loginData[0]["users_surename"];

                    $_SESSION["fullname"] = $name . ' ' . $surename;

                    header("location: index.php");
                }
            }
        }


    }

}