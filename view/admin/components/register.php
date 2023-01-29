<!-- Page demande d'inscription -->
<div class="mb-4">
<h4> Valider ou supprimer les nouvelles demandes d'inscription</h4><br>
    <div class="container">
        <div class="row"> 
            <?php 
            if ($regToCheck != null && gettype($regToCheck) != "string" && sizeof($regToCheck) > 0)
            {  
                foreach($regToCheck as $reg)
                {?>
                    <div class="card mb-3">
                        <div class="card-header">
                            <?= $reg->getName(); ?> 
                            <?= $reg->getFirstName(); ?>
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                            <p><?= $reg->getEmail();?></p>
                            <footer class="blockquote-footer">Rôle: <cite title="Source Title"><?=$reg->getType();?></cite></footer>
                            </blockquote>
                        </div>
                        <form action="checkregistrations.php" class="card-footer" method="post">
                            <button class="btn btn-primary text-uppercase" id="submitButton" type="submit" value="<?= $reg->getId() ?>" name="validatereg">Valider</button>
                            <button class="btn btn-primary text-uppercase" id="submitButton" type="submit" value="<?= $reg->getId() ?>" name="deletereg">Supprimer</button>
                        </form>
                    </div>
            <?php }
            }
            else
            {?>
                <!-- Divider-->
                <hr class="my-4" />
                <div class="card">
                    <div class="card-body">
                        <p><?= $regToCheck;?></p>
                    </div>
                </div>
        <?php } 
        if($regValidated != null && sizeof($regValidated) > 0)
        {?>
            <h5 class="mt-5">Comptes utilisateurs validés</h5>
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Rôle</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $i = 0;
                foreach($regValidated as $regVal)
                {
                    ++$i; ?>
                    <tr>
                        <th scope="row"><?= $i ?></th>
                        <td><?= $regVal->getName() ?></td>
                        <td><?= $regVal->getFirstName() ?></td>
                        <td><?= $regVal->getEmail() ?></td>
                        <td><?= $regVal->getType() ?></td>
                    </tr>
          <?php }
        } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>