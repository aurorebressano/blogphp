<?php
namespace App\Model;

use \PDO;

class Connect
{
    function connexion()
    {
        try
        {
            // On se connecte à MySQL
            $mysqlClient = new PDO('mysql:host=127.0.0.1;dbname=blogphpdb;port=3306;charset=utf8', 'root', 'root');

            return $mysqlClient;
        }
        catch(Exception $e)
        {
            // En cas d'erreur, on affiche un message et on arrête tout
                echo 'Problème de connexion à la base de données: ' .$e;
        }
    }
}
?>