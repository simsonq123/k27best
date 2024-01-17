<?php

class UsersLicense extends Dbcon
{
    //Obsługa zapytań związanych z Licencjami użytkownika (baza danych)


//    Wysłanie prośby o licencje
    protected function request($licenseID, $usersID, $status)
    {
        $stmt = $this->connect()->prepare('INSERT INTO users_license (license_ID,users_id, status)  VALUES (?,?,?) ;');
        $isValid = true;

        if (!$stmt->execute(array($licenseID, $usersID, $status))) {
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        $stmt = null;
    }


//    Zdobycie danych z 3 tabel(baz danych) do tablicy
    public function getData($usersID)
    {

        $stmt = $this->connect()->prepare("
SELECT users_license.ID,users.users_email, license.license_name,license.license_supplier,license.license_serialNumber, license.license_endDate, users_license.status, category_license.category_ID, category_license.category_name
FROM users_license
JOIN users ON users_license.users_id = users.users_id
JOIN license ON users_license.license_id = license.license_ID
JOIN category_license ON license.category_ID = category_license.category_ID
WHERE users_license.users_id = ?;");

        if (!$stmt->execute(array($usersID))) {
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $licenseUserDate = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $licenseUserDate;

    }

//    Dane potrzebne do akceptacji licencji przez kierownika albo admina
    public function getAcceptData()
    {
        $stmt = $this->connect()->prepare("
SELECT users_license.ID,users.users_name,users.users_surename,users.users_pesel, license.license_name
FROM users_license
INNER JOIN users ON users_license.users_id = users.users_id
INNER JOIN license ON users_license.license_id = license.license_ID
WHERE users_license.status='waiting';");

        if (!$stmt->execute(array())) {
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        $licenseAcceptDate = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $licenseAcceptDate;

    }

}