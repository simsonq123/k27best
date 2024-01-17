<?php

class UsersLicenseContr extends UsersLicense
{

    //    Kontroler Rejestracji - walidacja danych od użytkownika przed działaniami na bazie danych

    private $ID;
    private $licenseID;
    private $usersID;
    private $status;


    public function __construct($ID, $licenseID, $usersID, $status)
    {
        $this->ID = $ID;
        $this->licenseID = $licenseID;
        $this->usersID = $usersID;
        $this->status = $status;
    }

//    Akceptacja licencji
    public function acceptLicense()
    {
        $this->request($this->licenseID, $this->usersID, $this->status);
        header("location: index.php");
    }


}