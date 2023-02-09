<?php
namespace App;
if (session_status() !== PHP_SESSION_ACTIVE)
    session_start();

require_once 'vendor/autoload.php';

use App\Model\Route;
use App\Model\Router;

$router = new Router();

$route1 = new Route("/index.php", "Bienvenue !", "/view/view_index.php");
$route2 = new Route("/index.php?action=blogposts", "Bienvenue", "/control/blogposts.php");
$route3 = new Route("/index.php?action=contact", "Bienvenue", "/control/contact.php");
//if(isset($redirectfromcontact) && $redirectfromcontact == true) 
    //$route3->setControllerRedirect("/view/view_index.php");

$route4 = new Route("/index.php?action=comment", "Bienvenue", "/control/comment.php");
//$route5 = new Route("/index.php?action=registration", "Bienvenue !", "/control/admin.php");
$arrRoutes = [$route1, $route2, $route3, $route4];

if(isset($_GET["id_blogpost"]) || isset($_GET['idpost']))
{
    $idpost = isset($_GET["id_blogpost"])?$_GET["id_blogpost"]: $_GET['idpost'];
    $route6 = new Route("/index.php?id_blogpost=".$idpost, "Bienvenue", "/control/blogpost.php");
    array_push($arrRoutes, $route6);
}
/*
if(isset($_GET['idpost']))
{
    $route6 = new Route("/index.php?idpost=". $_POST('idpost'), "Bienvenue", "/control/blogpost.php");
    array_push($arrRoutes, $route6);
}*/

$router->mapRoutes($arrRoutes);

$router->redirect($_SERVER['REQUEST_URI']); 


?>