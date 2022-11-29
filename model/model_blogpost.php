<!-- blogpost_control -->
<?php

require_once("Connect.php");

class Blogpost 
{
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
            if($post->id == $idpost)
                $res = $post;
        }

        return $res;
    }
}

?>
