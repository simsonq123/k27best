<?php

//Obsługa zapytań związanych z licencjami (baza danych)

class License extends Dbcon
{

//Dodawanie licencji do bazy
    protected function add($licenseID, $name, $supplier, $serialNumber, $buyDate, $endDate, $description, $category_ID)
    {
//        znaki ? zapobiegają SQL Injection ponieważ odzielamy dane od zapytania
        $stmt = $this->connect()->prepare('INSERT INTO license (license_name, license_supplier, license_serialNumber, license_buyDate, license_endDate, license_description, category_ID) VALUES (?, ?, ?, ?, ?,?, ?)');

        if (!$stmt->execute(array($name, $supplier, $serialNumber, $buyDate, $endDate, $description, $category_ID))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        $stmt = null;

    }

//Edytcja licencji w bazie
    protected function edit($uid, $name, $supplier, $serialNumber, $endDate, $description, $category_ID)
    {
//        znaki ? zapobiegają SQL Injection ponieważ odzielamy dane od zapytania
        $stmt = $this->connect()->prepare("UPDATE license SET license_name=?,license_supplier=?,license_serialNumber=?, license_endDate=?, license_description=?,category_ID=? WHERE license_ID=?");

        if (!$stmt->execute(array($name, $supplier, $serialNumber, $endDate, $description, $category_ID, $uid))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        $stmt = null;
    }

//Wszystkie licencje do tablicy
    public function getLicense()
    {
        $stmt = $this->connect()->prepare('SELECT * FROM license INNER JOIN category_license ON license.category_ID = category_license.category_ID');

        if (!$stmt->execute()) {
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        $licenseDate = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $licenseDate;
    }


    //Wszystkie kategorie do tablicy
    public function getCategory()
    {
        $stmt = $this->connect()->prepare('SELECT * FROM category_license');

        if (!$stmt->execute()) {
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        $licenseDate = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $licenseDate;
    }

}