<!DOCTYPE html>
<?php 
    if($_SERVER['REQUEST_URI'] == '/control/disconnect.php')
        $external_view = "../";
    else
        $external_view = "";

    echo $external_view;
?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Clean Blog - Start Bootstrap Theme</title>
        <!-- Liens -->
        <?php require $external_view."view\components\links.php"; ?>
    </head>
    <body>
        <!-- Navigation-->
        <?php require $external_view."view/components/nav.php"; ?>
        <!-- Page Header-->
        <?php 
            $background_url = $external_view."view/assets/img/about-bg.jpg";
            $header_img = "background-image: url('$background_url')";
            require $external_view."view/components/header.php"; 
        ?>
        <!-- Main Content-->
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="text-center">
                        <img src="<?= $external_view.'view/assets/img/logonb.png' ?>" alt="..." class="img-thumbnail">
                    </div>
                    <h3>Bonjour,</h3>
                    <p>Je m'appelle Aurore Bressano et je suis développeuse informatique.</p>
                    <p>J'ai conçu ce blog afin de me présenter mais aussi pour partager avec vous certains évènements de l'actualité qui m'ont particulièrement intéressée.</p>
                    <p>N'hésitez pas à le parcourir, le commenter, et pourquoi pas, échanger ensemble !</p>
                </div>
            </div>
        </div>
        <!-- Footer-->
        <?php require $external_view."view/components/footer.php"; ?>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src= "<?= $external_view.'view/js/scripts.js' ?>"></script>
    </body>
</html>
