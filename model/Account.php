<?php
namespace App\Model;

use App\Model\Connect;

class Account 
{
    private $id;
    private $type;
    private $nom;
    private $prenom;
    private $email;
    private $mdp;
    private $statut;

    public function __construct(int $id = null, string $type = null, string $nom = null, string $prenom = null, string $email = null, string $mdp = null, string $statut = null) {
       $this->id = $id;
       $this->type = $type;
       $this->nom = $nom;
       $this->prenom = $prenom;
       $this->email = $email;
       $this->mdp = $mdp;
       $this->statut = $statut;
    }

    public function __call(string $email, array $mdp)
    {
        return $this;
    }

    // CONNEXION BDD

    function findUsers($email, $password)
    {
        $mysqlClient = new Connect();
        $mysqlClient = $mysqlClient->connexion();
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

        if (sizeof($account) > 0)
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

    public static function isAuth($email, $password)
    {
        $find = new self();
        $find->findUsers($email, $password);

        if ($find == null)
            $users = false;
        else
            $users = $find;

        return $users;
    }
}

?>
