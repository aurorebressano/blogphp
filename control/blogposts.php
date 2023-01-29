<?php
namespace App\Control;

if(file_exists('vendor/autoload.php') == true)
    require_once 'vendor/autoload.php';
if(file_exists('../vendor/autoload.php') == true)
    require_once '../vendor/autoload.php';

use App\Model\Blogpost;

if (session_status() !== PHP_SESSION_ACTIVE)
    session_start();


$root = $_SERVER['WEB_ROOT'] = str_replace($_SERVER['SCRIPT_NAME'],'',$_SERVER['SCRIPT_FILENAME']); 
$host = $_SERVER['HTTP_HOST'];
$protocol=$_SERVER['PROTOCOL'] = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https' : 'http';

$posts = new Blogpost();
$posts = $posts->displayBlogpost();
$page_title = "Parcourez mes blogposts ";

if(file_exists("view/view_blogposts.php") == true)
{
    require "view/view_blogposts.php";
}
if(file_exists("../view/view_blogposts.php") == true)
{
    echo "Aucun chemin trouvé pour l'affichage";
    require "../view/view_blogposts.php";
}
if(file_exists("view_blogposts.php") == true)
    require "view_blogposts.php";

?>