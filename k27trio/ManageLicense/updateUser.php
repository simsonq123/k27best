<?php
session_start();

include 'partials/header.php';
include "partials/menu.php";
require_once 'classes/Dbcon.php';
include "includes/loginCheck.inc.php";
sessionChecker();

//Plik odpowiedzialny za aktualizacje użytkownika, hasła i usuwanie konta

$errors = [
    'name' => "",
    'surename' => '',
    'email' => "",
    'pwd' => "",
    'pwdrepeat' => "",
    'pesel' => ''

];

//Po n
if (isset($_POST['submit'])) {
    formChecker($_POST['submit'], 'listUser.php');
//    Modyfikacja danych osoby
    $uid = $_POST['uid'];
    $name = $_POST['name'];
    $surename = $_POST['surename'];
    $sameEmail = $_POST['sameEmail'];
    $pwd = 'test';
    $pwdRepeat = 'test';
    $email = $_POST["email"];
    $pesel = $_POST['pesel'];
    if (isset($_POST['role'])) {
        $role = $_POST['role'];
    } else {
        $role = 'pracownik';
    }

    $validateUpdate = false;

    if ($sameEmail === $email) {
        $validateUpdate = true;
    }


    include "classes/Signup.php";
    include "classes/Signup_contr.php";


    $edit = new SignupContr($uid, $name, $surename, $pwd, $pwdRepeat, $email, $role, $pesel);


    $edit->updateUser($errors, $validateUpdate);

    $user = [
        'id' => $uid,
        'name' => $name,
        'surename' => $surename,
        'email' => $sameEmail,
        'pesel' => '',
        'role' => ''
    ];


} elseif (isset($_POST['change'])) {
    formChecker($_POST['change'], 'listUser.php');
//    Zmiana hasła
    $uid = $_POST['uid'];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];
    $isValid = true;

    if (!$pwd || strlen($pwd) < 4) {
        $isValid = false;
        $errors['pwd'] = 'Hasło musi być dłuższe niż 3 znaki';
    }
    if ($pwdRepeat !== $pwd) {
        $isValid = false;
        $errors['pwdrepeat'] = 'Hasła muszą być takie same';
    }


    if ($isValid) {

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        $passw = "UPDATE users SET users_pwd=? WHERE users_id=?";
        $stmt = $connection->prepare($passw);
        $stmt->execute(array($hashedPwd, $uid));

        header('location: index.php');

    }


    $user = [
        'id' => $uid,
        'pwd' => $pwd,
        'pwdrepeat' => $pwdRepeat
    ];


} elseif (isset($_POST['deleteYES']) || isset($_POST['deleteNO'])) {

//Usuwanie konta lub nie
    if (isset($_POST['deleteYES'])) {


        $uid = $_POST['uid'];
        $passw = "DELETE FROM users WHERE users_id=?";
        $stmt = $connection->prepare($passw);
        $stmt->execute(array($uid));

        if ($_SESSION['userid'] == $uid) {
            include "includes/logout.inc.php";
        }

        header('location: listUser.php');

    } else {
        header("location: listUser.php");
        exit;
    }

} else {

    if (isset($_POST['modify'])) $uid = $_POST['modify'];
    elseif (isset($_POST['passw'])) $uid = $_POST['passw'];
    else {
        formChecker($_POST['delete'], 'listUser.php');
        $uid = $_POST['delete'];
    }

    $query2 = "SELECT * FROM users WHERE users_id=?";
    $stmt = $connection->prepare($query2);
    $stmt->execute(array($uid));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


    foreach ($result as $row) {
        echo '<input type="hidden" name="uid" value="' . $uid . '" />';
        $user = [
            'id' => $uid,
            'name' => $row['users_name'],
            'surename' => $row['users_surename'],
            'email' => $row['users_email'],
            'pwd' => $row['users_pwd'],
            'pwdrepeat' => $row['users_pwd'],
            'role' => $row['users_role'],
            'pesel' => $row['users_pesel']
        ];
    }


//    Wyświetla informacje o osobie

}
if (isset($_POST['modify']) || isset($_POST['submit'])) {
    ?>
    <div class="container">
        <div class="row">
            <!-- Formularz zmiany informacji o osobie-->
            <?php include 'partials/_formRegister.php' ?>
        </div>
    </div>
    <?php
} elseif (isset($_POST['delete'])) {

    ?>
    <!--    Formularz usuwania konta-->
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-9 mx-auto">
                <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
                    <div class="card-body p-4 p-sm-5">
                        <h3 class="card-title text-center mb-5  fs-10">
                            Czy napewno chcesz usunąć
                            konto <p class="fw-bold"><?php echo $user['name'] . ' ' . $user['surename'] . ' o ID:'
                                    . $user['id'] ?>?</p>
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


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
} else {
    ?>


    <!--Formularz zmiany hasła-->
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-9 mx-auto">
                <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
                    <div class="card-body p-4 p-sm-5">
                        <h3 class="card-title text-center mb-5 fw-light fs-10">
                            Zmień hasło
                        </h3>
                        <form method="POST" enctype="multipart/form-data" action="">

                            <input type="hidden" name="uid" value="<?php echo $uid ?>">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control <?php echo
                                $errors['pwd'] ? 'is-invalid' : '' ?>"
                                       id="floatingPassword" placeholder="Password"
                                       name="pwd">
                                <div class="invalid-feedback"><?php echo $errors['pwd'] ?></div>
                                <label for="floatingPassword">Hasło</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password"
                                       class="form-control <?php echo
                                       $errors['pwdrepeat'] ? 'is-invalid' : '' ?>"
                                       id="floatingPassword" placeholder="Password"
                                       name="pwdrepeat">
                                <div class="invalid-feedback"><?php echo $errors['pwdrepeat'] ?></div>
                                <label for="floatingPassword">Powtórz Hasło</label>
                            </div>

                            <div class="d-grid mb-2">
                                <button class="btn btn-lg btn-Main btn-login fw-bold text-uppercase" name="change">
                                    Zmień hasło
                                </button>

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
