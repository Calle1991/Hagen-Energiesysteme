<?php

// Load Composer's autoloader
require_once 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions

header("Access-Control-Allow-Origin: *");
$rest_json = file_get_contents("php://input");
$_POST = json_decode($rest_json, true);

//if(isset($_POST['sendmail'])){
$email = $_POST['mail'];
$tel = $_POST['tel'];
$meter = $_POST['meter'];
$stromverteilerChecked = $_POST['stromverteilerChecked'];
$tiefbauChecked = $_POST['tiefbauChecked'];
$wanddurchbruchChecked = $_POST['wanddurchbruchChecked'];
$ladesaeuleChecked = $_POST['ladesaeuleChecked'];
$installationChecked = $_POST['installationChecked'];
$name = $_POST['name'];
        
echo $_POST['mail'];

try {
    // Create the Transport
    $transport = (new Swift_SmtpTransport('smtps.udag.de', 587, 'tls'))
      ->setUsername('hagen-energiesysteme-de-0001')
      ->setPassword('Email4591!?=!?!!!"fjwmsSDF');
    
    // Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);
    
    // Create a message
    $message = (new Swift_Message('Angebotsanfrage - Ladestation'))
      ->setFrom(['info@hagen-energiesysteme.de' => 'Hagen Energiesysteme'])
      ->setTo(['info@hagen-energiesysteme.de', 'i6jmmaojxx+chuxr+j33ue@in.meistertask.com'  => 'Angebot'])
      ->setBody('  
<html>
<head>
  <title>Angebotsanfrage</title>
</head>
<body>
<table style="border 1px solid black">
    <tr>
        <td>
        Name:
        </td>
        <td>
        '. $name .'
        </td>
    </tr>
    <tr>
        <td>
        Email:
        </td>
        <td>
        '. $email .'
        </td>
    </tr>
    <tr>
        <td>
        Telefon:
        </td>
        <td>
        '. $tel .'
        </td>
    </tr>
    <tr>
        <td>
        Wie groß ist die Entfernung zum Stromverteiler?
        </td>
        <td>
        '. $meter . ' Meter
        </td>
    </tr>
    <tr>
        <td>
        Ist ausreichend Platz für einen Stromverteiler vorhanden?
        </td>
        <td>
        '. $stromverteilerChecked .'
        </td>
    </tr>
    <tr>
        <td>
        Sind Tiefbauarbeiten notwendig?
        </td>
        <td>
        '. $tiefbauChecked .'
        </td>
    </tr>
    <tr>
        <td>
        Sind Wanddurchbrueche erforderlich?:
        </td>
        <td>
        '. $wanddurchbruchChecked  .'
        </td>
    </tr>
    <tr>
        <td>
        Soll die Installation Auf- oder Unterputz erfolgen?:
        </td>
        <td>
        '. $installationChecked .'
        </td>
    </tr>
    <tr>
        <td>
        Wie soll die Ladesaeule montiert werden?:
        </td>
        <td>
        '. $ladesaeuleChecked .'
        </td>
    </tr>
</table>
</body>
</html>', 'text/html');
    // Send the message
    $result = $mailer->send($message);


            //Sende Bestätigung

            try {
                // Create the Transport
                $transport = (new Swift_SmtpTransport('smtps.udag.de', 587, 'tls'))
                  ->setUsername('hagen-energiesysteme-de-0001')
                  ->setPassword('Email4591!?=!?!!!"fjwmsSDF');
                
                // Create the Mailer using your created Transport
                $mailer = new Swift_Mailer($transport);
                
                // Create a message
                $message = (new Swift_Message('Bestätigung Ihrer Anfrage'))
                  ->setFrom(['info@hagen-energiesysteme.de' => 'Hagen Energiesysteme'])
                  ->setTo([$email  => $email])
                  ->setBody('  
            <html>
            <head>
              <title>Bestätigung Ihrer Anfrage</title>
            </head>
            <body>
            <h1>Bestätigung Ihrer Anfrage</h1>
            <p>Ihre Anfrage ist bei der Hagen Energiesysteme eingegangen</p>
            <p>Wir werden Ihre Anfrage bearbeiten und mit Ihnen Kontakt aufnehmen</p>
            </body>
            </html>', 'text/html');
                // Send the message
                $result = $mailer->send($message);
            
            
                        //Sende Bestätigung
            
            
             
            } catch (Exception $e){
                echo $e->getMessage();
            } 


 
} catch (Exception $e){
    echo $e->getMessage();
} 




?>