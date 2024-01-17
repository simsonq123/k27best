<?php
session_start();
include 'partials/header.php';
include "partials/menu.php";
include "includes/loginCheck.inc.php";
include "classes/Dbcon.php";
include "classes/License.php";


sessionChecker();

$user = [
    'dateStart' => '',
    'dateEnd' => '',
    'description' => ''
];

$errors = [
    'dateEnd' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    include "classes/UsersLicense.php";
    include "classes/UsersLicense_contr.php";

    $ID = '';
    $uid = $_SESSION['userid'];
    $licenseID = $_POST['licenseID'];
    $status = "waiting";


    $licenseRequest = new UsersLicenseContr($ID, $licenseID, $uid, $status);


//    Start of validation
    $licenseRequest->acceptLicense($errors);
// End of Validation

}

$licenseList = new License();

$licenseData = $licenseList->getLicense();
$categoryData = $licenseList->getCategory();


?>
    <script>document.title = "Wniosek o Licencje";</script>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-9 mx-auto">
                <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden form-color">
                    <div class="card-body p-4 p-sm-5">
                        <h3 class="card-title text-center mb-5 fs-10"><?php if (isset($_POST['submit'])) {
                                echo $licenseID;
                            }
                            ?>Wniosek o
                            Licencje</h3>
                        <form method="POST" enctype="multipart/form-data" action="">
                            <div class="form-floating mb-3">
                                <div class="row mb-5">


                                    <h6>Kategorie:</h6>
                                    <select id="select1" onchange="zmienSelect(this.value)" class="form-select"
                                            required>
                                        <option
                                            selected disabled value="">Wybierz opcje
                                        </option>
                                        <?php

                                        foreach ($categoryData as $row) {
                                            ?>
                                            <option
                                                value="<?php echo $row['category_ID'] ?>"><?php echo
                                                $row['category_name'] ?></option>
                                            <?php
                                        }
                                        ?>

                                    </select>
                                    <h6 id="hidden_div" class="mt-5">Licencja:</h6>
                                    <select id="hidden_select" class="form-select " name="licenseID">
                                        <option value="0">------</option>
                                    </select>
                                    <script>

                                        function zmienSelect(wartosc) {
                                            var select2 = document.getElementById("hidden_select");
                                            var hiddenDiv = document.getElementById("hidden_div");
                                            select2.innerHTML = "";

                                            select2.style.display = 'block';
                                            hiddenDiv.style.display = 'block';

                                            <?php foreach ($licenseData as $row){ ?>
                                            if (wartosc === "<?php echo $row['category_ID'] ?>") {
                                                // Dodaj opcje na podstawie wartości pierwszego Selecta
                                                select2.options.add(new Option("<?php echo $row['license_name'] . ' - ' . $row['license_description'] ?>",
                                                    <?php echo $row['license_ID']?>));
                                            }
                                            <?php } ?>
                                        }


                                    </script>
                                </div>
                                <div class="d-grid mb-2">
                                    <button class="btn btn-lg btn-Main btn-login fw-bold text-uppercase"
                                            name="submit">
                                        Złóż Wniosek
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php
include 'partials/footer.php';
?>