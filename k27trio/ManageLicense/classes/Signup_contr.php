<?php

class SignupContr extends Signup
{

    //    Kontroler Rejestracji - walidacja danych od użytkownika przed działaniami na bazie danych

    private $uid;
    private $name;
    private $surename;
    private $pwd;
    private $pwdRepeat;
    private $email;
    private $role;
    private $pesel;


    public function __construct($uid, $name, $surename, $pwd, $pwdRepeat, $email, $role, $pesel)
    {
        $this->uid = $uid;
        $this->name = $name;
        $this->surename = $surename;
        $this->pwd = $pwd;
        $this->pwdRepeat = $pwdRepeat;
        $this->email = $email;
        $this->role = $role;
        $this->pesel = $pesel;
    }

//Walidacja danych

    private function validateUser(&$errors, $updateValid = false)
    {
        $isValid = true;

        if (!$this->email || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $isValid = false;
            $errors['email'] = 'To musi być prawidłowy email';
        }
        if (empty($this->name)) {
            $errors['name'] = "Nie może być puste!";
            $isValid = false;
        }
        if (empty($this->surename)) {
            $errors['surename'] = "Nie może być puste!";
            $isValid = false;
        }

        if (!$this->checkUser($this->email) && !$updateValid) {
            $isValid = false;
            $errors['email'] = 'Email jest zajęty';
        }
        if (!$this->pwd || strlen($this->pwd) < 4) {
            $isValid = false;
            $errors['pwd'] = 'Hasło musi być dłuższe niż 3 znaki';
        }
        if ($this->pwdRepeat !== $this->pwd) {
            $isValid = false;
            $errors['pwdrepeat'] = 'Hasła muszą być takie same';
        }
        if (!preg_match('/^[0-9]{11}$/', $this->pesel)) {
            $isValid = false;
            $errors['pesel'] = 'Pesel musi mieć 11 cyfr';
        }


        return $isValid;
    }

//    Rejestracja użytkownika
    public function signupUser(&$errors)
    {

        if ($this->validateUser($errors) == true) {
            $this->setUser($this->name, $this->surename, $this->pwd, $this->email, $this->role, $this->pesel);
            header("location: index.php");
        }

    }

//Aktualizacja użytkownika
    public function updateUser(&$errors, $updateValid)
    {
        if ($this->validateUser($errors, $updateValid) == true) {
            $this->editUser($this->uid, $this->name, $this->surename, $this->email, $this->role);
            header("location: listUser.php");
        }

    }

}