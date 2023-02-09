Installation via the command line:

1- Clone the folder on your machine into the folder of your choice:
git clone https://github.com/aurorebressano/blogphp.git

2- Recover the "blogphpbdd.sql" file in the bdd folder. Run it in Mysqlworkbench or any other DBMS.

3- Go to the "Connect.php" file in the Model folder.
Modify line 13 with your database connection credentials and the correct port.
$mysqlClient = new PDO('mysql:host=127.0.0.1;dbname=blogphpdb;port=3306;charset=utf8', 'login', 'password');

4- Once the project has been downloaded, go to the folder and run the command:
php -S localhost: enter the chosen port number here, for example 8085

5- Open your browser and type the url -> localhost: the port number you have chosen
For example:
localhost:8085/

6- The index page opens. You can choose to navigate as you see fit on the different pages displayed on this home page.

7- Site visit:

    a. in offline mode, you can:
    -Visit the reception,
    -download my CV,
    -view the list of blogposts,
    -view each blogpost individually
    -Comment on blogposts (comments subject to admin or moderator validation)
    -Visit external social media pages
    -Contact me via the form.
    -Make a registration request on the admin home page.

    In addition to these features, these are added:

    b. in connected mode: moderator
    -Log in to the restricted admin area
    -Validate the comments posted

    c. in connected mode: Administrator
    -Post a new post
    -Edit, or delete a post
    -Validate or reject registration requests
    -View the list of registrants.

    For a better visualization of the roles, see the "roles" file at the root of the folder.

__________________________________________________________________________________________________________

Installation via la ligne de commande :

1- Cloner le dossier sur votre machine dans le dossier de votre choix:
git clone https://github.com/aurorebressano/blogphp.git

2- Récupérer le fichier "blogphpbdd.sql" dans le dossier bdd. L'exécuter dans Mysqlworkbench ou tout autre SGBD.

3- Se rendre sur le fichier "Connect.php" du dossier Model. 
Modifier la ligne 13 avec les identifiants de connexion à votre base de données ainsi qu'avec le bon port.
$mysqlClient = new PDO('mysql:host=127.0.0.1;dbname=blogphpdb;port=3306;charset=utf8', 'login', 'password');

4- Une fois le projet téléchargé, se placer dans le dossier et lancer la commande:
php -S localhost:entrer ici le numéro de port choisi, par exemple 8085

5-Ouvrir votre navigateur et taper l'url -> localhost:le numéro de port que vous avez choisi
Par exemple: 
localhost:8085/

6- La page index s'ouvre. Vous pouvez choisir de naviguer comme bon vous semble sur les différentes pages affichées sur cette page d'accueil.

7- Visite du site:

    a. en mode non connecté, il vous est possible de:
    -Visiter l'accueil, 
    -télécharger mon cv, 
    -visualiser la liste des blogposts, 
    -visualiser chaque blogpost individuellement
    -Commenter les blogposts (commentaires soumis à validation admin ou modérateur)
    -Visiter les pages externes des réseaux sociaux
    -Me contacter via le formulaire.
    -Faire une demande d'inscription sur la page d'accueil admin.

    En plus de ces fonctionnalités, celles-ci s'ajoutent:

    b. en mode connecté : modérateur
    -Se connecter à l'espace admin restreint
    -Valider les commentaires postés

    c. en mode connecté : Administrateur
    -Poster un nouveau post
    -Editer, ou supprimer un post
    -Valider ou rejeter les demandes d'inscription
    -Visualiser la liste des inscrits.

    Pour une meilleure visualisation des rôles, voir le fichier "roles" à la racine du dossier.

    
