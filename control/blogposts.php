<?php
if(session_status() !== PHP_SESSION_ACTIVE)
    session_start();

require_once('model/model_blogpost.php');

$posts = new Blogpost();
$posts = $posts->displayBlogpost();
$page_title = "Bienvenue sur mon blog !";

require('view/view_blogposts.php');

?>