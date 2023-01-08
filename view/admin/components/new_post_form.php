<!-- Page Nouveau Post -->
<h4>Nouveau post</h4>
<form id="newpostform" action="blogpost.php" method="post">
    <div class="form-floating">
        <input class="form-control" id="title" type="text" placeholder="Titre..." name="title" required />
        <label for="title">Titre :<span style="color:red">*</span></label>
    </div>
    <div class="form-floating">
        <input class="form-control" id="chapo" type="text" placeholder="Chapo..." name="chapo" required />
        <label for="chapo">Chapo :<span style="color:red">*</span></label>
    </div>
    <div class="form-floating">
        <input class="form-control" id="img1" type="text" placeholder="Chemin vers image d'en-tête..." name="img1" required />
        <label for="img1">Chemin vers image d'en-tête :<span style="color:red">*</span></label>
    </div>
    <div class="form-floating">
        <input class="form-control" id="img2" type="text" placeholder="Chemin vers image de corps de texte..." name="img2"/>
        <label for="img2">Chemin vers image de corps de texte :</label>
    </div>
    <div class="form-floating">
        <textarea class="form-control" id="content" placeholder="Contenu de l'article..." style="height: 12rem" name="content" required></textarea>
        <label for="message">Contenu :<span style="color:red">*</span></label>
    </div>
    <input style="display:none" value="" name="date">
    <input style="display:none" value="" name="author">
    <br />
    <!-- Submit Button-->
    <button class="btn btn-primary text-uppercase" id="submitButton" type="submit">Valider</button>
</form>