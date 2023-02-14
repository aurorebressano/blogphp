<?php 
namespace App\Control;
use App\Model\Comment;
use App\Model\Account;

if(file_exists('vendor/autoload.php') == true)
    require_once 'vendor/autoload.php';
if(file_exists('../vendor/autoload.php') == true)
    require_once '../vendor/autoload.php';

if (session_status() !== PHP_SESSION_ACTIVE)
    session_start();

class CommentController
{
    // Nouveau commentaire
    function newComment($pseudo, $email, $comment, $idpost)
    {
        $insert = new Comment();
        $insert->insertComment($idpost, htmlspecialchars($pseudo), htmlspecialchars($email), htmlspecialchars($comment));

        $_GET["id_blogpost"] = $idpost;
    }

    // Commentaires à valider / supprimer partie admin
    function allCommentsToValidate()
    {
        $commentsToCheck = new Comment();
        $commentsToCheck = $commentsToCheck->findComments(null);

        if(gettype($commentsToCheck) == 'array' && sizeof($commentsToCheck) == 0 || gettype($commentsToCheck) == 'string')
        {
            $commentsToCheck = "Aucun commentaire à valider";
        }
        $page_title = "Panneau d'admin";
        $header_img = "background-image: url('../view/assets/img/admin.jpg')";
        $pageToDisplay = "../view/admin/components/comments_validation.php";
        require_once "../view/admin/panneau-admin.php";
        exit();
    }

    function validation($idToValidate)
    {
        $validation = new Comment();
        $validation = $validation->validateComs($idToValidate);
        $_GET['validate'] = null;
        $commentsToCheck = $this->allCommentsToValidate();
        $page_title = "Panneau d'admin";
        $header_img = "background-image: url('../view/assets/img/admin.jpg')";
        $pageToDisplay = "../view/admin/components/comments_validation.php";
        require_once "../view/admin/panneau-admin.php";
        exit();
    }

    function deleteCom($idToDelete)
    {
        $suppression = new Comment();
        $suppression = $suppression->deleteOneCom($idToDelete);
        $_GET['delete'] = null;
        $commentsToCheck = $this->allCommentsToValidate();
        $page_title = "Panneau d'admin";
        $header_img = "background-image: url('../view/assets/img/admin.jpg')";
        $pageToDisplay = "../view/admin/components/comments_validation.php";
        require_once "../view/admin/panneau-admin.php";
        exit();
    }
}
?>