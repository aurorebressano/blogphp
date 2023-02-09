<?php
namespace App\Model;

use App\Model\Connect;
use App\Model\Account;

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

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function displayTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function displayChapo()
    {
        return $this->chapo;
    }

    public function displayAuthor()
    {
        return $this->author;
    }

    public function displayDate()
    {
        return $this->date;
    }
    
    public function displayContent()
    {
        return $this->content;
    }

    public function displayImgHeader()
    {
        return $this->imgheader;
    }

    public function displayImgSecondary()
    {
        return $this->imgsecondary;
    }

    public function findAuthor($id)
    {
        $author = new Account();
        $author = $author->getOneUser($id);
        return $author;
    }

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
            $post->setId($blogpost['id_blogpost']); 
            $post->setTitle($blogpost['titre']); 
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

    function getTheOne($idpost = null)
    {
        $res = "Aucun post correspondant trouvé";
        $posts = $this->displayBlogpost();

        foreach($posts as $post)
        {
            if($idpost != null && $post->getId() == $idpost)
                $res = $post;

            // Le dernier sera récupéré 
            if($idpost == null)
            {
                $res = $post;
                break;
            }
                
        }
        
        return $res;
    }



    public function newBlogpost($title, $author, $chapo, $content, $imgheader, $imgsecondary)
    {
        $mysqlClient = new Connect();
        $mysqlClient = $mysqlClient->connexion();

        $date = date("Y-m-d H:i:s");
        // On récupère tout le contenu de la table 
        $sqlQuery = 'INSERT INTO blogpost(titre, date, auteur, chapo, contenu, imgheader, imgsecondary) VALUES(:titre, :date, :auteur, :chapo, :contenu, :imgheader, :imgsecondary)';
        $blogpostStatement = $mysqlClient->prepare($sqlQuery);
        $blogpostStatement->execute([
            'titre' => $title,
            'date' => $date,
            'auteur' => $author,
            'chapo' => $chapo,
            'contenu' => $content,
            'imgheader' => $imgheader,
            'imgsecondary' => $imgsecondary
        ]);
    }

    public function editBlogpost($id, $title, $chapo, $content, $imgheader, $imgsecondary)
    {
        $mysqlClient = new Connect();
        $mysqlClient = $mysqlClient->connexion();
        $sqlQuery = 'UPDATE `blogpost` SET titre = :titre, chapo = :chapo, contenu = :contenu, imgheader = :imgheader, imgsecondary = :imgsecondary  WHERE id_blogpost = :id_blogpost';
        $blgpStatement = $mysqlClient->prepare($sqlQuery);
        $blgpStatement->execute([
            'id_blogpost' => $id,
            'titre' =>$title,
            'chapo' => $chapo,
            'contenu' => $content,
            'imgheader' => $imgheader,
            'imgsecondary' => $imgsecondary
        ]);
    }

    public function deleteBlogpost($id)
    {
        $mysqlClient = new Connect();
        $mysqlClient = $mysqlClient->connexion();
        $sqlQuery = 'DELETE FROM `blogpost` WHERE id_blogpost = :id_blogpost';
        $blgpStatement = $mysqlClient->prepare($sqlQuery);
        $blgpStatement->execute([
            'id_blogpost' => $id
        ]);
    }
}

?>
