<?php

//Panel kierownika/admin gdzie może zatwierdzać Wnioski o licencje użytkowników

session_start();
require_once('classes/Dbcon.php');
include "partials/header.php";
include "partials/menu.php";
include "classes/UsersLicense.php";
//Sprawdzanie sesji
include "includes/loginCheck.inc.php";
sessionChecker();
managerChecker();


//Możliwość wyświetlenia danych
$user = [
    'id' => '',
    'name' => '',
    'username' => '',
    'email' => '',
    'pwd' => '',
    'pwdrepeat' => ''
];

$getLicense = new UsersLicense();

//Dane potrzebne do akceptacji
$acceptData = $getLicense->getAcceptData();

echo '<div class="formularze">';
echo '<form action="licenseAccept.php" method="POST" >';


?>
    <script>document.title = "Zatwierdzanie licencji";</script>
    <div class="container tableColour">

        <table class="table table-striped">
            <thead class="text-center">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Osoba</th>
                <th scope="col">PESEL</th>
                <th scope="col">Licencja</th>
                <th scope="col"></th>
            </tr>
            </thead>


            <!--            Wyświetlenie wszystkich wniosków-->
            <?php
            $i = 1;
            foreach ($acceptData

            as $row) {

            if ($i % 2 !== 0) $color = 'tdColorMain';
            else $color = '';
            ?>
            <tbody class="text-center <?php echo $color ?>">
            <tr>
                <th scope="row"><?php echo $i++ ?></th>
                <td class="align-middle"><?php echo $row['users_name'] . ' ' . $row['users_surename'] ?></td>
                <td class="align-middle"><?php echo $row['users_pesel'] ?></td>
                <td class="align-middle"><?php echo $row['license_name'] ?></td>
                <td class="align-middle ">
                    <button type="submit" class="btn btn-success fw-bold" name="accept"
                            value="<?php echo $row['ID'] ?>">AKCEPTUJE
                    </button>
                </td>
                <td class="align-middle ">
                    <button type="submit" class="btn btn-Main fw-bold" name="reject"
                            value="<?php echo $row['ID'] ?>">ODRZUCAM
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