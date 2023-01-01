<!-- Commentaires à valider -->
<?php

if (session_status() !== PHP_SESSION_ACTIVE)
    session_start();

require_once("../model/Comment.php");

if (isset($_SESSION['auth']))
{
    $auth = $_SESSION['auth'];
    $commentsToCheck = new Comment();
    $commentsToCheck = $commentsToCheck->findComments(null);
}
if (sizeof($commentsToCheck) == 0)
    $commentsToCheck =  $commentsToCheck = "Aucun commentaire à valider";

if (isset($_GET['validate']) && $_GET['validate'] != null)
{
    $commentsToCheck = $commentsToCheck->validateComs($_GET['validate']);
    $_GET['validate'] = null;
    header("admin.php");
}

if (isset($_GET['delete']) && $_GET['delete'] != null)
{
    $commentsToCheck = $commentsToCheck->deleteOneCom($_GET['delete']);
    $_GET['delete'] = null;
    header("admin.php");
}

require "../view/admin/components/comments_validation.php";
