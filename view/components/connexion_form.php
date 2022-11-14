<form id="contactForm">
    <div class="form-floating">
        <input class="form-control" id="email" type="email" placeholder="Enter your email..." data-sb-validations="required,email" />
        <label for="email">Email</label>
        <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
        <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
    </div>
    <div class="form-floating">
        <textarea class="form-control" id="message" placeholder="Mot de passe..." style="height: 12rem" data-sb-validations="required" type="password"></textarea>
        <label for="password">Mot de passe :</label>
        <div class="invalid-feedback" data-sb-feedback="message:required">Mot de passe obligatoire</div>
    </div>
    <br />
    <!-- Submit Button-->
    <button class="btn btn-primary text-uppercase disabled" id="submitButton" type="submit">Send</button>
</form>