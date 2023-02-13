<?php 
namespace App\Routes;

class Route 
{
    private $url;
    public $pageTitle;
    private $controllerRedirect;

    function __construct($url, $pageTitle, $controllerRedirect)
    {
        $this->url = $url;
        $this->pageTitle = $pageTitle;
        $this->controllerRedirect = $controllerRedirect;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getPageTitle()
    {
        return $this->pageTitle;
    }

    public function setControllerRedirect($controllerRedirect)
    {
        $this->controllerRedirect = $controllerRedirect;
    }

    public function calledController()
    {
        $root = $_SERVER['WEB_ROOT'] = str_replace($_SERVER['SCRIPT_NAME'],'',$_SERVER['SCRIPT_FILENAME']); 
        $host = $_SERVER['HTTP_HOST'];
        $protocol=$_SERVER['PROTOCOL'] = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https' : 'http';

        $this->controllerRedirect = $_SERVER['DOCUMENT_ROOT'] . $this->controllerRedirect;
        
        //$this->controllerRedirect = "$protocol://$host" . $this->controllerRedirect;
        return $this->controllerRedirect;
    }

    public function getRoute()
    {
        return $this;
    }
}
?>