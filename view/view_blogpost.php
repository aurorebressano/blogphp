<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Blogpost</title>
        <!-- Liens -->
        <?php require "view/components/links.php"; ?>
    </head>
    <body>
        <!-- Navigation-->
        <?php require "view/components/nav.php"; ?>
        <!-- Page Header-->
        <?php 
            $header_img = "background-image: url('view/assets/img/". $post->imgheader ."')";
            require "view/components/blogpost_header.php"; 
        ?>
        <!-- Post Content-->
        <article class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <blockquote class="blockquote"><?= $post->chapo ?></blockquote>
                        <img class="img-fluid" src="<?= "view/assets/img/". $post->imgsecondary?>" alt="..." />
                        <p><?= $post->content ?></p>
                    </div>
                </div>
            </div>
        </article>
        <!-- Comments -->
        <div class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <!-- Divider-->
                        <hr class="my-4" />
                        <h4>Laisser un commentaire (soumis à validation administrateur)</h4>
                        <div class="my-5">
                            <?php require "view/components/comment_form.php"; ?>
                        </div>
                        <!-- Divider-->
                        <hr class="my-4" />
                        <h5>Commentaires</h5>
                        <?php 
                        if (gettype($comments) != "string")
                        {
                            foreach($comments as $comment)
                            {?>
                                <!-- Divider-->
                                <hr class="my-4" />
                                <div class="card">
                                    <div class="card-header">
                                        Pseudonyme: <?=$comment->pseudo;?>
                                    </div>
                                    <div class="card-body">
                                        <blockquote class="blockquote mb-0">
                                        <p><?= $comment->message;?></p>
                                        <footer class="blockquote-footer">Rédigé le <cite title="Source Title"><?=$comment->date;?></cite></footer>
                                        </blockquote>
                                    </div>
                                </div>
                        <?php }
                        }
                        else
                        {?>
                            <!-- Divider-->
                            <hr class="my-4" />
                            <div class="card">
                                <div class="card-body">
                                    <p><?= $comments;?></p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer-->
        <?php require "view/components/footer.php"; ?>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
