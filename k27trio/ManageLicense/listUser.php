<?php

//Wyswietlenie wszystkich użytkowników i danie możliwości na edycje, zmiane hasła i usunięcie konta

session_start();
require_once('classes/Dbcon.php');
include "partials/header.php";
include "partials/menu.php";

//Sprawdzanie sesji
include "includes/loginCheck.inc.php";
sessionChecker();
adminChecker();


$user = [
    'id' => '',
    'name' => '',
    'surename' => '',
    'email' => '',
    'pwd' => '',
    'pwdrepeat' => ''
];

$errors = [
    'name' => "",
    'username' => '',
    'email' => "",
    'pwd' => "",
    'pwdrepeat' => ""

];


?>

    <div class="formularze">
        <form action="updateUser.php" method="POST">
            <?php
            $query1 = "SELECT * FROM users";
            $stmt = $connection->prepare($query1);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            ?>
            <div class="container tableColour">

                <table class="table table-striped text-center">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Imie</th>
                        <th scope="col">Nazwisko</th>
                        <th scope="col">Email</th>
                        <th scope="col"></th>
                        <th scope="col"></th>

                    </tr>
                    </thead>


                    <?php
                    $i = 1;
                    foreach ($result

                    as $row) {
                    if ($i % 2 !== 0) $color = 'tdColorMain';
                    else $color = '';

                    ?>
                    <tbody class="text-center <?php echo $color ?>">
                    <tr>
                        <th scope="row"><?php echo $i++ ?></th>
                        <td class="align-middle"><?php echo $row['users_name'] ?></td>
                        <td class="align-middle"><?php echo $row['users_surename'] ?></td>
                        <td class="align-middle"><?php echo $row['users_email'] ?></td>
                        <td class="align-middle">
                            <button type="submit" class="btn btn-Main" name="modify"
                                    value="<?php echo $row['users_id']
                                    ?>">Modyfikuj
                            </button>
                            <button type="submit" class="btn btn-info" name="passw"
                                    value="<?php echo $row['users_id']
                                    ?>">Reset Hasła
                            </button>

                        </td>
                        <td class="align-middle">
                            <button type="submit" class="btn btn-warning" name="delete"
                                    value="<?php echo $row['users_id']
                                    ?>">Usuń Konto
                            </button>
                        </td>
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