<?php
namespace App\Control\Blogpost;

use App\Model\Blogpost;
use App\Model\Comment;
use App\Model\Route;
use App\Model\Router;

if(file_exists('vendor/autoload.php') == true)
    require_once 'vendor/autoload.php';
if(file_exists('../vendor/autoload.php') == true)
    require_once '../vendor/autoload.php';

if (session_status() !== PHP_SESSION_ACTIVE)
    session_start();

// Redirection vers instance blogpost si: 
//- demande de lecture via blogposts 
//- Creation d'un com sur un blogpost 
//- Creation d'un nouveau blogpost
//- ou edition d'un blogpost
if(isset($_GET["id_blogpost"]) 
|| isset($_GET["idpost"]) 
|| isset($_POST["editvalidation"])
|| isset($_POST["newtitle"]))
{
    if (!isset($_GET["editblogpost"]) && !isset($_GET["deleteblogpost"]))
    {
        $idpost = null;

        if(isset($_GET["id_blogpost"]))
            $idpost = $_GET["id_blogpost"];
            if(isset($_GET["idpost"]))
                $idpost =  $_GET["idpost"];
                if(isset($_POST["editvalidation"]))
                    $idpost = $_POST["editvalidation"];

        $post = new Blogpost();
        $post = $post->getTheOne($idpost);
        $comments = null;
        
        if(isset($idpost) && !empty($idpost))
        {
            $comments = new Comment();
            $comments = $comments->findComments($idpost);
        }
        if($comments == null)
            $comments = "Aucun commentaire pour l'instant";

        // redirection sur l'editblogpost via new blogpost après modif
        if(isset($_POST["editvalidation"]))
        {
            if(isset($_POST["edittitle"]) 
            && isset($_POST["editchapo"]) 
            && isset($_POST["editcontent"]) 
            && isset($_POST["editimg1"]))
            {
                $edit = new Blogpost();
                $edit->editBlogpost($idpost, $_POST["edittitle"], $_POST["editchapo"], $_POST["editcontent"], $_POST["editimg1"], $_POST["editimg2"]);
            }
        }

        // new blogpost via formulaire
        if(!isset($_POST["editvalidation"]) 
        && !isset($_GET["id_blogpost"]) 
        && !isset($_GET["idpost"]) 
        && !isset($_GET["editblogpost"]) 
        && isset($_POST["newtitle"]) 
        && isset($_POST["newchapo"]) 
        && isset($_POST["newimg1"]) 
        && isset($_POST["newcontent"]))
        {
            $author = $_SESSION['auth']->getId();
            $insert = new Blogpost();
            $insert->newBlogpost($_POST["newtitle"], $author, $_POST["newchapo"], $_POST["newcontent"], $_POST["newimg1"], $_POST["newimg2"]);
            $post = $insert->getTheOne();
        }

        if (gettype($post) == "string")
        {
            if(file_exists("index.php?action=blogposts") == true)
                require "index.php?action=blogposts";
            else
                require "../index.php?action=blogposts";
        }
        else
        {
            if(file_exists('view/view_blogpost.php') == true)
                require 'view/view_blogpost.php';
            else
                require '../view/view_blogpost.php';
        }
            
    }
}

// editblogpost via view blogpost 
if(isset($_GET["id_blogpost"]) 
&& !isset($_GET["editblogpost"]) 
&& !isset($_POST["newtitle"])
&& !isset($_GET["deleteblogpost"]))
{
    $id = $_GET["id_blogpost"];
    $edit = new Blogpost();
    $edit->getTheOne($_GET["id_blogpost"]);
}
if(isset($_GET["editblogpost"]) && !isset($_POST["newtitle"]))
{
    $id = $_GET["editblogpost"];
    $edit = new Blogpost();
    $edit = $edit->getTheOne($_GET["editblogpost"]);

    $pageToDisplay = "../view/admin/components/new_post_form.php";
    $page_title = "Panneau d'administration";
    $header_img = "background-image: url('../view/assets/img/admin.jpg')";
    require_once '../view/admin/panneau-admin.php';
}

// deleteblogpost via view blogpost
if(isset($_GET["id_blogpost"]) && isset($_GET["deleteblogpost"]))
{
    $delete = new Blogpost();
    $delete->deleteBlogpost($_GET["id_blogpost"]);

    $pageToDisplay = "../view/admin/components/accueil_admin.php";
    $page_title = "Panneau d'administration";
    $header_img = "background-image: url('../view/assets/img/admin.jpg')";
    $messagePerso = "Blogpost bien supprimé";
    require_once '../view/admin/panneau-admin.php';
}

if(!isset($_GET["id_blogpost"]) 
&& !isset($_GET["idpost"]) 
&& !isset($_POST["editvalidation"])
&& !isset($_POST['newtitle']))
{
    require "../index.php";
}

?>