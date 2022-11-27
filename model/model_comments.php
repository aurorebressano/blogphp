<!-- users_control -->
<?php

class Comment {
    public function __construct(array $arguments = array()) {
        if (!empty($arguments)) {
            foreach ($arguments as $property => $argument) {
                $this->{$property} = $argument;
            }
        }
    }

    public function __call($method, $arguments) {
        $arguments = array_merge(array("stdObject" => $this), $arguments); // Note: method argument 0 will always referred to the main class ($this).
        if (isset($this->{$method}) && is_callable($this->{$method})) {
            return call_user_func_array($this->{$method}, $arguments);
        } else {
            throw new Exception("Fatal error: Call to undefined method Blogpost::{$method}()");
        }
    }
}

// CONNEXION BDD

function findComments($idblogpost)
{
    try
    {
        // On se connecte à MySQL
        $mysqlClient = new PDO('mysql:host=127.0.0.1;dbname=blogphpdb;charset=utf8', 'root', 'root');
    }
    catch(Exception $e)
    {
        // En cas d'erreur, on affiche un message et on arrête tout
            die('Erreur : '.$e->getMessage());
    }

    // On récupère tout le contenu de la table 
    if($idblogpost != null)
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

    if(sizeof($comments) > 0)
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
    return $arrComments;
}

function insertComment($idpost, $pseudo, $email, $message)
{
    try
    {
        // On se connecte à MySQL
        $mysqlClient = new PDO('mysql:host=127.0.0.1;dbname=blogphpdb;charset=utf8', 'root', 'root');
    }
    catch(Exception $e)
    {
        // En cas d'erreur, on affiche un message et on arrête tout
            die('Erreur : '.$e->getMessage());
    }

    $date = date("Y-m-d H:i:s");
    echo $date;
    echo $idpost, $pseudo, $email, $message;
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
    try
    {
        // On se connecte à MySQL
        $mysqlClient = new PDO('mysql:host=127.0.0.1;dbname=blogphpdb;charset=utf8', 'root', 'root');
    }
    catch(Exception $e)
    {
        // En cas d'erreur, on affiche un message et on arrête tout
            die('Erreur : '.$e->getMessage());
    }

    $sqlQuery = 'SELECT * FROM comment WHERE id_comment = :id_comment';
    $commentStatement = $mysqlClient->prepare($sqlQuery);
    $commentStatement->execute([
        'id_comment' => $idCom
    ]);

    $comments = $commentStatement->fetchAll();

    var_dump($comments);

    // On affecte

    $userComment = null;

    if(sizeof($comments) > 0)
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
    try
    {
        // On se connecte à MySQL
        $mysqlClient = new PDO('mysql:host=127.0.0.1;dbname=blogphpdb;charset=utf8', 'root', 'root');
    }
    catch(Exception $e)
    {
        // En cas d'erreur, on affiche un message et on arrête tout
            die('Erreur : '.$e->getMessage());
    }
    $sqlQuery = 'UPDATE `comment` SET statut = "Validé" WHERE id_comment = :id_comment';
    $commentStatement = $mysqlClient->prepare($sqlQuery);
    $commentStatement->execute([
        'id_comment' => $idCom
    ]);
}

function deleteOneCom($idCom)
{
    try
    {
        // On se connecte à MySQL
        $mysqlClient = new PDO('mysql:host=127.0.0.1;dbname=blogphpdb;charset=utf8', 'root', 'root');
    }
    catch(Exception $e)
    {
        // En cas d'erreur, on affiche un message et on arrête tout
            die('Erreur : '.$e->getMessage());
    }
    $sqlQuery = 'DELETE FROM `comment` WHERE id_comment = :id_comment';
    $commentStatement = $mysqlClient->prepare($sqlQuery);
    $commentStatement->execute([
        'id_comment' => $idCom
    ]);
}
?>
