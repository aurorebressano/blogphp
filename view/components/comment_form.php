<!-- Comment form -->
<form id="contactForm" action="contact.php" method="post">
    <div class="form-floating">
        <input class="form-control" id="name" type="text" placeholder="Nom, prénom..." name="name" required />
        <label for="name">Nom ou pseudonyme:</label>
        <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
    </div>
    <div class="form-floating">
        <input class="form-control" id="email" type="email" placeholder="Email..." name="email" required />
        <label for="email">Email:</label>
        <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
    </div>
    <div class="form-floating">
        <textarea class="form-control" id="comment" placeholder="Commentaire..." style="height: 12rem" name="comment" required></textarea>
        <label for="comment">Commentaire:</label>
        <div class="invalid-feedback" data-sb-feedback="comment:required">A comment is required.</div>
    </div>
    <br />
    <!-- Submit Button-->
    <button class="btn btn-primary text-uppercase" id="submitButton" type="submit">Envoyer</button>
</form>