<?php
if(session_status() !== PHP_SESSION_ACTIVE)
    session_start();

if(isset($_GET["email"]) && isset($_GET['mdp']))
{
    $email = $_GET["email"];
    $password = $_GET['mdp'];
    require('../model/model_accounts.php');

    $auth = isAuth($email, $password);
    $_SESSION['auth'] = $auth;
}
else
{
    $auth = false;
}

if(isset($_SESSION['auth']))
{
    $auth = $_SESSION['auth'];
}

function AdminOrLogin($auth)
{
    if(isset($auth) && $auth != false)
    {
        $path = $path = '../view/admin/panneau-admin.php';
        $page_title = "Panneau d'administration";
        $header_img = "background-image: url('../view/assets/img/admin.jpg')";
    }
    else
    {
        $path = '../view/admin/view_login.php';
        $page_title = "Connexion";
        $header_img = "background-image: url('../view/assets/img/unlock.jpg')";
    }

    $varPages = [$path, $page_title, $header_img];
    
    return $varPages;
}

$path = AdminOrLogin($auth)[0];
$page_title = AdminOrLogin($auth)[1];
$header_img = AdminOrLogin($auth)[2];

require($path);

?>