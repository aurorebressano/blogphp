<?php

if(session_status() !== PHP_SESSION_ACTIVE)
    session_start();

$page_title = "Contact";

require('../view/view_contact.php');

?>