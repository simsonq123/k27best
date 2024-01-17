<?php
session_start();

//Plik obsługujący wybraną przez kierownika opcje AKCEPTUJE albo ODRZUCAM


include 'partials/header.php';
include "partials/menu.php";
require_once 'classes/Dbcon.php';
include "includes/loginCheck.inc.php";
sessionChecker();

//Jeśli nadusił AKCEPTUJ
if (isset($_POST['accept'])) {
    formChecker($_POST['accept'], 'licenseListAccept.php');
    $status = "accept";
    $license_ID = $_POST['accept'];

    $query = "UPDATE users_license SET status=? WHERE ID=?";
    $stmt = $connection->prepare($query);
    $stmt->execute(array($status, $license_ID));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header("location: licenseListAccept.php");

//Jeśli nadusił ODRZUĆ
} elseif (isset($_POST['reject'])) {
    formChecker($_POST['reject'], 'licenseListAccept.php');

    $status = "reject";
    $license_ID = $_POST['reject'];


    $query = "UPDATE users_license SET status=? WHERE ID=?";
    $stmt = $connection->prepare($query);
    $stmt->execute(array($status, $license_ID));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header("location: licenseListAccept.php");

    //Jeśli wszedł bez wcisnięcia przycisku
} else {
    header("location: licenseListAccept.php");

}
?>


<?php
include 'partials/footer.php';
?>

