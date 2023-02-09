<!-- Account à valider -->
<?php

use App\Model\Account;
require_once '../vendor/autoload.php';

if (session_status() !== PHP_SESSION_ACTIVE)
    session_start();

if (isset($_SESSION['auth']))
{
    $auth = $_SESSION['auth'];
    $regToCheck = new Account();
    $regToCheck = $regToCheck->findNewMembers();
    $regValidated = new Account();
    $regValidated = $regValidated->allUsers();
}

if (sizeof($regToCheck) == 0)
{
    $regToCheck = new Account();
    $regToCheck =  $regToCheck = "Aucun nouveau compte à valider";
}

if (isset($_POST['validatereg']) && $_POST['validatereg'] != null)
{
    $validation = new Account();
    $validation = $validation->registrationValidation($_POST['validatereg']);
    $_POST['validatereg'] = null;
    $pageToDisplay = "checkregistrations.php";
    $page_title = "Panneau d'administration";
    $header_img = "background-image: url('../view/assets/img/admin.jpg')";
    require_once '../view/admin/panneau-admin.php';
}

if (isset($_POST['deletereg']) && $_POST['deletereg'] != null)
{
    $suppression = new Account();
    $suppression = $suppression->deleteRegAccount($_POST['deletereg']);
    $_POST['deletereg'] = null;
    $pageToDisplay = "checkregistrations.php";
    $page_title = "Panneau d'administration";
    $header_img = "background-image: url('../view/assets/img/admin.jpg')";
    require_once '../view/admin/panneau-admin.php';
}

if(!isset($_POST['validatereg']) && !isset($_POST['deletereg']))
{
    require_once "../view/admin/components/register.php";
}
