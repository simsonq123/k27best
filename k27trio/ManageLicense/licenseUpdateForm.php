<?php
session_start();

//Obsługa Formularza służącego do aktualizacji danych w wybranej licencji

include 'partials/header.php';
include "partials/menu.php";
require_once 'classes/Dbcon.php';
include "classes/License.php";
include "includes/loginCheck.inc.php";
sessionChecker();

$getLicense = new License();
$categoryData = $getLicense->getCategory();

$errors = [
    'licenseName' => "",
    'supplier' => '',
    'serialNumber' => "",
    'description' => "",
    'dateEnd' => ""

];


if (isset($_POST['submit'])) {
    formChecker($_POST['submit'], 'listUser.php');
//    Modyfikacja danych osoby
    $uid = $_POST['uid'];
    $licenseName = $_POST["licenseName"];
    $supplier = $_POST["supplier"];
    $serialNumber = $_POST["serialNumber"];
    $dateStart = $_POST["dateStart"];
    $dateEnd = $_POST["dateEnd"];
    $description = $_POST["description"];
    $category_ID = $_POST["categoryID"];


    include "classes/License_contr.php";


    $edit = new LicenseContr($uid, $licenseName, $supplier, $serialNumber, $dateStart, $dateStart, $description, $category_ID);


    $edit->updateLicense($errors);

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


} elseif (isset($_POST['deleteYES']) || isset($_POST['deleteNO'])) {

//Usuwanie konta lub nie
    if (isset($_POST['deleteYES'])) {


        $uid = $_POST['uid'];
        $delete = "DELETE FROM license WHERE license_ID=?";
        $stmt = $connection->prepare($delete);
        $stmt->execute(array($uid));

        header('location: licenseUpdate.php');
    }

} else {

    if (isset($_POST['modify'])) $uid = $_POST['modify'];
    else {
        formChecker($_POST['delete'], 'listUser.php');
        $uid = $_POST['delete'];
    }

    $query2 = "SELECT * FROM license WHERE license_ID=?";
    $stmt = $connection->prepare($query2);
    $stmt->execute(array($uid));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

//Wyświetlenie danych z bazy w formularzu
    foreach ($result as $row) {
        echo '<input type="hidden" name="uid" value="' . $uid . '" />';
        $user = [
            'id' => $uid,
            'licenseName' => $row['license_name'],
            'supplier' => $row['license_supplier'],
            'serialNumber' => $row['license_serialNumber'],
            'description' => $row['license_description'],
            'dateStart' => $row['license_buyDate'],
            'dateEnd' => $row['license_endDate'],
            'categoryID' => $row['category_ID'],

        ];
    }


//    Wyświetla informacje o osobi

}
if (isset($_POST['modify']) || isset($_POST['submit'])) {
    ?>
    <div class="container">
        <div class="row">
            <!-- Formularz informacji o Licencji-->
            <?php include "partials/_formAddLicense.php"; ?>
        </div>
    </div>
    <?php
} elseif (isset($_POST['delete'])) {

    ?>
    <!--    Formularz usuwania licencji-->
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-9 mx-auto">
                <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
                    <div class="card-body p-4 p-sm-5">
                        <h3 class="card-title text-center mb-5  fs-10">
                            Czy napewno chcesz usunąć Licencje<p
                                class="fw-bold"><?php echo $user['licenseName'] ?>?</p>
                        </h3>
                        <form method="POST" enctype="multipart/form-data" action="">

                            <input type="hidden" name="uid" value="<?php echo $uid ?>">

                            <div class="container mt-4 mb-4 align-center">
                                <div class="row text-center align-content-center">
                                    <div class="col-12 col-md-6">

                                        <input type="submit" name="deleteYES" value="TAK"
                                               class="btn btn-success btn-lg  btn-login fw-bold text-uppercase">

                                    </div>
                                    <div class="col-12 p-5 p-md-0 col-md-6">

                                        <input type="submit" name="deleteNO" value="NIE"
                                               class="btn btn-danger btn-lg  btn-login fw-bold text-uppercase">

                                    </div>
                                </div>
                            </div>
                            <?php
                            $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
                            echo "<a href='$url' class='d-block text-center mt-2 small'>⮜ Cofnij</a>";
                            ?>
                            <!--                            <a class="d-block text-center mt-2 small" href="-->
                            <?php //?><!--.php"> ⮜ Cofnij</a>-->

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
}
?>



<?php

?>



<?php
include 'partials/footer.php';
?>
