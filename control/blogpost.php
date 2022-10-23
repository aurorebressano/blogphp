<?php
if(session_status() !== PHP_SESSION_ACTIVE)
    session_start();

require_once('../model/model_blogpost.php');
require_once('../model/model_comments.php');

if(isset($_GET["id_blogpost"]))
{
    $post = getTheOne($_GET["id_blogpost"]);
    $comments = findComments($_GET["id_blogpost"]);
    if($comments == null)
        $comments = "Aucun commentaire pour l'instant";

    if(gettype($post) == "string")
        require('blogposts.php');
    else
        require('../view/view_blogpost.php');
}
else
    require('blogposts.php');
?>