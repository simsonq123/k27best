<!--Formularz z Bootstrapa do dodawania albo aktualizacjia licencji-->

<div class="col-lg-10 col-xl-9 mx-auto ">
    <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden form-color">
        <div class="card-body p-4 p-sm-5">
            <h3 class="card-title text-center mb-5 fs-10">Dodaj Licencje</h3>
            <form method="POST" enctype="multipart/form-data" action="">


                <?php if ($user['id']): ?>
                    <input type="hidden" name="uid" value="<?php echo $user['id'] ?>">
                <?php endif; ?>

                <div class="form-floating mb-3">
                    <input name="licenseName" value="<?php echo $user['licenseName'] ?>" id="floatingName"
                           placeholder="Imię"
                           class="form-control <?php echo
                           $errors['licenseName'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback"><?php echo $errors['licenseName'] ?></div>
                    <label for="floatingName">Nazwa licencji</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="supplier" value="<?php echo $user['supplier'] ?>" id="floatingSupplier"
                           placeholder="Dostawca"
                           class="form-control <?php echo
                           $errors['supplier'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback"><?php echo $errors['supplier'] ?></div>
                    <label for="floatingSupplier">Dostawca</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="serialNumber" value="<?php echo $user['serialNumber'] ?>"
                           id="floatingSerialNumber"
                           placeholder="Numer Seryjny"
                           class="form-control <?php echo
                           $errors['serialNumber'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback"><?php echo $errors['serialNumber'] ?></div>
                    <label for="floatingSerialNumber">Numer Seryjny</label>
                </div>

                <div class="form-floating mb-3 ">
                    <textarea name="description" id="floatingDescription" placeholder="Opis"
                              class="form-control <?php echo
                              $errors['description'] ? 'is-invalid' : '' ?>" rows="4" style="height:100%;"><?php echo
                        $user['description'] ?>
                        </textarea>
                    <div class="invalid-feedback"><?php echo $errors['description'] ?></div>
                    <label for="floatingDescription">Opis</label>
                </div>
                <select id="select1" name="categoryID" onchange="zmienSelect(this.value)"
                        class="form-select
                            form-floating
                            mb-3"
                        required>
                    <option
                        selected disabled value="">Kategoria
                    </option>
                    <?php

                    foreach ($categoryData as $row) {
                        ?>
                        <option
                            value="<?php echo $row['category_ID'] ?>"><?php echo
                            $row['category_name'] ?></option>
                        <?php
                    }
                    ?>

                </select>
                <input type="hidden" name="dateStart" value="<?php echo date("Y-m-d") ?>">
                <div class="form-floating mb-5 mt-5">
                    <div class="row">
                        <!--                        <div class="form-group text-center col-6" id="hidden_date"><label-->
                        <!--                                for="date">Od kiedy</label><input type="date" name="dateStart"-->
                        <!--                                                                  id="dateIDmin"-->
                        <!--                                                                  class="form-control text-center"-->
                        <!--                                                                  value="--><?php
                        //                                                                  echo $user['dateStart'] ?><!--" required>-->
                        <!--                        </div>-->


                        <div class="form-group text-center col-12" id="hidden_date"><label for="date">
                                Do kiedy
                            </label><input type="date" name="dateEnd" id="dateIDmax"
                                           class="form-control text-center <?php echo
                                           $errors['dateEnd'] ? 'is-invalid' : '' ?>"
                                           value="<?php echo $user['dateEnd'] ?>" required>
                            <div class="invalid-feedback"><?php echo $errors['dateEnd'] ?></div>
                        </div>
                    </div>
                </div>


                <!--                        Ograniczenia podczas wybierania daty-->
                <script>dateIDmin.min = new Date().toLocaleDateString('fr-ca')</script>
                <script>dateIDmax.min = new Date().toLocaleDateString('fr-ca')</script>


                <div class="d-grid mb-2">
                    <button class="btn btn-lg btn-Main btn-login fw-bold text-uppercase" name="submit">
                        Dodaj licencję
                    </button>
                </div>
                <a class="d-block text-center mt-2 small" href="index.php"> ⮜ Strona główna</a>


            </form>
        </div>
    </div>
</div>