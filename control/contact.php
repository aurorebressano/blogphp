<?php
namespace App\Control;

require_once 'vendor/autoload.php';

if (session_status() !== PHP_SESSION_ACTIVE)
    session_start();

$root = $_SERVER['WEB_ROOT'] = str_replace($_SERVER['SCRIPT_NAME'],'',$_SERVER['SCRIPT_FILENAME']); 
$host = $_SERVER['HTTP_HOST'];
$protocol=$_SERVER['PROTOCOL'] = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https' : 'http';

$redirectfromcontact = false;
$page_title = "Contact";

use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $email= new Email();

    if(!isset($_POST['recaptcha-response']))
    {
        // header('Location: index.php');
        echo "empty(['recaptcha-response']) !";
    }
    if(isset($_POST['recaptcha-response']))
    {
        //On prépare l'URL
        $url = "https://www.google.com/recaptcha/api/siteverify?secret=6LfwWUgeAAAAABqDzSOXR6voI7V4nVRndb4Tul7a&response=". $_POST['recaptcha-response'];

        // On vérifie si curl est installé
        if(function_exists('curl_version'))
        {
            echo "curl version exists";
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_TIMEOUT, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($curl);
            echo "on sort des curl";
        }
        else
        {
            // On utilisera file_get_contents
            $response = file_get_contents($url);
            echo "curl n'est pas en place";
        }

        // On vérifie qu'on a une réponse
        if(empty($response) || is_null($response))
        {
            header('Location: index.php');
        }
        else
        {
            $data = json_decode($response);
        
            if($data->success)
            {
                if (isset($_POST['email']) && !empty($_POST['email']) 
                && isset($_POST['message']) && !empty($_POST['message']))
                {
                    // Create a Transport object

                    $emailSender = strip_tags(htmlspecialchars($_POST['email']));
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

                        $message = "Message bien envoyé ! ";

                    } catch (TransportExceptionInterface $e) {
                        echo "Echec d'envoi du message";
                    }
                }
            }
        }
    }
}
else
{
    http_response_code(405);
    //echo "Méthode non autorisée";
}

require "view/view_contact.php";

?>