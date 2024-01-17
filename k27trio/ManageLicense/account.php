<?php
session_start();
require_once('classes/Dbcon.php');
include "partials/header.php";
include "partials/menu.php";

//Sprawdzanie sesji
include "includes/loginCheck.inc.php";
sessionChecker();


//Pozwala wyświetlać dane które posiada użytkownik
$user = [
    'id' => '',
    'name' => '',
    'surename' => '',
    'email' => '',
    'pwd' => '',
    'pwdrepeat' => ''
];

?>


    <!--Formularz do edycji informacji o użytk i hasła-->

    <script>document.title = "Konto";</script>
    <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden form-color">
            <div class="card-body p-4 p-sm-5">
                <h3 class="card-title text-center mb-5 fs-10 ">
                    Twoje Konto
                </h3>

                <form action="updateUser.php" method="POST">
                    <?php
                    $query1 = "SELECT * FROM users WHERE users_id=?";
                    $stmt = $connection->prepare($query1);
                    $stmt->execute(array($_SESSION['userid']));
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($result as $row) {
                        ?>

                        <div class="form-floating mb-3">
                            <input name="name" value="<?php echo $row['users_name'] ?>" id="floatingName"
                                   placeholder="<?php echo $row['users_name'] ?>"
                                   class="form-control" disabled>
                            <label for="floatingName">Imię</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="surename" value="<?php echo $row['users_surename'] ?>" id="floatingSurename"
                                   placeholder="<?php echo $row['users_surename'] ?>"
                                   class="form-control" disabled>
                            <label for="floatingSurename">Nazwisko</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="email" value="<?php echo $row['users_email'] ?>" id="floatingEmail"
                                   placeholder="<?php echo $row['users_email'] ?>"
                                   class="form-control " disabled>
                            <label for="floatingEmail">Email</label>
                        </div>
                        <div class="container mt-4 mb-4">
                            <div class="row text-center">
                                <div class="col-12 col-md-6">
                                    <button type="submit" class="btn btn-lg btn-Main" name="modify"
                                            value="<?php echo $row['users_id']
                                            ?>">Modyfikuj Konto
                                    </button>
                                </div>
                                <div class="col-12 p-5 p-md-0 col-md-6">
                                    <button type="submit" class="btn btn-lg btn-Main" name="passw"
                                            value="<?php echo $row['users_id']
                                            ?>">Zmień Hasło
                                    </button>
                                </div>
                            </div>
                        </div>


                        <?php

                    }
                    ?>

                </form>
            </div>

        </div>
    </div>

<?php


include "partials/footer.php";


?>