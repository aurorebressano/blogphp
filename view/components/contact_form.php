<form id="contactForm" action="contact.php" method="post">
    <div class="form-floating">
        <input class="form-control" id="name" type="text" placeholder="Nom, prénom..." name="name" required />
        <label for="name">Nom, prénom:</label>
        <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
    </div>
    <div class="form-floating">
        <input class="form-control" id="email" type="email" placeholder="Email..." name="email" required />
        <label for="email">Email:</label>
        <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
    </div>
    <div class="form-floating">
        <input class="form-control" id="phone" type="tel" placeholder="Numéro de téléphone..." name="phone"/>
        <label for="phone">Numéro de téléphone (facultatif):</label>
        <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
    </div>
    <div class="form-floating">
        <textarea class="form-control" id="message" placeholder="Message..." style="height: 12rem" name="message" required></textarea>
        <label for="message">Message:</label>
        <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
    </div>
    <br />
    <!-- Submit Button-->
    <button class="btn btn-primary text-uppercase" id="submitButton" type="submit">Envoyer</button>
</form>