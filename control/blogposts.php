<?php
namespace Blogphp\Control\Blogposts;

use Blogphp\Model\Blogpost;

//class Blogposts{}

if (session_status() !== PHP_SESSION_ACTIVE)
    session_start();

//require_once('model/Blogpost.php');

$posts = new Blogpost();
$posts = $posts->displayBlogpost();
$page_title = "Bienvenue sur mon blog !";

require 'view/view_blogposts.php';

?>