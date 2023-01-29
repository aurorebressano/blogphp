<?php 
    $root = $_SERVER['WEB_ROOT'] = str_replace($_SERVER['SCRIPT_NAME'],'',$_SERVER['SCRIPT_FILENAME']); 
    $host = $_SERVER['HTTP_HOST'];
    $protocol=$_SERVER['PROTOCOL'] = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https' : 'http';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Blog</title>
        <!-- Liens -->
        <?php 
        if(file_exists("view/components/links.php") == true)
            require "view/components/links.php"; 
        if(file_exists("components/links.php") == true)
            require "components/links.php";
        if(file_exists("../view/components/links.php") == true)
            require "../view/components/links.php";
        ?>
    </head>
    <body>
        <!-- Navigation-->
        <?php 
            if(file_exists("view/components/nav.php") == true)
                require "view/components/nav.php"; 
            else
                require "components/nav.php"; 
        ?>
        <?php 
            if(file_exists("view/assets/img/news1.jpg"))
                $header_img = "background-image: url('view/assets/img/news1.jpg')";
            if(file_exists("../view/assets/img/news1.jpg"))
                $header_img = "background-image: url('../view/assets/img/news1.jpg')";
            if(file_exists("view/components/header.php") == true)
                require "view/components/header.php"; 
            else
                require "components/header.php"; 
        ?>
        <!-- Main Content-->
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <!-- Post preview-->
                    <?php 
                    if($posts != null && sizeof($posts) > 0)
                    {
                        foreach($posts as $post)
                        {
                            ?>
                            <div class="post-preview">
                                <form action="index.php?id_blogpost=" method="get">
                                    <button class="btn btn-link" name= "id_blogpost" value = "<?=$post->getId()?>" type="submit">
                                            <h2 class="post-title"><?= $post->displayTitle() ?></h2>
                                            <p><?= $post->displayChapo() ?></p>
                                    </button>
                                </form>
                                <p class="post-meta">
                                    Posted by
                                    <?= $post->displayAuthor() ?>
                                    on <?= $post->displayDate() ?>
                                </p>
                            </div>
                            <hr class="my-4" />
                    <?php }  
                    }
                    else
                    {
                        echo 'Aucun blogpost à afficher';
                    }
                    ?>
                    <!-- Pager-->
                    <!-- <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Older Posts →</a></div> -->
                </div>
            </div>
        </div>
        <!-- Footer-->
        <?php 
            if(file_exists("view/components/footer.php") == true)
                require "view/components/footer.php";
            else
                require "components/footer.php";
        ?>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        
    </body>
</html>
