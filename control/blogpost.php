<?php
if(session_status() !== PHP_SESSION_ACTIVE)
    session_start();

require_once('../model/model_blogpost.php');

$post = getTheOne($_GET["id_blogpost"]);

require('../view/view_blogpost.php');

?>