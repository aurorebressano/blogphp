<!-- Page commentaires à valider -->
<div class="mb-4">
<h4> Valider ou supprimer les nouveaux commentaires en attente</h4><br>
    <div class="container">
        <div class="row"> 
            <?php 
            if($commentsToCheck != null && gettype($commentsToCheck) != "string" && sizeof($commentsToCheck) > 0)
            {  
                foreach($commentsToCheck as $comment)
                {?>
                    <div class="card mb-3">
                        <div class="card-header">
                            Pseudonyme: <?=$comment->pseudo;?>
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                            <p><?= $comment->message;?></p>
                            <footer class="blockquote-footer">Rédigé le <cite title="Source Title"><?=$comment->date;?></cite></footer>
                            </blockquote>
                        </div>
                        <form action="checkcoms.php" class="card-footer" method="get">
                            <button class="btn btn-primary text-uppercase" id="submitButton" type="submit" value="<?= $comment->id ?>" name="validate">Valider</button>
                            <button class="btn btn-primary text-uppercase" id="submitButton" type="submit" value="<?= $comment->id ?>" name="delete">Supprimer</button>
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
                        <p><?= $commentsToCheck;?></p>
                    </div>
                </div>
        <?php } ?>
        </div>
    </div>
</div>