<?php

include 'partials/header.php';


$user = [
    'id' => '',
    'name' => '',
    'username' => '',
    'email' => '',
    'pwd' => '',
    'pwdrepeat' => ''
];

$errors = [
    'email' => "",
    'pwd' => ""
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];

    include "classes/Dbcon.php";
    include "classes/Login.php";
    include "classes/Login_contr.php";

    $login = new LoginContr($email, $pwd);
    $login->loginUser($errors);


//    Start of validation
//    $signup->validateUser($errors);

    $user = [
        'email' => $email,
        'pwd' => $pwd
    ];

// End of Validation

}


?>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-9 mx-auto">
                <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden form-color">
                    <div class="card-body p-4 p-sm-5">
                        <h3 class="card-title text-center mb-5 fw-light fs-10">Logowanie</h3>
                        <form method="POST" enctype="multipart/form-data" action="">

                            <div class="form-floating mb-3">
                                <input type="text" name="email" class="form-control <?php echo
                                $errors['email'] ? 'is-invalid' : '' ?>"
                                       value="<?php echo $user['email'] ?>">
                                <div class="invalid-feedback"><?php echo $errors['email'] ?></div>
                                <label for="floatingInputEmail">Email </label>
                            </div>


                            <div class="form-floating mb-3">
                                <input type="password" name="pwd" class="form-control  <?php echo
                                $errors['pwd'] ? 'is-invalid' : '' ?>" value="<?php echo $user['pwd'] ?>">
                                <div class="invalid-feedback"><?php echo $errors['pwd'] ?></div>
                                <label for="floatingPassword">Hasło</label>
                            </div>


                            <div class="d-grid mb-2">
                                <button class="btn btn-lg btn-Main btn-login fw-bold text-uppercase" name="submit">
                                    Zaloguj
                                </button>
                            </div>

                            <a class="d-block text-center mt-2 small" href="register.php">Nie masz konta?
                                Zarejestruj
                                się!</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
include 'partials/footer.php';
?>