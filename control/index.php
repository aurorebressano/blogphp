<?php
if(session_status() !== PHP_SESSION_ACTIVE)
    session_start();

$page_title = "Bienvenue !";

require('../view/view_index.php');

?>