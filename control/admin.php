<?php
namespace App\Control\Admin;

use App\Model\Blogpost;
use App\Model\Account;

require_once '../vendor/autoload.php';

if (session_status() !== PHP_SESSION_ACTIVE)
    session_start();

$auth = false;

if(isset($_POST["email"]) && isset($_POST['mdp']))
{
    $email = $_POST["email"];
    $password = $_POST['mdp'];

    $auth = new Account();
    $_SESSION['auth'] = new Account();
    $auth = $auth->isAuth($email, $password);
    $_SESSION['auth'] = $auth;
}

if(!isset($_POST["email"]) && !isset($_POST['mdp'])
&& isset($_POST["email_registration"]) && isset($_POST["name_registration"]) 
&& isset($_POST["firstname_registration"]) && isset($_POST["pwd_reg"]))
{
    $nameReg = htmlspecialchars($_POST["name_registration"]);
    $firstNameReg = htmlspecialchars($_POST['firstname_registration']);
    $emailReg = htmlspecialchars($_POST["email_registration"]);
    $mdpReg = htmlspecialchars($_POST["pwd_reg"]);

    $newMember = new Account();
    $verif = $newMember->isInDB($emailReg);
    if($verif == false)
        $newMember->newMember($nameReg, $firstNameReg, $emailReg, $mdpReg);
        
    $_POST["name_registration"] = null;
    $_POST['firstname_registration'] = null;
    $_POST["email_registration"] = null;
    $_POST["pwd_reg"] = null;
}

if(isset($_SESSION['auth']))
{
    $auth = $_SESSION['auth'];
}

if(!function_exists('AdminOrLogin'))
{
    function AdminOrLogin($auth)
    {
        if(isset($auth) && $auth != false)
        {
            $path = '../view/admin/panneau-admin.php';
            $page_title = "Panneau d'administration";
            $header_img = "background-image: url('../view/assets/img/admin.jpg')";
        }
        if($auth == false && isset($_POST["registration"]))
        {
            $path = '../view/admin/view_registration.php';
            $page_title = "Demande d'inscription";
            $header_img = "background-image: url('../view/assets/img/registration.jpg')";
        }
        if($auth == false && !isset($_POST["registration"]))
        {
            $path = '../view/admin/view_login.php';
            $page_title = "Connexion";
            $header_img = "background-image: url('../view/assets/img/unlock.jpg')";
        }

        $varPages = [$path, $page_title, $header_img];

        return $varPages;
    }
}

$path = AdminOrLogin($auth)[0];
$page_title = AdminOrLogin($auth)[1];
$header_img = AdminOrLogin($auth)[2];
$messagePerso = "Bonjour !";

// Demande d'affichage de gestion admin spécifique
if (isset($_GET["commentvalid"]) || isset($_GET['validate']) || isset($_GET['delete']))
    $pageToDisplay = "checkcoms.php";

if (isset($_GET["newpost"]) && $auth->getType() == "Admin")
    $pageToDisplay = "../view/admin/components/new_post_form.php";

if (isset($_GET['register']) || isset($_POST['validatereg']) || isset($_POST['deletereg']) && $auth->getType() == "Admin")
{
    $pageToDisplay = "checkregistrations.php";
}

if (!isset($_GET["commentvalid"]) && !isset($_GET['newpost']) && !isset($_GET['register']))
    $pageToDisplay = "../view/admin/components/accueil_admin.php";

require $path;

?>