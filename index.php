<?php
use Blogphp\Model\Route;
require_once("model\Router.php");
//require_once("model\Route.php");

if (session_status() !== PHP_SESSION_ACTIVE)
    session_start();

$route1 = new Route("/index.php", "Bienvenue !", "view/view_index.php");
$route2 = new Route("/index.php?action=blogposts", "Bienvenue", "control/blogposts.php");
$route3 = new Route("/index.php?action=contact", "Bienvenue", "control/contact.php");
$arrRoutes = [$route1, $route2, $route3];

if (isset($_GET["id_blogpost"]))
{
    $route4 = new Route("/index.php?id_blogpost=". $_GET["id_blogpost"], "Bienvenue", "control/blogpost.php");
    array_push($arrRoutes, $route4);
}

$router = new Router();

$router->mapRoutes($arrRoutes);

$router->redirect($_SERVER['REQUEST_URI']); 


?>