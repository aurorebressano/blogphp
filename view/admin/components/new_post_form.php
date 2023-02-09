<!-- Page Nouveau Post -->
<?php 
if(!isset($_GET["editblogpost"]))
{?>
    <h4>Nouveau post</h4>
    <form id="newpostform" action="blogpost.php" method="post">
        <div class="form-floating">
            <input class="form-control" id="title" type="text" placeholder="Titre..." name="newtitle" required />
            <label for="title">Titre :<span style="color:red">*</span></label>
        </div>
        <div class="form-floating">
            <input class="form-control" id="chapo" type="text" placeholder="Chapo..." name="newchapo" required />
            <label for="chapo">Chapo :<span style="color:red">*</span></label>
        </div>
        <div class="form-floating">
            <input class="form-control" id="img1" type="text" placeholder="Chemin vers image d'en-tête..." name="newimg1" required />
            <label for="img1">Chemin vers image d'en-tête :<span style="color:red">*</span></label>
        </div>
        <div class="form-floating">
            <input class="form-control" id="img2" type="text" placeholder="Chemin vers image de corps de texte..." name="newimg2"/>
            <label for="img2">Chemin vers image de corps de texte :</label>
        </div>
        <div class="form-floating">
            <textarea class="form-control" id="content" placeholder="Contenu de l'article..." style="height: 12rem" name="newcontent" required></textarea>
            <label for="message">Contenu :<span style="color:red">*</span></label>
        </div>
        <br />
        <!-- Submit Button-->
        <button class="btn btn-primary text-uppercase" id="submitButton" type="submit">Valider</button>
    </form>
<?php } 
else
{?>
    <h4>Modification du post</h4>
    <form id="newpostform" action="blogpost.php" method="post">
        <div class="form-floating">
            <input class="form-control" id="title" type="text" name="edittitle" placeholder = "<?= $edit->displayTitle() ?>" value= "<?= $edit->displayTitle() ?>"/>
            <label for="title">Titre :<span style="color:red"></span></label>
        </div>
        <div class="form-floating">
            <input class="form-control" id="chapo" type="text" name="editchapo" placeholder = "<?= $edit->displayChapo() ?>" value= "<?= $edit->displayChapo() ?>"/>
            <label for="chapo">Chapo :<span style="color:red"></span></label>
        </div>
        <div class="form-floating">
            <input class="form-control" id="img1" type="text" name="editimg1" value= "<?= $edit->displayImgHeader() ?>"/>
            <label for="img1">Chemin vers image d'en-tête :<span style="color:red"></span></label>
        </div>
        <div class="form-floating">
            <input class="form-control" id="img2" type="text" name="editimg2" value= "<?= $edit->displayImgSecondary() ?>"/>
            <label for="img2">Chemin vers image de corps de texte :</label>
        </div>
        <div class="form-floating">
            <textarea class="form-control" id="content" style="height: 12rem" name="editcontent"><?= $edit->displayContent() ?></textarea>
            <label for="message">Contenu :<span style="color:red"></span></label>
        </div>
        <input type="hidden" style="display=none" name="editvalidation" value = "<?= $edit->getId() ?>" >
        <br />
        <!-- Submit Button-->
        <button class="btn btn-primary text-uppercase" id="submitButton" type="submit" >Valider</button>
    </form>
<?php } ?>