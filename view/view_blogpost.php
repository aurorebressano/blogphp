<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Clean Blog - Start Bootstrap Theme</title>
        <!-- Liens -->
        <?php require "../view/components/links.php"; ?>
    </head>
    <body>
        <!-- Navigation-->
        <?php require "../view/components/nav.php"; ?>
        <!-- Page Header-->
        <?php 
            $header_img = "background-image: url('../view/assets/img/". $post->imgheader ."')";
            require "../view/components/blogpost_header.php"; 
        ?>
        <!-- Post Content-->
        <article class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <blockquote class="blockquote"><?= $post->chapo ?></blockquote>
                        <img class="img-fluid" src="<?= "../view/assets/img/". $post->imgsecondary?>" alt="..." />
                        <p><?= $post->content ?></p>
                    </div>
                </div>
            </div>
        </article>
        <!-- Footer-->
        <?php require "../view/components/footer.php"; ?>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
