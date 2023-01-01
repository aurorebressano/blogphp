<?php
namespace Blogphp\Control\Blogpost;

use Blogphp\Model\Blogpost;
use Blogphp\Model\Comment;

if (session_status() !== PHP_SESSION_ACTIVE)
    session_start();

//require_once('model/Blogpost.php');
//require_once('model/Comment.php');

if (isset($_GET["id_blogpost"]))
{
    $post = new Blogpost();
    $comments = new Comment();
    $post = $post->getTheOne($_GET["id_blogpost"]);
    $comments = $comments->findComments($_GET["id_blogpost"]);
    if ($comments == null)
        $comments = "Aucun commentaire pour l'instant";

    if (gettype($post) == "string")
        require 'blogposts.php';
    else
        require 'view/view_blogpost.php';
}
else
    require 'blogposts.php' ;
?>