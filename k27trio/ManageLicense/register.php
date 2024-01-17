<?php

include 'partials/header.php';

$user = [
    'id' => '',
    'name' => '',
    'surename' => '',
    'email' => '',
    'pwd' => '',
    'pesel' => '',
    'pwdrepeat' => ''
];

$errors = [
    'name' => "",
    'surename' => '',
    'email' => "",
    'pwd' => "",
    'pwdrepeat' => "",
    'pesel' => ''

];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uid = '';
    $name = $_POST["name"];
    $surename = $_POST["surename"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];
    $email = $_POST["email"];
    $role = 'pracownik';
    $pesel = $_POST['pesel'];
    include "classes/Dbcon.php";
    include "classes/Signup.php";
    include "classes/Signup_contr.php";


    $signup = new SignupContr($uid, $name, $surename, $pwd, $pwdRepeat, $email, $role, $pesel);


//    Start of validation
    $signup->signupUser($errors);

    $user = [
        'id' => $uid,
        'name' => $name,
        'surename' => $surename,
        'email' => $email,
        'pwd' => $pwd,
        'pesel' => $pesel,
        'pwdrepeat' => $pwdRepeat
    ];

// End of Validation

}


?>

<div class="container">
    <div class="row">
        <?php include 'partials/_formRegister.php' ?>
    </div>
</div>


<?php
include 'partials/footer.php';
?>
