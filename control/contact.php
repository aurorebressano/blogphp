<?php

if(session_status() !== PHP_SESSION_ACTIVE)
    session_start();

$page_title = "Contact";

require('../view/view_contact.php');

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
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
            echo $data;
        
            if($data->success)
            {
                if(isset($_POST['email']) && !empty($_POST['email']) 
                && isset($_POST['message']) && !empty($_POST['message']))
                {
                    $email = strip_tags($_POST['email']);
                    $message = htmlspecialchars($_POST['message']);
                    $additional_headers = array(
                        'From' => $email,
                        'Reply-To' => $email,
                        'X-Mailer' => 'PHP/' . phpversion(),
                        'Content-Type' => 'text/html; charset="UTF-8'
                    );

                    echo "Coucou !  Voilà ton mail: " . $email . " et voilà ton message : ". $message ;

                    mail(
                        'aurorebressano@gmail.com',
                        'Mail provenant du blog !',
                        $message,
                        $additional_headers
                    );
                }
            }
        }
    }
}
else
{
    http_response_code(405);
    echo "Méthode non autorisée";
}


?>