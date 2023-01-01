<?php
namespace Blogphp\Control\Admin;

if (session_status() !== PHP_SESSION_ACTIVE)
    session_start();

//require_once('../model/Account.php');

use Blogphp\Model\Blogpost;
use Blogphp\Model\Account;

var_dump(new Blogpost);

if (isset($_GET["email"]) && isset($_GET['mdp']))
{
    $email = $_GET["email"];
    $password = $_GET['mdp'];
    //require('../model/Account.php');

    $auth = new Account();
    $auth = $auth->isAuth($email, $password);
    $_SESSION['auth'] = $auth;
}
else
{
    $auth = false;
}

if (isset($_SESSION['auth']))
{
    $auth = $_SESSION['auth'];
}

function AdminOrLogin($auth)
{
    if (isset($auth) && $auth != false)
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

// Demande d'affichage de gestion admin spécifique
if (isset($_GET["commentvalid"]) || isset($_GET['validate']) || isset($_GET['delete']))
    $pageToDisplay = "checkcoms.php";

if (isset($_GET["newpost"]))
    $pageToDisplay = "../view/admin/components/new_post_form.php";

if (isset($_GET['register']))
    $pageToDisplay = "../view/admin/components/register.php";

if (!isset($_GET["commentvalid"]) && !isset($_GET['newpost']) && !isset($_GET['register']))
    $pageToDisplay = "../view/admin/components/accueil_admin.php";

require $path;

?>