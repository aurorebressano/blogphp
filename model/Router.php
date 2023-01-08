<?php
namespace App\Model;

    class Router
    {
        private $urlToCatch;
        private $registeredRoutes = [];

        function mapRoutes(array $routes)
        {
            $this->registeredRoutes = $routes;
        }

        public function getRoutes()
        {       
            return $this->registeredRoutes;
        }

        function redirect($url)
        {
            $verif = false;
            
            if ( $this->getRoutes() != null)
            {    
                $routes = $this->getRoutes();
            
                for($i = 0; $i < sizeof($routes) ; $i++)
                {
                    if ($routes[$i]->getUrl() == $url)
                    {
                        $verif = true;
                        $currentRoute = $routes[$i];
                        $page_title = $currentRoute->pageTitle;
                        require $currentRoute->calledController();
                    }
                }
            }
            if ($verif == false)
            {
                $verif = true;
                $currentRoute = $routes[0];
                $page_title = $currentRoute->pageTitle;
                require $currentRoute->calledController();
            }
        }
    }
?>