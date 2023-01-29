<form action="admin.php" method="post" id="contactForm">
    <div class="form-floating">
        <input class="form-control" id="email" type="email" name="email" placeholder="Email..." />
        <label for="email">Email:</label>
    </div>
    <div class="form-floating">
        <input class="form-control" id="mdp" name="mdp" type="password" name="password" placeholder="Mot de passe..." />
        <label for="mdp">Mot de passe:</label>
        <div class="invalid-feedback">Veuillez renseigner un mot de passe.</div>
    </div>
    <br />
    <!-- Submit Button-->
    <button class="btn btn-primary text-uppercase" id="submitButton" type="submit">Se connecter</button>
    <button formaction="admin.php" class="btn btn-secondary text-uppercase" id="submitButton" type="submit" name="registration" value="registration">Demande d'inscription</button>
</form>