<?php

//Plik odpowiedzialny za aktualizacje licencji i usuwanie ich

session_start();
require_once('classes/Dbcon.php');
include "partials/header.php";
include "partials/menu.php";
include "classes/License.php";

//Sprawdzanie sesji
include "includes/loginCheck.inc.php";
sessionChecker();
managerChecker();


?>
<?php

$getLicense = new License();
//Wszystkie kategorie do tablicy
$allLicenses = $getLicense->getLicense();
$allCategories = $getLicense->getCategory();

?>



    <!--Wyświetlenie wszystkich licencji i danie możliwości do edycji albo usunięcia-->
    <div class="formularze">

        <form action="licenseUpdateForm.php" method="POST">

            <script>
                document.title = "Aktualizuj Licencje";

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
                    <thead class="text-center">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Licencja</th>
                        <th scope="col">Kategoria</th>
                        <th scope="col">Dostawca</th>
                        <th scope="col">Klucz</th>
                        <th scope="col">Termin ważności</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
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
                        <td class="align-middle"><?php echo $row['license_serialNumber'] ?> </td>
                        <td class="align-middle"><?php echo $row['license_endDate'] ?> </td>
                        <td class="align-middle">
                            <button type="submit" class="btn btn-Main" name="modify"
                                    value="<?php echo $row['license_ID'] ?>">Aktualizuj
                            </button>
                        </td>
                        <td class="align-middle">
                            <button type="submit" class="btn btn-warning" name="delete"
                                    value="<?php echo $row['license_ID'] ?>">Usuń
                            </button>
                        </td>
                    </tr>

                    <?php
                    }
                    ?>
                    </tbody>
                </table>

            </div>
        </form>
    </div>
<?php
include "partials/footer.php";
?>