<?php 

require_once 'vendor/autoload.php';

use App\Model\Comment;

if (session_status() !== PHP_SESSION_ACTIVE)
    session_start();

if ( isset($_POST["pseudo"]) && isset($_POST["email"]) && isset($_POST["comment"]) && isset($_POST["idpost"]))
{
    $insert = new Comment();
    $insert->insertComment($_POST["idpost"], htmlspecialchars($_POST["pseudo"]), htmlspecialchars($_POST["email"]), htmlspecialchars($_POST["comment"]));
}

require "blogposts.php";

?>