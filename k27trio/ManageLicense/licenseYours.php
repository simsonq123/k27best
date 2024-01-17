<?php

//Plik odpowiedzialny za wyswietlenie licencji użytkownikach posiadanych, odrzuconych i oczekujących


session_start();
require_once('classes/Dbcon.php');
include "partials/header.php";
include "partials/menu.php";
include "classes/UsersLicense.php";
include "classes/License.php";
//Sprawdzanie sesji
include "includes/loginCheck.inc.php";
sessionChecker();

$uid = $_SESSION['userid'];


?>
<?php

$getLicense = new UsersLicense();

//Zdobycie danych z bazy
$allLicenses = $getLicense->getData($uid);

$allCategories = new License();
$allCategories = $allCategories->getCategory();

?>
    <script>
        document.title = "Twoje licencje";

        document.addEventListener('DOMContentLoaded', function() {
            var categorySelect = document.getElementById('categorySelect');
            var tableRows = document.querySelectorAll('table tbody tr');

            categorySelect.addEventListener('change', function() {
                var selectedCategory = this.value;
                tableRows.forEach(function(row) {
                    if(selectedCategory == '0' || row.getAttribute('data-category') === selectedCategory) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });

    </script>
    <script src="https://kit.fontawesome.com/48e0418fca.js" crossorigin="anonymous"></script>
    <div class="container tableColour">

        <div class="container">
            <div>Wybierz kategorie do wyszukania:</div>
            <select class="form-select" aria-label="Default select example" id="categorySelect">
                <option selected value="0">Wybierz kategorie (Wyświetl wszystkie)</option>
                <?php

                foreach ($allCategories as $category){
                    ?>
                    <option value="<?php echo $category['category_ID'] ?>"><?php echo $category['category_name']  ?></option>
                    <?php
                }
                ?>
            </select>
        </div>


        <table class="table table-striped">
            <thead class="text-center ">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Licencja</th>
                <th scope="col">Kategoria</th>
                <th scope="col">Dostawca</th>
                <th scope="col">Klucz</th>
                <th scope="col">Termin ważności</th>
                <th scope="col">Status</th>
            </tr>
            </thead>


            <?php

            $i = 1;
            foreach ($allLicenses

            as $row) {

            if ($i % 2 !== 0) $color = 'tdColorMain';
            else $color = '';

            ?>
            <tbody class="text-center <?php echo $color ?>">
            <tr data-category="<?php echo $row['category_ID'] ?>">


                <th scope="row"><?php echo $i++ ?></th>
                <td class="align-middle"><?php echo $row['license_name'] ?> </td>
                <td class="align-middle"><?php echo $row['category_name'] ?> </td>
                <td class="align-middle"><?php echo $row['license_supplier'] ?> </td>
                <?php if ($row['status'] == "accept" && $row['license_endDate'] > date("Y-m-d")) {
                    ?>
                    <?php echo '<td class="align-middle">' . $row['license_serialNumber'] . '</td>' ?>
                    <td class="align-middle"><?php echo $row['license_endDate'] ?></td>
                    <?php
                } else {
                    ?>
                    <td class="align-middle">?</td>
                    <td class="align-middle">?</td>
                    <?php
                } ?>

                <td class="align-middle ">
                    <?php
                    if ($row['status'] == "waiting" || $row['status'] == "") { ?>
                        <i class="fa-regular fa-hourglass-half" style="color: #ffc107;"></i>
                    <?php } elseif ($row['status'] == "reject") {
                        ?>
                        <i class="fa-solid fa-xmark" style="color: #dc3545;"></i>
                        <?php
                    } elseif ($row['status'] == "expired" || $row['license_endDate'] < date("Y-m-d")) {
                        ?>
                        <i class="fa-solid fa-xmark" style="color: #dc3545;"></i>
                        <?php
                    } else {
                        ?>
                        <i class="fa-solid fa-check" style="color: #28a745;"></i>
                        <?php
                    }
                    ?>
                </td>
            
            <?php
            }
            ?>
            </tr>
            </tbody>
        </table>

    </div>

<?php
include "partials/footer.php";
?>