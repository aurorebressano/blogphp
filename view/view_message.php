// Page d'affichage de messages puis redirection

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Clean Blog - Start Bootstrap Theme</title>
        <!-- Liens -->
        <?php 
            if(file_exists("view/components/links.php") == true)
                require "view/components/links.php"; 
            else
                require "components/links.php";
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
        <!-- Page Header-->
        <?php 
            $header_img = "background-image: url('view/assets/img/view_message.php')";
            if(file_exists("view/components/header.php") == true)
                require "view/components/header.php"; 
            else
                require "components/header.php"; 
        ?>
        <!-- Main Content-->
        <div class="container justify-content-center">
            <!-- Admin nav -->
        <main>
            <h5><?= $message; ?></h5>
            <form action="index.php" method="get" class="nav justify-content-center mt-0 mb-0">
                <button class="btn btn-link nav-item mt-0 mb-0" name="accueil" type="submit">
                    <p class="mt-0 mb-0">Retour à la page d'accueil</p>
                </button>
            </form>
        </main>
        </div>
        <!-- Divider-->
        <hr class="my-4" />
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
        <script src="js/scripts.js"></script>
    </body>
</html>