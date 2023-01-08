<?php
namespace App\Control;

require_once 'vendor/autoload.php';

if (session_status() !== PHP_SESSION_ACTIVE)
    session_start();

$root = $_SERVER['WEB_ROOT'] = str_replace($_SERVER['SCRIPT_NAME'],'',$_SERVER['SCRIPT_FILENAME']); 
$host = $_SERVER['HTTP_HOST'];
$protocol=$_SERVER['PROTOCOL'] = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https' : 'http';

$page_title = "Contact";

use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

require "view/view_contact.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $email= new Email();

    if (isset($_POST['email']) && !empty($_POST['email']) 
    && isset($_POST['message']) && !empty($_POST['message']))
    {
        // Create a Transport object

        $emailSender = strip_tags($_POST['email']);
        $message = htmlspecialchars($_POST['message']);
        $transport = Transport::fromDsn('smtp://f7bc876e51d7a6:bfde5980ea1da5@smtp.mailtrap.io:2525?encryption=tls&auth_mode=login');
        
        // Create a Mailer object
        $mailer = new Mailer($transport); 

        // Create an Email object
        $email = (new Email());
        
        // Set the "From address"
        $email->from($emailSender);
        
        // Set the "From address"
        $email->to($emailSender);
        
        // Set a "subject"
        $email->subject('Message démo !!');
        
        // Set the plain-text "Body"
        $email->text($message);
        
        // Send the message
        try {
            $mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            echo "Echec d'envoi du message";
        }
    }
}
else
{
    http_response_code(405);
    echo "Méthode non autorisée";
}


?>