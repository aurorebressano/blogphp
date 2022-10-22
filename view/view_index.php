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
            $header_img = "background-image: url('../view/assets/img/about-bg.jpg')";
            require "../view/components/header.php"; 
        ?>
        <!-- Main Content-->
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <!-- Post preview-->
                    <?php 
                    foreach($posts as $post)
                    {?>
                        <div class="post-preview">
                            <a href="blogpost.php">
                                <h2 class="post-title"><?= $post->title ?></h2>
                                <h3 class="post-subtitle"><?= $post->chapo ?></h3>
                                <form style="display:none" name= "id_blogpost" value = "<?=$post->id ?>"></form>
                            </a>
                            <p class="post-meta">
                                Posted by
                                <?= $post->author ?>
                                on <?= $post->date ?>
                            </p>
                        </div>
                        <!-- Divider-->
                        <hr class="my-4" />
                <?php } ?>
                    <!-- Pager-->
                    <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Older Posts →</a></div>
                </div>
            </div>
        </div>
        <!-- Footer-->
        <?php require "../view/components/footer.php"; ?>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../view/js/scripts.js"></script>
    </body>
</html>
