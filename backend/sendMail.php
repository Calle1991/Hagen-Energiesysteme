<?php

// Load Composer's autoloader
require_once 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions

header("Access-Control-Allow-Origin: *");
//$rest_json = file_get_contents("php://input");
//$_POST = json_decode($rest_json, true);

//if(isset($_POST['sendmail'])){


//Von welcher Instanz
$pemobil = false;
if(isset($_POST['instanz'])){
    if($_POST['instanz'] == 'pemobil'){
        $pemobil = true;
    }else{
        $pemobil = false;
    }
}


//Instanz
$instanz = $_POST['instanz'];

//Produkt
$Produkt = $_POST['product'];
$farbe = $_POST['farbe'];
$laenge = $_POST['laenge'];

//KFW & Grünstrom
$kfw = $_POST['kfw'];
$gruen = $_POST['gruen'];

//Kontaktdaten
$name = $_POST['name'];
$email = $_POST['email'];
$tel = $_POST['telefon'];
$strasse = $_POST['strasse'];
$ort = $_POST['ort'];

//Informationen
$meter = $_POST['meter'];
$stromverteilerChecked = $_POST['frage2'];
$tiefbauChecked = $_POST['frage3'];
$wanddurchbruchChecked = $_POST['frage4'];
$ladesaeuleChecked = $_POST['frage5'];
$installationChecked = $_POST['frage6'];


if(isset($_POST['token'])){
    $request = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfdOkEaAAAAAExnMrlKF9Bz51Jaw38BYjAaM17s&response=".$_POST['token']);
    $request = json_decode($request);
      if($request->success == true){
         if($request->score >= 0.6){
            try {
                // Create the Transport
                $transport = (new Swift_SmtpTransport('smtps.udag.de', 587, 'tls'))
                  ->setUsername('hagen-energiesysteme-de-0001')
                  ->setPassword('!=1QLN5+4AG)MnA6');
                
                // Create the Mailer using your created Transport
                $mailer = new Swift_Mailer($transport);
                
                // Create a message
                $message = (new Swift_Message('Angebotsanfrage - Ladestation'))
                  ->setFrom(['info@hagen-energiesysteme.de' => 'Hagen Energiesysteme'])
                  ->setTo(['info@hagen-energiesysteme.de', 'i6jmmaojxx+chuxr+j33ue@in.meistertask.com' => 'Angebot'])
                  //->setTo(['p.tobinski@hagengmbh.de' => 'Angebot'])
                  ->setBody('  
            <html>
            <head>
              <title>Angebotsanfrage</title>
            </head>
            <body>
            <h1>Angebotsanfrage - Ladestation</h1>
            <p>Gesendet von: ' . $instanz . '</p>
            <h2>Produktdaten</h2>
            <table style="border 1px solid black">
                <tr>
                    <td>
                    Welche Produkt wurde gewählt:
                    </td>
                    <td>
                    '. $Produkt .'
                    </td>
                </tr>
            
                <tr>
                    <td>
                    Welche Farbe wurde gewählt:
                    </td>
                    <td>
                    '. $farbe .'
                    </td>
                </tr>

                <tr>
                    <td>
                    Welche Länge wurde gewählt:
                    </td>
                    <td>
                    '. $laenge .'
                    </td>
                </tr>
            </table>

            <h2>Förderung und Grünstrom</h2>
            <table style="border 1px solid black">
                <tr>
                    <td>
                    Ist ein KFW-Förderantrag vorhanden:
                    </td>
                    <td>
                    '. $kfw .'
                    </td>
                </tr>
            
                <tr>
                    <td>
                    Ist ein Grünstromvertrag vorhanden:
                    </td>
                    <td>
                    '. $gruen .'
                    </td>
                </tr>

            </table>
            
            <h2>Kontaktdaten</h2>
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
                    Straße:
                    </td>
                    <td>
                    '. $strasse .'
                    </td>
                </tr>
                <tr>
                    <td>
                    Ort:
                    </td>
                    <td>
                    '. $ort .'
                    </td>
                </tr>
            </table>
            
            
            <h2>Information</h2>
            <table style="border 1px solid black">
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
                    '. $ladesaeuleChecked .'
                    </td>
                </tr>
                <tr>
                    <td>
                    Wie soll die Ladesaeule montiert werden?:
                    </td>
                    <td>
                    '. $installationChecked .'
                    </td>
                </tr>
            </table>
            </body>
            </html>', 'text/html');
                // Send the message


                //Hinzufügen der PE-mobil E-Mail Adresse
                if($pemobil == true){
                    $message->addTo('e-ladebox@stadtwerke-peine.de');
                    //$message->addTo('pascal.tobinski@gmx.de');
                }else{
                    //nothing
                }



                $result = $mailer->send($message);
            
            
                        //Sende Bestätigung
            
                        try {
                            // Create the Transport
                            $transport = (new Swift_SmtpTransport('smtps.udag.de', 587, 'tls'))
                              ->setUsername('hagen-energiesysteme-de-0001')
                              ->setPassword('!=1QLN5+4AG)MnA6');
                            
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
            
         }
    }
}

?>