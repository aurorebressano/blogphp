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
        <title>Blogpost</title>
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
            if(file_exists("background-image: url('view/assets/img/". $post->displayImgheader()) == true)
                $header_img = "background-image: url('view/assets/img/". $post->displayImgheader() ."')"; 
            else
                $header_img = "background-image: url('../view/assets/img/". $post->displayImgheader() ."')"; 

            if(file_exists("view/components/blogpost_header.php") == true)
                require "view/components/blogpost_header.php"; 
            else
                require "components/blogpost_header.php"; 
        ?>
        <!-- Post Content-->
        <?php 
            if(isset($_SESSION['auth']) && $_SESSION['auth'] != false)
            {
                if($auth->getType() == "Admin") // Récupérer l'objet Account !
                {?>
                <div class="container justify-content-center">
                    <!-- Admin nav -->
                    <div class="nav justify-content-center mt-0 mb-0"> 
                        <form action="../control/blogpost.php" method="get">
                            <input style="display:none" name="id_blogpost" value = "<?= $post->getId() ?>" >
                            <button class="btn btn-link nav-item mt-0 mb-0" name ="editblogpost" type="submit" value = "<?= $post->getId() ?>">
                                <p class="mt-0 mb-0">Editer</p>
                            </button>
                        </form>
                        <div>
                            <button id="del" class="btn btn-link nav-item mt-0 mb-0" name="deleteblogpost" type="submit" value = "<?= $post->getId() ?>" onclick="deleteConfirm()">
                                <p class="mt-0 mb-0">Supprimer</p>
                            </button>
                        </div>
                    </div>
                </div>
                <hr>
        <?php   }
            }
    if(!isset($_GET["editblogpost"]))
    {?>
        <article class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <blockquote class="blockquote"><?= $post->displayChapo() ?></blockquote>
                        <img class="img-fluid" src="<?= "view/assets/img/". $post->displayImgsecondary()?>" alt="..." />
                        <p><?= $post->displayContent() ?></p>
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
                            <?php 
                                if(file_exists("view/components/comment_form.php") == true)
                                    require "view/components/comment_form.php"; 
                                else
                                    require "components/comment_form.php";
                            ?>
                        </div>
                        <!-- Divider-->
                        <hr class="my-4" />
                        <h5>Commentaires</h5>
                        <?php 
                        if (gettype($comments) != "string" && gettype($comments) == "array" && !empty($comments) && isset($comments) && sizeof($comments) > 0)
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
                        <?php  }
                        }
                        if(gettype($comments) == "string")
                        {?>
                            <!-- Divider-->
                            <hr class="my-4" />
                            <div class="card">
                                <div class="card-body">
                                    <p><?= $comments; ?></p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
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
    <script>function deleteConfirm()
    {
        var confirmation = window.confirm('Etes-vous sûr de vouloir supprimer ce blogpost ?') ;
        if(confirmation === true)
        {
            //window.alert("ADIEU !");
            window.location.href = "../control/blogpost.php?id_blogpost=" + <?= (isset($_GET['deleteblogpost']) ? $_GET['deleteblogpost'] : isset($_GET['id_post']))? $_GET['id_post'] : $post->getId() ?> + "&deleteblogpost=" + <?= (isset($_GET['deleteblogpost']) ? $_GET['deleteblogpost'] : isset($_GET['id_post']))? $_GET['id_post'] : $post->getId() ?>;
        }
        //if(confirmation === false)
        //{
            //window.open("blogpost.php", "Thanks for Visiting!");
            //window.alert(confirmation);
            //window.location.href = "index.php?id_blogpost=" + <?= (isset($_GET['deleteblogpost']) ? $_GET['deleteblogpost'] : isset($_GET['id_post']))? $_GET['id_post'] : $post->getId() ?>;
        //}
    }
    </script>
</html>
