<?php include 'header.php'; ?>

    <div class="creerCompte">
        <fieldset>
            <legend>Créer mon compte</legend>

            <form action="index.php" method="post">
                <label>Mail:
                    <input type="email" name="mail"/>
                </label>
                </br>
                <label>Nom :
                    <input type="text" name="mail"/>
                </label>
                </br>
                <label>Prenom:
                    <input type="text" name="mail"/>
                </label>
                </br>
                <label>Mot de passe:
                    <input type="password" name="MDP"/>
                </label>
                </br>
                <label>Confirmer mot de passe :
                    <input type="password" name="confirmerMDP"/>
                </label>
                </br>
                <input type="button" name="creerCompte" value="Créer compte" />

            </form>
        </fieldset>
    </div>

<?php include "footer.php"; ?>