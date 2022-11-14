<?php
if(session_status() !== PHP_SESSION_ACTIVE)
    session_start();

class Route 
{
    private $path;
    private $callable;
    private $matches = [];
    private $params = [];

    public function __construct($path, $callable)
    {
        $this->path = trim($path, '/');  // On retire les / inutils
        $this->callable = $callable;
    }

    /**
    * Permettra de capturer l'url avec les paramètre 
    * get('/posts/:slug-:id') par exemple
    **/
    public function match($url)
    {
        $url = trim($url, '/');
        $path = preg_replace_callback('#:([\w]+)#', [$this, 'paramMatch'], $this->path);
        $regex = "#^$path$#i";
        if(!preg_match($regex, $url, $matches))
        {
            return false;
        }
        array_shift($matches);
        $this->matches = $matches;
        return true;
    }
    
    private function paramMatch($match)
    {
        if(isset($this->params[$match[1]]))
        {
            return '(' . $this->params[$match[1]] . ')';
        }
        return '([^/]+)';
    }

    public function call()
    {
        if(is_string($this->callable))
        {
            $params = explode('#', $this->callable);
            $controller = "App\\Controller\\" . $params[0] . "Controller";
            $controller = new $controller();
            return call_user_func_array([$controller, $params[1]], $this->matches);
        } else 
        {
            return call_user_func_array($this->callable, $this->matches);
        }
    }

    public function with($param, $regex)
    {
        $this->params[$param] = str_replace('(', '(?:', $regex);
        return $this; // On retourne tjrs l'objet pour enchainer les arguments
    }

    public function getUrl($params)
    {
        $path = $this->path;
        foreach($params as $k => $v)
        {
            $path = str_replace(":$k", $v, $path);
        }
        return $path;
    }
}
    
class Router 
{
    public $url;
    private $routes = [];
    private $namedRoutes = [];

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function get($path, $callable, $name = null)
    {
        return $this->add($path, $callable, $name, 'GET');
    }

    public function post($path, $callable, $name = null)
    {
        return $this->add($path, $callable, $name, 'POST');
    }

    private function add($path, $callable, $name, $method)
    {
        $route = new Route($path, $callable);
        $this->routes[$method][] = $route;
        if(is_string($callable) && $name === null)
        {
            $name = $callable;
        }
        if($name)
        {
            $this->namedRoutes[$name] = $route;
        }
        return $route;
    }

    public function run()
    {
        if(!isset($this->routes[$_SERVER['REQUEST_METHOD']]))
        {
            throw new Exception('REQUEST_METHOD does not exist');
        }
        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route)
        {
            if($route->match($this->url))
            {
                return $route->call();
            }
        }
        if(sizeof($this->routes[$_SERVER['REQUEST_METHOD']]) <= 0)
            throw new Exception('No matching routes');
    }

    public function url($name, $params = [])
    {
        if(!isset($this->namedRoutes[$name]))
        {
            throw new Exception('No route matches this name');
        }
        return $this->namedRoutes[$name]->getUrl($params);
    }
    
}


$router = new Router($_SERVER['REQUEST_URI']); 

if($_SERVER['REQUEST_URI'] == "/blogphp/control/index.php")
{
    $page_title = "Bienvenue !";
    $router->get('/blogphp/control/index.php', function($id){   
        $path = '/index';
    }, null);
    var_dump($router);
}

if($_SERVER['REQUEST_URI'] == "/blogphp/control/blogposts.php")
{
    $router->get('/blogposts', function($id){ 
        $router->add($path = 'blogposts.php') ;
    }); 
    var_dump($router);
}

if($_SERVER['REQUEST_URI'] == "/blogphp/control/contact.php")
{
    $router->get('/contact', function($id){ 
        $router->add($path = 'contact.php') ;
    }); 
    var_dump($router);
}


require($router->run());
//echo $pageToDisplay;
//require($router->getUrl());


?>