<?php 
namespace App\Model;

require_once 'vendor/autoload.php';

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

    public function calledController()
    {
        return $this->controllerRedirect;
    }

    public function getRoute()
    {
        return $this;
    }
}
?>