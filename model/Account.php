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

       $this->model('Account');
    }

    public function __call(string $email, array $mdp)
    {
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getName()
    {
        return $this->nom;
    }

    public function getFirstName()
    {
        return $this->prenom;
    }
    
    public function getEmail()
    {
        return $this->email;
    }

    public function getMdp()
    {
        return $this->mdp;
    }

    public function getId()
    {
        return $this->id;
    }

    function getOneUser($id)
    {
        $mysqlClient = new Connect();
        $mysqlClient = $mysqlClient->connexion();
        // On récupère tout le contenu de la table 
        $sqlQuery = 'SELECT * FROM account WHERE id_account = :id_account LIMIT 1';
        $accountStatement = $mysqlClient->prepare($sqlQuery);
        $accountStatement->execute([
            'id_account' => $id
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

    function isInDB($email)
    {
        $mysqlClient = new Connect();
        $mysqlClient = $mysqlClient->connexion();
        // On récupère tout le contenu de la table 
        $sqlQuery = 'SELECT * FROM account WHERE email = :email LIMIT 1';
        $accountStatement = $mysqlClient->prepare($sqlQuery);
        $accountStatement->execute([
            'email' => $email
        ]);
        $account = $accountStatement->fetchAll();

        $userAccount = false;
        if (sizeof($account) > 0)
            $userAccount = true;

        return $userAccount;
    }

    function allUsers()
    {
        $mysqlClient = new Connect();
        $mysqlClient = $mysqlClient->connexion();
        // On récupère tout le contenu de la table 
        $sqlQuery = 'SELECT * FROM account WHERE statut = "Validé"';
        $accountStatement = $mysqlClient->prepare($sqlQuery);
        $accountStatement->execute();
        $allusers = $accountStatement->fetchAll();

        // On affecte
        $usersAccounts = [];

        if (sizeof($allusers) > 0)
        {
            foreach($allusers as $user)
            {
                $userAccount = new Account();
                $userAccount->id = $user['id_account']; 
                $userAccount->type = $user['type']; 
                $userAccount->nom = $user['nom'];
                $userAccount->prenom = $user['prenom'];
                $userAccount->email = $user['email'];
                $userAccount->mdp = $user['mot_de_passe'];
                $userAccount->statut = $user['statut'];
                
                array_push($usersAccounts, $userAccount);
            }
        }
        return $usersAccounts;
    }

    public static function isAuth($email, $password)
    {
        $find = new self();
        $res = $find->findUsers($email, $password);
        $users = false;

        if($res != null)
            $users = $res;  

        return $users;
    }

    public function newMember($nom, $prenom, $email, $mdp)
    {
        $mysqlClient = new Connect();
        $mysqlClient = $mysqlClient->connexion();

        $sqlQuery = 'INSERT INTO account(nom, prenom, email, mot_de_passe) VALUES(:nom, :prenom, :email, :mot_de_passe)';
        $accountStatement = $mysqlClient->prepare($sqlQuery);
        $accountStatement->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'mot_de_passe' => $mdp
        ]);
    }

    public function findNewMembers()
    {
        $mysqlClient = new Connect();
        $mysqlClient = $mysqlClient->connexion();
        // On récupère tout le contenu de la table 
        $sqlQuery = 'SELECT * FROM account WHERE statut="En attente de validation"';
        $accountStatement = $mysqlClient->prepare($sqlQuery);
        $accountStatement->execute();
        $account = $accountStatement->fetchAll();

        // On affecte
        $usersAccounts = [];
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

            array_push($usersAccounts, $userAccount);
        }
        return $usersAccounts;
    }

    public function registrationValidation($id)
    {
        $mysqlClient = new Connect();
        $mysqlClient = $mysqlClient->connexion();

        $sqlQuery = 'UPDATE account set statut = "Validé" WHERE id_account = :id_account';
        $accountStatement = $mysqlClient->prepare($sqlQuery);
        $accountStatement->execute([
            'id_account' => $id
        ]);
    }

    public function deleteRegAccount($id)
    {
        $mysqlClient = new Connect();
        $mysqlClient = $mysqlClient->connexion();

        $sqlQuery = 'DELETE from account WHERE id_account = :id_account';
        $accountStatement = $mysqlClient->prepare($sqlQuery);
        $accountStatement->execute([
            'id_account' => $id
        ]);
    }
}

?>
