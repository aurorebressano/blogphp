<?php
if (session_status() !== PHP_SESSION_ACTIVE)
    session_start();

unset($_SESSION['auth']);

require_once('../control/index.php');