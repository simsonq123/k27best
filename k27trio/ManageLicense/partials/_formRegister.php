<!--Formularz z Bootstrapa do dodawania albo aktualizacjia użytkownika i hasła-->

<div class="col-lg-10 col-xl-9 mx-auto">
    <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden form-color">
        <div class="card-body p-4 p-sm-5">
            <h3 class="card-title text-center mb-5 fw-light fs-10">
                <?php if ($user['id']): ?>
                    Aktualizuj <b><?php echo $user['email'] . $user['id'] ?></b>
                <?php else: ?>
                    Rejestracja
                <?php endif; ?>
            </h3>
            <form method="POST" enctype="multipart/form-data" action="">

                <?php if ($user['id']): ?>
                    <input type="hidden" name="uid" value="<?php echo $user['id'] ?>">
                    <?php $sameEmail = $user['email'] ?>
                    <input type="hidden" name="sameEmail" value="<?php echo $sameEmail ?>">
                <?php endif; ?>
                <div class="form-floating mb-3">
                    <input name="name" value="<?php echo $user['name'] ?>" id="floatingName"
                           placeholder="Imię"
                           class="form-control <?php echo
                           $errors['name'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback"><?php echo $errors['name'] ?></div>
                    <label for="floatingName">Imię</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="surename" value="<?php echo $user['surename'] ?>" id="floatingSurename"
                           placeholder="Nazwisko"
                           class="form-control <?php echo
                           $errors['surename'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback"><?php echo $errors['surename'] ?></div>
                    <label for="floatingSurename">Nazwisko</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="email" value="<?php echo $user['email'] ?>" id="floatingEmail"
                           placeholder="Email"
                           class="form-control <?php echo
                           $errors['email'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback"><?php echo $errors['email'] ?></div>
                    <label for="floatingEmail">Email</label>
                </div>
                <?php if (!isset($_SESSION['userid'])): ?>
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

                    <div class="form-floating mb-3">
                        <input name="pesel" value="<?php echo $user['pesel'] ?>" id="floatingPesel"
                               placeholder="PESEL"
                               class="form-control <?php echo $errors['pesel'] ? 'is-invalid' : '' ?>">
                        <div class="invalid-feedback"><?php echo $errors['pesel'] ?></div>
                        <label for="floatingPesel">PESEL</label>
                    </div>
                <?php endif; ?>
                <?php if ($user['id']): ?>
                    <?php if ($_SESSION['role'] == "admin"): ?>
                        <div class="form-floating m-5 text-center">
                            <h5 class="mb-3">Wybierz poziom konta:</h5>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="role" id="pracownikRadio"
                                       value="pracownik" checked>
                                <label class="form-check-label" for="pracownikRadio">Pracownik</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="role" id="kierownikRadio"
                                       value="kierownik">
                                <label class="form-check-label" for="kierownikRadio">Kierownik</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="role" id="adminRadio"
                                       value="admin">
                                <label class="form-check-label" for="adminRadio">Admin</label>
                            </div>
                        </div>

                    <?php endif; ?>
                <?php endif; ?>


                <div class="d-grid mb-2">
                    <button class="btn btn-lg btn-Main btn-login fw-bold text-uppercase" name="submit">
                        <?php if ($user['id']): ?>
                            Aktualizuj
                        <?php else: ?>
                            Zarejestruj się
                        <?php endif; ?>
                    </button>

                </div>
                <?php if ($user['id']): ?>
                    <a class="d-block text-center mt-2 small" href="listUser.php"> ⮜ Cofnij</a>
                <?php else: ?>
                    <a class="d-block text-center mt-2 small" href="login.php"> Masz konto? Zaloguj się</a>
                <?php endif; ?>


            </form>
        </div>
    </div>
</div>