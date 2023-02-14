<?php 
namespace App\Control;
use App\Model\Comment;
use App\Model\Account;

if(file_exists('vendor/autoload.php') == true)
    require_once 'vendor/autoload.php';
if(file_exists('../vendor/autoload.php') == true)
    require_once '../vendor/autoload.php';

if (session_status() !== PHP_SESSION_ACTIVE)
    session_start();

class Guardian
{
    function AdminOrLogin($auth)
    {
        if(isset($auth) && $auth != false)
        {
            $path = '../view/admin/panneau-admin.php';
            $page_title = "Panneau d'admin";
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