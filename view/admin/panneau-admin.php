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
            require "../view/components/header.php"; 
        ?>
        <!-- Main Content-->
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <!-- Post preview-->
                    <ul class="nav justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Commentaires à valider</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Nouveau post</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Demandes d'inscription</a>
                        </li>
                        <!-- Sur chaque blogpost doit apparaitre pour les admin "edit" et "delete" ! -->
                    </ul>
                    <!-- Divider-->
                    <!-- <hr class="my-4" /> -->
                    <br/>
                </div>
            </div>
        </div>
        <!-- Footer-->
        <?php require "../view/components/footer.php"; ?>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
