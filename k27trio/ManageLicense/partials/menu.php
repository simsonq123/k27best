<!-- Navbar -->
<?php ob_start(); ?>

<script>


</script>

<!--Menu z bootstrapa-->

<nav class="navbar navbar-expand-lg sticky-top navbar-light bg-transparent p-0 mb-5 ">

    <!-- Container wrapper -->
    <div class="container">
        <!-- Navbar brand -->

        <!-- Toggle button -->
        <button class="navbar-dark navbar-toggler icon1" type="button" data-toggle="collapse"
                data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="logout navbar-toggler "><a href="includes/logout.inc.php" class="btn
            btn-primary
              ">Wyloguj</a></div>


        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">

            <!-- Left links -->
            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link " href="index.php">Wniosek o Licencje</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="licenseYours.php">Twoje Licencje</a>
                </li>

                <?php if ($_SESSION['role'] == "admin" || $_SESSION['role'] == "kierownik"): ?>
                    <li class="nav-item">
                        <a class="nav-link " href="licenseListAccept.php">Akceptuj Licencje</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="licenseAdd.php">Dodaj Licencje</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="licenseCategoryAdd.php">Dodaj Kategorie Licencji</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="licenseUpdate.php">Wszystkie Licencje</a>
                    </li>
                    <?php if ($_SESSION['role'] == "admin"): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="listUser.php">Edycja użytkowników</a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="account.php">Konto</a>
                </li>


            </ul>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-link list-inline-item me-auto"><a href="includes/logout.inc.php" class="btn
            btn-outline-primary
              ">Wyloguj</a>
                    </li>
                </ul>
            </div>


        </div>

        <!-- Collapsible wrapper -->
    </div>
    <!-- Container wrapper -->
</nav>

</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
        integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
        integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"
        crossorigin="anonymous"></script>

<!-- Navbar -->