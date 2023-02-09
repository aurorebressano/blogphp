<?php
namespace App\Model;

use App\Model\Connect;

class Comment 
{
    public $id;
    public $pseudo;
    public $blogpost;
    public $date;
    public $message;
    public $statut;

    // CONNEXION BDD

    function findComments($idblogpost)
    {
        $mysqlClient = new Connect();
        $mysqlClient = $mysqlClient->connexion();

        // On récupère tout le contenu de la table 
        if ($idblogpost != null)
        {
            $sqlQuery = 'SELECT * FROM comment WHERE id_blogpost = :idblogpost AND statut="Validé" ORDER BY date DESC';
            $commentStatement = $mysqlClient->prepare($sqlQuery);
            $commentStatement->execute([
                'idblogpost' => $idblogpost
            ]);
        }
        else
        {
            $sqlQuery = 'SELECT * FROM comment WHERE statut="En attente de validation" ORDER BY date';
            $commentStatement = $mysqlClient->prepare($sqlQuery);
            $commentStatement->execute();
        }

        $comments = $commentStatement->fetchAll();

        // On affecte

        $userComment = null;
        $arrComments = array();

        if (sizeof($comments) > 0)
        {
            foreach($comments as $comment)
            {
                $userComment = new Comment();
                $userComment->id = $comment['id_comment']; 
                $userComment->blogpost = $comment['id_blogpost']; 
                $userComment->pseudo = $comment['pseudo'];
                $userComment->date = $comment['date'];
                $userComment->message = $comment['message'];
                $userComment->statut = $comment['statut'];

                array_push($arrComments, $userComment);
            }
        }
        else
        {
            $arrComments = "Aucun commentaire validé pour l'instant";
        }
        return $arrComments;
    }

    function insertComment($idpost, $pseudo, $email, $message)
    {
        $mysqlClient = new Connect();
        $mysqlClient = $mysqlClient->connexion();

        $date = date("Y-m-d H:i:s");
        // On récupère tout le contenu de la table 
        $sqlQuery = 'INSERT INTO comment(id_blogpost, pseudo, email, date, message) VALUES(:id_blogpost, :pseudo, :email, :date, :message)';
        $commentStatement = $mysqlClient->prepare($sqlQuery);
        $commentStatement->execute([
            'id_blogpost' => $idpost,
            'pseudo' => $pseudo,
            'email' => $email,
            'date' => $date,
            'message' => $message
        ]);
    }

    function findOneCom($idCom)
    {
        $mysqlClient = new Connect();
        $mysqlClient = $mysqlClient->connexion();

        $sqlQuery = 'SELECT * FROM comment WHERE id_comment = :id_comment';
        $commentStatement = $mysqlClient->prepare($sqlQuery);
        $commentStatement->execute([
            'id_comment' => $idCom
        ]);

        $comments = $commentStatement->fetchAll();

        var_dump($comments);

        // On affecte

        $userComment = null;

        if (sizeof($comments) > 0)
        {
            $userComment = new Comment();
            $userComment->id = $comment[0]['id_comment']; 
            $userComment->blogpost = $comment[0]['id_blogpost']; 
            $userComment->pseudo = $comment[0]['pseudo'];
            $userComment->date = $comment[0]['date'];
            $userComment->message = $comment[0]['message'];
            $userComment->statut = $comment[0]['statut'];
        }
        return $userComment;
    }


    function validateComs($idCom)
    {
        
        $mysqlClient = new Connect();
        $mysqlClient = $mysqlClient->connexion();
        $sqlQuery = 'UPDATE `comment` SET statut = "Validé" WHERE id_comment = :id_comment';
        $commentStatement = $mysqlClient->prepare($sqlQuery);
        $commentStatement->execute([
            'id_comment' => $idCom
        ]);
    }

    function deleteOneCom($idCom)
    {
        $mysqlClient = new Connect();
        $mysqlClient = $mysqlClient->connexion();
        $sqlQuery = 'DELETE FROM `comment` WHERE id_comment = :id_comment';
        $commentStatement = $mysqlClient->prepare($sqlQuery);
        $commentStatement->execute([
            'id_comment' => $idCom
        ]);
    }
}


?>
