<?php
namespace App\Model;
require_once 'vendor/autoload.php';

use App\Model\Connect;

class Blogpost 
{
    private $id;
    private $title;
    private $author;
    private $date;
    private $chapo;
    private $content;
    private $imgheader;
    private $imgsecondary;

    /*public function __construct($id, $title, $author, $date, $chapo, $content, $imgheader, $imgsecondary)
    {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->date = $date;
        $this->chapo= $chapo;
        $this->content = $content;
        $this->imgheader = $imgheader;
        $this->imgsecondary = $imgsecondary;
    }*/
    // CONNEXION BDD

    function displayBlogpost()
    {
        $mysqlClient = new Connect();
        $mysqlClient = $mysqlClient->connexion();

        // On récupère tout le contenu de la table Infos_paiement
        $sqlQuery = 'SELECT * FROM blogpost ORDER BY date DESC';
        $blogpostsStatement = $mysqlClient->prepare($sqlQuery);
        $blogpostsStatement->execute();
        $blogposts = $blogpostsStatement->fetchAll();
        $arrBlogposts = array ();

        // On affecte
        foreach ($blogposts as $blogpost) 
        {
            $post = new Blogpost();
            $post->id = $blogpost['id_blogpost']; 
            $post->title = $blogpost['titre']; 
            $post->date = $blogpost['date'];
            $post->author = $blogpost['auteur'];
            $post->chapo = $blogpost['chapo'];
            $post->content = $blogpost['contenu'];
            $post->imgheader = $blogpost['imgheader'];
            $post->imgsecondary = $blogpost['imgsecondary'];

            array_push($arrBlogposts, $post);
        }

        return $arrBlogposts;
    }

    function getTheOne($idpost)
    {
        $res = "Aucun post correspondant trouvé";
        $posts = $this->displayBlogpost();
        foreach($posts as $post)
        {
            if ($post->id == $idpost)
                $res = $post;
        }

        return $res;
    }
}

?>
