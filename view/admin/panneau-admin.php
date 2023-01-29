<?php
use App\Model\Account;

if(file_exists('vendor/autoload.php') == true)
    require_once 'vendor/autoload.php';
if(file_exists('../vendor/autoload.php') == true)
    require_once '../vendor/autoload.php';

if (session_status() !== PHP_SESSION_ACTIVE)
    session_start();

$auth = new Account();
$auth = $_SESSION['auth'];

?>

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
        <div class="container justify-content-center">
            <!-- Admin nav -->
            <form action="admin.php" method="get" class="nav justify-content-center mt-0 mb-0">
            <?php if($auth->getType() == "Admin"){?>
                <button class="btn btn-link nav-item mt-0 mb-0" name="newpost" type="submit">
                    <p class="mt-0 mb-0">Nouveau post</p>
                </button>
            <?php }?>
                <button class="btn btn-link nav-item mt-0 mb-0" name ="commentvalid" type="submit">
                    <p class="mt-0 mb-0">Commentaires à valider</p>
                </button>
            <?php if($auth->getType() == "Admin"){?> 
                <button class="btn btn-link nav-item mt-0 mb-0" name="register" type="submit">
                    <p class="mt-0 mb-0">Demandes d'inscription</p>
                </button>
            <?php }?>
            </form>
        </div>
        <!-- Divider-->
        <hr class="my-4" />
        <main class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="my-5">
                            <!-- Appel du composant à afficher -->
                            <?php require $pageToDisplay; ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Footer-->
        <?php require "../view/components/footer.php"; ?>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
