<?php 
if(session_status() !== PHP_SESSION_ACTIVE)
    session_start();

if( isset($_POST["pseudo"]) && isset($_POST["email"]) && isset($_POST["comment"]) && isset($_POST["idpost"]))
{
    require_once('../model/model_comments.php');
    $insert = insertComment($_POST["idpost"], $_POST["pseudo"], $_POST["email"], $_POST["comment"]);
}

require("blogpost.php");

?>