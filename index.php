<?php

require_once("model\Router.php");
require_once("model\Route.php");

    if(session_status() !== PHP_SESSION_ACTIVE)
        session_start();

    $route1 = new Route("/blogphp/index.php", "Bienvenue !", "view/view_index.php");
    $route2 = new Route("/blogphp/index.php?=blogposts", "Bienvenue", "control/blogposts.php");
    $route3 = new Route("/blogphp/index.php?=contact", "Bienvenue", "control/contact.php");
    $arrRoutes = [$route1, $route2, $route3];

    if(isset($_GET["id_blogpost"]))
    {
        $route4 = new Route("/blogphp/index.php?id_blogpost=". $_GET["id_blogpost"], "Bienvenue", "control/blogpost.php");
        array_push($arrRoutes, $route4);
    }

    $router = new Router();

    $router->mapRoutes($arrRoutes);

    $router->redirect($_SERVER['REQUEST_URI']); 


?>