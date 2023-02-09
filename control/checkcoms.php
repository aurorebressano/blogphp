<!-- Commentaires à valider -->
<?php
use App\Model\Comment;
use App\Model\Account;

if(file_exists('vendor/autoload.php') == true)
    require_once 'vendor/autoload.php';
if(file_exists('../vendor/autoload.php') == true)
    require_once '../vendor/autoload.php';

if (session_status() !== PHP_SESSION_ACTIVE)
    session_start();

if(isset($_SESSION['auth']))
{
    $auth = new Account;
    $auth = $_SESSION['auth'];
    $commentsToCheck = new Comment();
    $commentsToCheck = $commentsToCheck->findComments(null);
}
if(sizeof($commentsToCheck) == 0)
{
    $commentsToCheck = new Comment();
    $commentsToCheck =  $commentsToCheck = "Aucun commentaire à valider";
}

if(isset($_GET['validate']) && $_GET['validate'] != null)
{
    $validation = new Comment();
    $validation = $validation->validateComs($_GET['validate']);
    $_GET['validate'] = null;
    $page_title = "Panneau d'administration";
    $pageToDisplay = "checkcoms.php";
    $header_img = "background-image: url('../view/assets/img/admin.jpg')";
    require_once "../view/admin/panneau-admin.php";
}

if(isset($_GET['delete']) && $_GET['delete'] != null)
{
    $suppression = new Comment();
    $suppression = $suppression->deleteOneCom($_GET['delete']);
    $_GET['delete'] = null;
    $page_title = "Panneau d'administration";
    $pageToDisplay = "checkcoms.php";
    $header_img = "background-image: url('../view/assets/img/admin.jpg')";
    require_once '../view/admin/panneau-admin.php';
}

if(!isset($_GET['validate']) && !isset($_GET['delete']))
{
    require_once "../view/admin/components/comments_validation.php";
}

