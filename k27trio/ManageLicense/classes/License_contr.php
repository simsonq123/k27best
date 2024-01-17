<?php

class LicenseContr extends License
{
//    Kontroler licencji - walidacja danych od użytkownika przed działaniami na bazie danych


    private $licenseID;
    private $name;
    private $supplier;
    private $serialNumber;
    private $buyDate;
    private $endDate;
    private $description;
    private $category_ID;


    public function __construct($licenseID, $name, $supplier, $serialNumber, $buyDate, $endDate, $description, $category_ID)
    {
        $this->licenseID = $licenseID;
        $this->name = $name;
        $this->supplier = $supplier;
        $this->serialNumber = $serialNumber;
        $this->buyDate = $buyDate;
        $this->endDate = $endDate;
        $this->description = $description;
        $this->category_ID = $category_ID;
    }

//    Walidacja danych
    private function validateLicense(&$errors)
    {
        $isValid = true;
        if (empty($this->name)) {
            $errors['licenseName'] = "Nie może być puste!";
            $isValid = false;
        }
        if (empty($this->supplier)) {
            $errors['supplier'] = "Nie może być puste!";
            $isValid = false;
        }
        if (empty($this->serialNumber)) {
            $errors['serialNumber'] = "Nie może być puste!";
            $isValid = false;
        }
        if (empty($this->description)) {
            $errors['description'] = "Nie może być puste!";
            $isValid = false;
        }
        if ($this->buyDate > $this->endDate) {
            $isValid = false;
            $errors['dateEnd'] = 'Wpisz poprawnie datę!!';
        }


        return $isValid;
    }

//    Walidacja danych i dodanie licencji
    public function addLicense(&$errors)
    {
        if ($this->validateLicense($errors) == true) {
            $this->add($this->licenseID, $this->name, $this->supplier, $this->serialNumber, $this->buyDate,
                $this->endDate, $this->description, $this->category_ID);
            header("location: index.php");
        }
    }

//    Walidacja danych i aktualizacja licencji
    public function updateLicense(&$errors)
    {
        if ($this->validateLicense($errors) == true) {
            $this->edit($this->licenseID, $this->name, $this->supplier, $this->serialNumber,
                $this->endDate, $this->description, $this->category_ID);
            header("location: licenseUpdate.php");
        }

    }


}