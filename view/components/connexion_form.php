<form id="contactForm" data-sb-form-api-token="API_TOKEN">
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
    <!-- Submit success message-->
    <!---->
    <!-- This is what your users will see when the form-->
    <!-- has successfully submitted-->
    <div class="d-none" id="submitSuccessMessage">
        <div class="text-center mb-3">
            <div class="fw-bolder">Form submission successful!</div>
            To activate this form, sign up at
            <br />
            <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
        </div>
    </div>
    <!-- Submit error message-->
    <!---->
    <!-- This is what your users will see when there is-->
    <!-- an error submitting the form-->
    <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
    <!-- Submit Button-->
    <button class="btn btn-primary text-uppercase disabled" id="submitButton" type="submit">Send</button>
</form>