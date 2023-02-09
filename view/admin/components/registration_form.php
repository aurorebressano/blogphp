<form id="contactForm" action="admin.php" method="post">
    <div class="form-floating">
        <input class="form-control" id="name" type="text" placeholder="Nom... " name="name_registration" required />
        <label for="name">Nom :</label>
        <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
    </div>
    <div class="form-floating">
        <input class="form-control" id="name" type="text" placeholder="Prénom..." name="firstname_registration" required />
        <label for="name">Prénom:</label>
        <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
    </div>
    <div class="form-floating">
        <input class="form-control" id="email" type="email" placeholder="Email..." name="email_registration" required />
        <label for="email">Email:</label>
        <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
    </div>
    <div class="form-floating">
        <input class="form-control" id="mdp" type="password" name="pwd_reg" placeholder="Mot de passe..." required />
        <label for="mdp">Mot de passe:</label>
        <div class="invalid-feedback">Veuillez renseigner un mot de passe.</div>
    </div>
    <br />
    <!-- Submit Button-->
    <button class="btn btn-primary text-uppercase" id="submitButton" type="submit">Envoyer</button>
</form>