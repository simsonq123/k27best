<?php

class LoginContr extends Login
{


    //    Kontroler Logowania - walidacja danych od użytkownika przed działaniami na bazie danych
    private $email;
    private $pwd;


    public function __construct($email, $pwd)
    {
        $this->email = $email;
        $this->pwd = $pwd;
    }

//    walidacja logowanie
    public function loginUser(&$errors)
    {
        $isValid = true;
        if (empty($this->email)) {
            $errors['email'] = "Nie może być puste!";
            $isValid = false;
        } elseif (empty($this->pwd)) {
            $errors['pwd'] = "Nie może być puste!";
            $isValid = false;
        }

        if ($isValid) {
            $this->getUser($this->email, $this->pwd, $errors);
        }

    }


}