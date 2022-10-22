<!-- users_control -->
<?php

class Account {
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

function findUsers($email, $password)
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
    $sqlQuery = 'SELECT * FROM account WHERE email = :email AND mot_de_passe= :motdepasse AND statut="Validé" LIMIT 1';
    $accountStatement = $mysqlClient->prepare($sqlQuery);
    $accountStatement->execute([
        'email' => $email,
        'motdepasse' => $password
    ]);
    $account = $accountStatement->fetchAll();

    // On affecte

    $userAccount = null;

    if(sizeof($account) > 0)
    {
        $userAccount = new Account();
        $userAccount->id = $account[0]['id_account']; 
        $userAccount->type = $account[0]['type']; 
        $userAccount->nom = $account[0]['nom'];
        $userAccount->prenom = $account[0]['prenom'];
        $userAccount->email = $account[0]['email'];
        $userAccount->mdp = $account[0]['mot_de_passe'];
        $userAccount->statut = $account[0]['statut'];
    }
    return $userAccount;
}

function isAuth($email, $password)
{
    $find = findUsers($email, $password);
    if($find == null)
        $users = false;
    else
        $users = $find;

    return $users;
}

?>
