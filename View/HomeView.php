<?php $this->title = 'Accueil'; ?>

<div class="container-fluid p-0">
    <div class="row">
        <div class="col-12 slider">
            <p><span class="text-ping">Tennis de Table</span><br>Simulation et Gestion d'un compétiteur</p>
        </div>
    </div>
</div>

<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-md-6 p-3">
            <div class="connection">
                <h1><i class="fas fa-sign-in-alt"></i> Connexion</h1>

                <div class="form-block border border-top-0 rounded p-3">
                    <form action="index.php?action=connexion" method="post">
                        <table class="w-100">
                            <tr>
                                <td class="w-50 font-weight-bold">Adresse mail</td>
                                <td class="w-50"><input type="email" name="email" /></td>
                            </tr>
                            <tr>
                                <td class="w-50 font-weight-bold">Mot de passe</td>
                                <td class="w-50"><input type="password" name="password" /></td>
                            </tr>
                        </table>
                        <p>
                            <input type="submit" name="signin" value="Valider" class="btn btn-ping mt-3">
                        </p>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-md-6 p-3">
            <div class="registration">
                <h2><i class="fas fa-user-plus"></i> Inscription</h2>

                <div class="form-block border border-top-0 rounded p-3">
                    <form action="index.php?action=inscription" method="post">
                        <table class="w-100">
                            <tr>
                                <td class="w-50 font-weight-bold">Nom</td>
                                <td class="w-50"><input type="text" name="lastname" /></td>
                            </tr>
                            <tr>
                                <td class="w-50 font-weight-bold">Prénom</td>
                                <td class="w-50"><input type="text" name="firstname" /></td>
                            </tr>
                            <tr>
                                <td class="w-50 font-weight-bold">Adresse mail</td>
                                <td class="w-50"><input type="email" name="email" /></td>
                            </tr>
                            <tr>
                                <td class="w-50 font-weight-bold">Mot de passe</td>
                                <td class="w-50"><input type="password" name="password" /></td>
                            </tr>
                            <tr>
                                <td class="w-50 font-weight-bold">Confirmation</td>
                                <td class="w-50"><input type="password" name="confirm" /></td>
                            </tr>
                        </table>
                        <p>
                            <input type="submit" name="signup" value="Valider" class="btn btn-ping mt-3">
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
