<?php

//Plik ten odpowiada za sprawdzenie czy użytkownik ma odpowiednie uprawnienia do wejścia na strone

function sessionChecker()
{
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        header("Location: login.php");
        exit;
    }
}

function adminChecker()
{
    if ($_SESSION['role'] !== 'admin') {
        header("Location: index.php");
        exit;
    }
}


function managerChecker()
{
    if ($_SESSION['role'] == 'kierownik' || $_SESSION['role'] == 'admin') {
    } else {
        header("Location: index.php");
        exit;
    }
}

function formChecker($button, $url)
{
    if (!isset($button)) {
        header("Location: $url");
        exit;
    }
}
