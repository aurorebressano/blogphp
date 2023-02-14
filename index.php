<?php
namespace App;

use App\Routes\Route;
use App\Routes\Router;
use App\Model\Account;
use App\Control\CommentController;

if(file_exists('vendor/autoload.php') == true)
    require_once 'vendor/autoload.php';
if(file_exists('../vendor/autoload.php') == true)
    require_once '../vendor/autoload.php';

if (session_status() !== PHP_SESSION_ACTIVE)
    session_start();

$router = new Router();

$route1 = new Route("/index.php", "Bienvenue !", "/view/view_index.php");
$route2 = new Route("/index.php?action=blogposts", "Bienvenue", "/control/blogposts.php");
$route3 = new Route("/index.php?action=contact", "Bienvenue", "/control/contact.php");

$arrRoutes = [$route1, $route2, $route3];

if(isset($_GET["id_blogpost"]) || isset($_GET['idpost']))
{
    if(!isset($_POST["pseudo"]) && !isset($_POST["email"]) && !isset($_POST["comment"]))
    {
        $idpost = isset($_GET["id_blogpost"])?$_GET["id_blogpost"]: $_GET['idpost'];
        $route6 = new Route("/index.php?id_blogpost=".$idpost, "Bienvenue", "/control/blogpost.php");
        array_push($arrRoutes, $route6);
    }
}

// Ajout nouveau commentaire
if(isset($_POST["pseudo"]) && isset($_POST["email"]) && isset($_POST["comment"]) && isset($_POST["idpost"]) && !isset($_GET["id_blogpost"]))
{
    $pseudo = $_POST["pseudo"];
    $email = $_POST["email"];
    $comment = $_POST["comment"];
    $idpost = $_POST["idpost"];

    $newCom = new CommentController();
    $newCom->newComment($pseudo, $email, $comment, $idpost);
    $route7 = new Route("/index.php?id_blogpost=".$idpost, "Bienvenue", "/control/blogpost.php");
    array_push($arrRoutes, $route7);
    $router->mapRoutes($arrRoutes);
    $router->redirect("/index.php?id_blogpost=".$idpost); 
    exit();
}

$router->mapRoutes($arrRoutes);
$router->redirect($_SERVER['REQUEST_URI']); 
?>