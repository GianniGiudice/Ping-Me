<?php $this->title = 'Espace pongiste'; ?>

<div class="container-fluid mt-5">
    <?php
    if (isset($error)) {
        echo '<p class="m-3"><span class="text-danger"><i class="fas fa-bug"></i> ' . $error . '</span></p>';
    }
    if (isset($success)) {
        echo '<p class="m-3"><span class="text-success"><i class="fas fa-check"></i> ' . $success . '</span></p>';
    }
    ?>
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-3 bg-ping">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-male"></i> <?= $user['firstname'] ?> <?= strtoupper($user['lastname']) ?> <span class="float-end"><span class="badge bg-dark rounded-pill"><?= $user['victories'] - $user['defeats'] ?></span></span></h5>
                    <p class="card-text">
                        <?php if ($_SESSION['racket'] !== false) { ?>
                        <span class="font-weight-bold">Raquette</span>
                    </p>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Vitesse
                                <span class="badge bg-warning rounded-pill"><?= $_SESSION['racket']['speed'] ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Contrôle
                                <span class="badge bg-success rounded-pill"><?= $_SESSION['racket']['control'] ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Rotation
                                <span class="badge bg-primary rounded-pill"><?= $_SESSION['racket']['rotation'] ?></span>
                            </li>
                        </ul>

                    <p class="card-text">
                        <span class="font-weight-bold">Revêtement rouge</span>
                    </p>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Vitesse
                                <span class="badge bg-warning rounded-pill"><?= $_SESSION['red']['speed'] ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Contrôle
                                <span class="badge bg-success rounded-pill"><?= $_SESSION['red']['control'] ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Rotation
                                <span class="badge bg-primary rounded-pill"><?= $_SESSION['red']['rotation'] ?></span>
                            </li>
                        </ul>

                    <p class="card-text">
                        <span class="font-weight-bold">Revêtement noir</span>
                    </p>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Vitesse
                                <span class="badge bg-warning rounded-pill"><?= $_SESSION['black']['speed'] ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Contrôle
                                <span class="badge bg-success rounded-pill"><?= $_SESSION['black']['control'] ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Rotation
                                <span class="badge bg-primary rounded-pill"><?= $_SESSION['black']['rotation'] ?></span>
                            </li>
                        </ul>
                        <?php
                        }
                        else {
                        ?>
                        Vous n'avez aucun matériel.
                    <?php } ?>
                    <p class="card-text"><small>Inscrit depuis le <?= date('d/m/Y    ', strtotime($user['registration'])) ?></small></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3 bg-shop">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-drafting-compass"></i> Atelier </h5>
                    <form method="post" action="index.php?action=atelier">
                        <p class="card-text">
                            <span class="font-weight-bold">Raquette <small>(15 pts à répartir)</small></span>
                        </p>
                        <div class="row">
                            <label for="racket_speed" class="col-form-label col-sm-2">Vitesse</label>
                            <div class="col-sm-10">
                                <input type="number" name="racket_speed" class="form-control" id="racket_speed" value="<?php if ($_SESSION['racket'] !== false) { echo $_SESSION['racket']['speed']; } else { echo '0'; }?>" min="0" max="15" required="required">
                            </div>
                        </div>
                        <div class="row">
                            <label for="racket_control" class="col-form-label col-sm-2">Contrôle</label>
                            <div class="col-sm-10">
                                <input type="number" name="racket_control" class="form-control" id="racket_control" value="<?php if ($_SESSION['racket'] !== false) { echo $_SESSION['racket']['control']; } else { echo '0'; }?>" min="0" max="15" required="required">
                            </div>
                        </div>
                        <div class="row">
                            <label for="racket_rotation" class="col-form-label col-sm-2">Rotation</label>
                            <div class="col-sm-10">
                                <input type="number" name="racket_rotation" class="form-control" id="racket_rotation" value="<?php if ($_SESSION['racket'] !== false) { echo $_SESSION['racket']['rotation']; } else { echo '0'; }?>" min="0" max="15" required="required">
                            </div>
                        </div>

                        <p class="card-text">
                            <span class="font-weight-bold">Revêtement rouge <small>(15 pts à répartir)</small></span>
                        </p>
                        <div class="row">
                            <label for="red_speed" class="col-form-label col-sm-2">Vitesse</label>
                            <div class="col-sm-10">
                                <input type="number" name="red_speed" class="form-control" id="red_speed" value="<?php if ($_SESSION['racket'] !== false) { echo $_SESSION['red']['speed']; } else { echo '0'; }?>" min="0" max="15" required="required">
                            </div>
                        </div>
                        <div class="row">
                            <label for="red_control" class="col-form-label col-sm-2">Contrôle</label>
                            <div class="col-sm-10">
                                <input type="number" name="red_control" class="form-control" id="red_control" value="<?php if ($_SESSION['racket'] !== false) { echo $_SESSION['red']['control']; } else { echo '0'; }?>" min="0" max="15" required="required">
                            </div>
                        </div>
                        <div class="row">
                            <label for="red_rotation" class="col-form-label col-sm-2">Rotation</label>
                            <div class="col-sm-10">
                                <input type="number" name="red_rotation" class="form-control" id="red_rotation" value="<?php if ($_SESSION['racket'] !== false) { echo $_SESSION['red']['rotation']; } else { echo '0'; }?>" min="0" max="15" required="required">
                            </div>
                        </div>

                        <p class="card-text">
                            <span class="font-weight-bold">Revêtement noir <small>(15 pts à répartir)</small></span>
                        </p>
                        <div class="row">
                            <label for="black_speed" class="col-form-label col-sm-2">Vitesse</label>
                            <div class="col-sm-10">
                                <input type="number" name="black_speed" class="form-control" id="black_speed" value="<?php if ($_SESSION['racket'] !== false) { echo $_SESSION['black']['speed']; } else { echo '0'; }?>" min="0" max="15" required="required">
                            </div>
                        </div>
                        <div class="row">
                            <label for="black_control" class="col-form-label col-sm-2">Contrôle</label>
                            <div class="col-sm-10">
                                <input type="number" name="black_control" class="form-control" id="black_control" value="<?php if ($_SESSION['racket'] !== false) { echo $_SESSION['black']['control']; } else { echo '0'; }?>" min="0" max="15" required="required">
                            </div>
                        </div>
                        <div class="row">
                            <label for="black_rotation" class="col-form-label col-sm-2">Contrôle</label>
                            <div class="col-sm-10">
                                <input type="number" name="black_rotation" class="form-control" id="black_rotation" value="<?php if ($_SESSION['racket'] !== false) { echo $_SESSION['black']['rotation']; } else { echo '0'; }?>" min="0" max="15" required="required">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-light mt-3 w-100 float-end">Valider</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3 bg-battle">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-fist-raised"></i> Compétition </h5>
                    <p class="card-text">
                        Le nombre affiché à droite correspond au ratio [ victoires - défaites ] du joueur.
                    </p>
                    <ul class="list-group">
                        <?php
                        foreach ($others as $other) { ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?= $other['firstname'] ?> <?= $other['lastname'] ?>
                                <div>
                                    <a href="index.php?action=competition&user_id=<?= $other['id'] ?>" class="text-ping" title="Affronter"><i class="fas fa-bolt me-2"></i></a>
                                    <span class="badge bg-dark rounded-pill"><?= $other['victories'] - $other['defeats'] ?></span>
                                </div>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
