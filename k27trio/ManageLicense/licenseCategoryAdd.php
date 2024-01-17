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
    'categoryName' => ''
];

$errors = [
    'categoryName' => ""
];
$category = new License();
//Wszystkie kategorie do tablicy
$categoryData = $category->getCategory();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $isValid = true;
    $categoryName = $_POST["categoryName"];

    if (empty($categoryName)) {
        $errors['categoryName'] = "Nie może być puste!";
        $isValid = false;
    }


    if ($isValid) {

        $query = "INSERT INTO category_license (category_name) VALUE(?)";
        $stmt = $connection->prepare($query);
        $stmt->execute(array($categoryName));
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        header("Location: index.php");

    }

    $user = [
        'categoryName' => $categoryName
    ];


}


?>
    <div class="container">
        <div class="row">
            <!--Formularz z Bootstrapa do dodawania albo aktualizacjia licencji-->

            <div class="col-lg-10 col-xl-9 mx-auto ">
                <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden form-color">
                    <div class="card-body p-4 p-sm-5">
                        <h3 class="card-title text-center mb-5 fs-10">Dodaj Kategorie</h3>
                        <form method="POST" enctype="multipart/form-data" action="">

                            <div class="form-floating mb-5">
                                <input name="categoryName" id="floatingName" value="<?php echo $user['categoryName'] ?>"
                                       placeholder="Nazwa"
                                       class="form-control <?php echo
                                       $errors['categoryName'] ? 'is-invalid' : '' ?>">
                                <div class="invalid-feedback"><?php echo $errors['categoryName'] ?></div>
                                <label for="floatingName">Nazwa Kategorii</label>
                            </div>

                            <div class="d-grid mb-2">
                                <button class="btn btn-lg btn-Main btn-login fw-bold text-uppercase" name="submit">
                                    Dodaj Kategorie
                                </button>
                            </div>
                            <a class="d-block text-center mt-2 small" href="index.php"> ⮜ Strona główna</a>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
include "partials/footer.php";
?>