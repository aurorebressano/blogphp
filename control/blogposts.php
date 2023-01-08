<?php
namespace App\Control;
require_once 'vendor/autoload.php';

use App\Model\Blogpost;

if (session_status() !== PHP_SESSION_ACTIVE)
    session_start();

$posts = new Blogpost();
$posts = $posts->displayBlogpost();
$page_title = "Bienvenue sur mon blog !";

require 'view/view_blogposts.php';

?>