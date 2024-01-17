<?php


//Plik odpowiedzialny za dodawanie licencji

session_start();
require_once('classes/Dbcon.php');
include "partials/header.php";
include "partials/menu.php";
include "classes/License.php";

//Sprawdzanie sesji
include "includes/loginCheck.inc.php";
sessionChecker();
managerChecker();

//Obsługa wyświetlania błędów i wpisanych danych
$user = [
    'id' => '',
    'licenseName' => '',
    'supplier' => '',
    'serialNumber' => '',
    'email' => '',
    'description' => '',
    'dateEnd' => '',
    'dateStart' => ''
];

$errors = [
    'licenseName' => "",
    'supplier' => '',
    'serialNumber' => "",
    'description' => "",
    'dateEnd' => ""

];
$category = new License();
//Wszystkie kategorie do tablicy
$categoryData = $category->getCategory();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $uid = '';
    $licenseName = $_POST["licenseName"];
    $supplier = $_POST["supplier"];
    $serialNumber = $_POST["serialNumber"];
    $description = $_POST["description"];
    $dateStart = $_POST["dateStart"];
    $dateEnd = $_POST["dateEnd"];
    $category_ID = $_POST["categoryID"];


    include "classes/License_contr.php";


    $signup = new LicenseContr($uid, $licenseName, $supplier, $serialNumber, $dateStart, $dateEnd, $description, $category_ID);


//Dodanie nowej licencji
    $signup->addLicense($errors);

    $user = [
        'id' => $uid,
        'licenseName' => $licenseName,
        'supplier' => $supplier,
        'serialNumber' => $serialNumber,
        'email' => $dateStart,
        'description' => $description,
        'dateEnd' => $dateEnd,
        'dateStart' => $dateEnd
    ];


}


?>
    <div class="container">
        <div class="row">
            <?php include "partials/_formAddLicense.php"; ?>
        </div>
    </div>

<?php
include "partials/footer.php";
?>