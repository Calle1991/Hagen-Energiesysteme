<?php

// Load Composer's autoloader
require_once 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions

header("Access-Control-Allow-Origin: *");
//$rest_json = file_get_contents("php://input");
//$_POST = json_decode($rest_json, true);


//Logging Setting
$DateAndTime = date('m-d-Y', time());  
$file = 'logs/log_'.$DateAndTime.'.txt';



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
$alterStromverteiler = $_POST['alterStromverteiler'];
$meter = $_POST['meter'];
$stromverteilerChecked = $_POST['frage2'];
$tiefbauChecked = $_POST['frage3'];
$wanddurchbruchChecked = $_POST['frage4'];
$ladesaeuleChecked = $_POST['frage5'];
$installationChecked = $_POST['frage6'];

//Upload#
$file = false;
if(isset($_POST['file'])){
    $filelocation = $_POST['file'];
    $file = true;
}else{
    $file = false;
}



if(isset($_POST['token'])){
    $request = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfdOkEaAAAAAExnMrlKF9Bz51Jaw38BYjAaM17s&response=".$_POST['token']);
    $request = json_decode($request);
      if($request->success == true){
         if($request->score >= 0.6){
            try {
                file_put_contents($file,'Fragegebogen eingegangen am:' . $DateAndTime . "\n", FILE_APPEND | LOCK_EX);
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
                    Liegt das alter des Stromverteilers vor 2018?
                    </td>
                    <td>
                    '. $alterStromverteiler . '
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
                


                //Hinzufügen der Datei als Anhang
                if($file == true){
                    $message->attach(Swift_Attachment::fromPath($filelocation) ->setFilename('Stromverteiler.png'));
                }

                //Hinzufügen der PE-mobil E-Mail Adresse
                if($pemobil == true){
                    $message->addTo('e-ladebox@stadtwerke-peine.de');
                    //$message->addTo('pascal.tobinski@gmx.de');
                }else{
                    //nothing
                }

                // Send the message
                $result = $mailer->send($message);

                // Delete File
                if($file == true){
                    unlink($filelocation);
                }

            
            
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
                              <style>
                                  #contentWrapper {
                                      padding: 20px;
                              
                              
                                  }
                              
                                  #rechtliches {
                                      width: 500px;
                                      font-size: 8pt;
                                      margin-top: 50px;
                                      line-height: 1;
                                  }
                              
                                  h1 {
                                      color: #333333;
                                      font-family: "Myriad Pro", sans-serif;
                                  }
                              
                                  p {
                                      color: #333333;
                                      font-family: "Myriad Pro", sans-serif;
                                      line-height: 1.5;
                                  }
                              
                                  td {
                                      color: #333333;
                                      font-family: "Myriad Pro", sans-serif;
                                      line-height: 1.5;
                                  }
                              
                                  a {
                                      color: #333333;
                                  }
                              </style>
                              
                              <html lang="de">
                              <meta charset="utf-8">
                              <div id="contentWrapper">
                              
                                  <table>
                                      <tr>
                                          <td>
                              
                                              <div id="hes-logo">
                                                  <a href="hagen-energiesysteme.de">
                                                  <img style="width: 50%;" src="data:image/png;base64, 
                                                  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
                                                  =" />
                                                  </a>
                                          </td>
                                      <tr>
                                          <td>
                                              <h1>Vielen Dank für Ihre Anfrage!</h1>
                              
                                          </td>
                                      </tr>
                                  </table>
                                  <p>Wir haben Ihre Anfrage erhalten und werden Ihnen schon bald Ihr Angebot zusenden.</p>
                              
                                  <p> <br>Bei Rückfragen stehen wir Ihnen gerne zur Verfügung! <br> Rufen Sie uns einfach an
                                      oder melden sich per E-Mail bei uns.</p>
                                  <table id="kontakt">
                                      <tbody>
                                          <tr>
                                              <td>E-Mail:</td>
                                              <td><a href="mailto:info@hagen-energiesysteme.de">
                                                      info@hagen-energiesysteme.de</a></td>
                                          </tr>
                              
                                          <tr>
                                              <td>Telefon:</td>
                                              <td><a href="tel:+4951715833966">
                                                      +49 (0) 5171 5833966 </a></td>
                                          </tr>
                                      </tbody>
                                  </table>
                              
                              
                              
                              
                              
                                  <div id="rechtliches">
                                      <a href="hagen-energiesysteme.de/pages/sonnenenergie/">
                                          <img style="width: 100%;" src="data:image/png;base64, 
                                          /9j/4AAQSkZJRgABAgAAZABkAAD/7AARRHVja3kAAQAEAAAAZAAA/+IMWElDQ19QUk9GSUxFAAEBAAAMSExpbm8CEAAAbW50clJHQiBYWVogB84AAgAJAAYAMQAAYWNzcE1TRlQAAAAASUVDIHNSR0IAAAAAAAAAAAAAAAAAAPbWAAEAAAAA0y1IUCAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAARY3BydAAAAVAAAAAzZGVzYwAAAYQAAABsd3RwdAAAAfAAAAAUYmtwdAAAAgQAAAAUclhZWgAAAhgAAAAUZ1hZWgAAAiwAAAAUYlhZWgAAAkAAAAAUZG1uZAAAAlQAAABwZG1kZAAAAsQAAACIdnVlZAAAA0wAAACGdmlldwAAA9QAAAAkbHVtaQAAA/gAAAAUbWVhcwAABAwAAAAkdGVjaAAABDAAAAAMclRSQwAABDwAAAgMZ1RSQwAABDwAAAgMYlRSQwAABDwAAAgMdGV4dAAAAABDb3B5cmlnaHQgKGMpIDE5OTggSGV3bGV0dC1QYWNrYXJkIENvbXBhbnkAAGRlc2MAAAAAAAAAEnNSR0IgSUVDNjE5NjYtMi4xAAAAAAAAAAAAAAASc1JHQiBJRUM2MTk2Ni0yLjEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAFhZWiAAAAAAAADzUQABAAAAARbMWFlaIAAAAAAAAAAAAAAAAAAAAABYWVogAAAAAAAAb6IAADj1AAADkFhZWiAAAAAAAABimQAAt4UAABjaWFlaIAAAAAAAACSgAAAPhAAAts9kZXNjAAAAAAAAABZJRUMgaHR0cDovL3d3dy5pZWMuY2gAAAAAAAAAAAAAABZJRUMgaHR0cDovL3d3dy5pZWMuY2gAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAZGVzYwAAAAAAAAAuSUVDIDYxOTY2LTIuMSBEZWZhdWx0IFJHQiBjb2xvdXIgc3BhY2UgLSBzUkdCAAAAAAAAAAAAAAAuSUVDIDYxOTY2LTIuMSBEZWZhdWx0IFJHQiBjb2xvdXIgc3BhY2UgLSBzUkdCAAAAAAAAAAAAAAAAAAAAAAAAAAAAAGRlc2MAAAAAAAAALFJlZmVyZW5jZSBWaWV3aW5nIENvbmRpdGlvbiBpbiBJRUM2MTk2Ni0yLjEAAAAAAAAAAAAAACxSZWZlcmVuY2UgVmlld2luZyBDb25kaXRpb24gaW4gSUVDNjE5NjYtMi4xAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAB2aWV3AAAAAAATpP4AFF8uABDPFAAD7cwABBMLAANcngAAAAFYWVogAAAAAABMCVYAUAAAAFcf521lYXMAAAAAAAAAAQAAAAAAAAAAAAAAAAAAAAAAAAKPAAAAAnNpZyAAAAAAQ1JUIGN1cnYAAAAAAAAEAAAAAAUACgAPABQAGQAeACMAKAAtADIANwA7AEAARQBKAE8AVABZAF4AYwBoAG0AcgB3AHwAgQCGAIsAkACVAJoAnwCkAKkArgCyALcAvADBAMYAywDQANUA2wDgAOUA6wDwAPYA+wEBAQcBDQETARkBHwElASsBMgE4AT4BRQFMAVIBWQFgAWcBbgF1AXwBgwGLAZIBmgGhAakBsQG5AcEByQHRAdkB4QHpAfIB+gIDAgwCFAIdAiYCLwI4AkECSwJUAl0CZwJxAnoChAKOApgCogKsArYCwQLLAtUC4ALrAvUDAAMLAxYDIQMtAzgDQwNPA1oDZgNyA34DigOWA6IDrgO6A8cD0wPgA+wD+QQGBBMEIAQtBDsESARVBGMEcQR+BIwEmgSoBLYExATTBOEE8AT+BQ0FHAUrBToFSQVYBWcFdwWGBZYFpgW1BcUF1QXlBfYGBgYWBicGNwZIBlkGagZ7BowGnQavBsAG0QbjBvUHBwcZBysHPQdPB2EHdAeGB5kHrAe/B9IH5Qf4CAsIHwgyCEYIWghuCIIIlgiqCL4I0gjnCPsJEAklCToJTwlkCXkJjwmkCboJzwnlCfsKEQonCj0KVApqCoEKmAquCsUK3ArzCwsLIgs5C1ELaQuAC5gLsAvIC+EL+QwSDCoMQwxcDHUMjgynDMAM2QzzDQ0NJg1ADVoNdA2ODakNww3eDfgOEw4uDkkOZA5/DpsOtg7SDu4PCQ8lD0EPXg96D5YPsw/PD+wQCRAmEEMQYRB+EJsQuRDXEPURExExEU8RbRGMEaoRyRHoEgcSJhJFEmQShBKjEsMS4xMDEyMTQxNjE4MTpBPFE+UUBhQnFEkUahSLFK0UzhTwFRIVNBVWFXgVmxW9FeAWAxYmFkkWbBaPFrIW1hb6Fx0XQRdlF4kXrhfSF/cYGxhAGGUYihivGNUY+hkgGUUZaxmRGbcZ3RoEGioaURp3Gp4axRrsGxQbOxtjG4obshvaHAIcKhxSHHscoxzMHPUdHh1HHXAdmR3DHeweFh5AHmoelB6+HukfEx8+H2kflB+/H+ogFSBBIGwgmCDEIPAhHCFIIXUhoSHOIfsiJyJVIoIiryLdIwojOCNmI5QjwiPwJB8kTSR8JKsk2iUJJTglaCWXJccl9yYnJlcmhya3JugnGCdJJ3onqyfcKA0oPyhxKKIo1CkGKTgpaymdKdAqAio1KmgqmyrPKwIrNitpK50r0SwFLDksbiyiLNctDC1BLXYtqy3hLhYuTC6CLrcu7i8kL1ovkS/HL/4wNTBsMKQw2zESMUoxgjG6MfIyKjJjMpsy1DMNM0YzfzO4M/E0KzRlNJ402DUTNU01hzXCNf02NzZyNq426TckN2A3nDfXOBQ4UDiMOMg5BTlCOX85vDn5OjY6dDqyOu87LTtrO6o76DwnPGU8pDzjPSI9YT2hPeA+ID5gPqA+4D8hP2E/oj/iQCNAZECmQOdBKUFqQaxB7kIwQnJCtUL3QzpDfUPARANER0SKRM5FEkVVRZpF3kYiRmdGq0bwRzVHe0fASAVIS0iRSNdJHUljSalJ8Eo3Sn1KxEsMS1NLmkviTCpMcky6TQJNSk2TTdxOJU5uTrdPAE9JT5NP3VAnUHFQu1EGUVBRm1HmUjFSfFLHUxNTX1OqU/ZUQlSPVNtVKFV1VcJWD1ZcVqlW91dEV5JX4FgvWH1Yy1kaWWlZuFoHWlZaplr1W0VblVvlXDVchlzWXSddeF3JXhpebF69Xw9fYV+zYAVgV2CqYPxhT2GiYfViSWKcYvBjQ2OXY+tkQGSUZOllPWWSZedmPWaSZuhnPWeTZ+loP2iWaOxpQ2maafFqSGqfavdrT2una/9sV2yvbQhtYG25bhJua27Ebx5veG/RcCtwhnDgcTpxlXHwcktypnMBc11zuHQUdHB0zHUodYV14XY+dpt2+HdWd7N4EXhueMx5KnmJeed6RnqlewR7Y3vCfCF8gXzhfUF9oX4BfmJ+wn8jf4R/5YBHgKiBCoFrgc2CMIKSgvSDV4O6hB2EgITjhUeFq4YOhnKG14c7h5+IBIhpiM6JM4mZif6KZIrKizCLlov8jGOMyo0xjZiN/45mjs6PNo+ekAaQbpDWkT+RqJIRknqS45NNk7aUIJSKlPSVX5XJljSWn5cKl3WX4JhMmLiZJJmQmfyaaJrVm0Kbr5wcnImc951kndKeQJ6unx2fi5/6oGmg2KFHobaiJqKWowajdqPmpFakx6U4pammGqaLpv2nbqfgqFKoxKk3qamqHKqPqwKrdavprFys0K1ErbiuLa6hrxavi7AAsHWw6rFgsdayS7LCszizrrQltJy1E7WKtgG2ebbwt2i34LhZuNG5SrnCuju6tbsuu6e8IbybvRW9j74KvoS+/796v/XAcMDswWfB48JfwtvDWMPUxFHEzsVLxcjGRsbDx0HHv8g9yLzJOsm5yjjKt8s2y7bMNcy1zTXNtc42zrbPN8+40DnQutE80b7SP9LB00TTxtRJ1MvVTtXR1lXW2Ndc1+DYZNjo2WzZ8dp22vvbgNwF3IrdEN2W3hzeot8p36/gNuC94UThzOJT4tvjY+Pr5HPk/OWE5g3mlucf56noMui86Ubp0Opb6uXrcOv77IbtEe2c7ijutO9A78zwWPDl8XLx//KM8xnzp/Q09ML1UPXe9m32+/eK+Bn4qPk4+cf6V/rn+3f8B/yY/Sn9uv5L/tz/bf///+4AJkFkb2JlAGTAAAAAAQMAFQQDBgoNAAAixwAAVJcAAG8yAACPVf/bAIQAAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQICAgICAgICAgICAwMDAwMDAwMDAwEBAQEBAQECAQECAgIBAgIDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMD/8IAEQgAlgH0AwERAAIRAQMRAf/EARsAAQACAgMBAQAAAAAAAAAAAAADBAUGAgcIAQkBAQACAgMBAQAAAAAAAAAAAAADBAIFAQYHCAkQAAEEAgAFAgUEAwEBAAAAAAMAAQIEBQYgEhMUFRBQMEARMQchMiMWIiQ1NCURAAICAQIDBAUIBQoEBwEBAAIDAQQFERIAIRMxIhQGQVEjFTUgcTJCk9OU1WGBkVIzMEBQsWJykkNTJBBzwzShgrKjhMQWgyUSAAIAAwQFBwgHBQcFAAAAAAECABEDITESBEFRYXETUIGRocEiMjBA8LHRUiMU4UJiwjMkBfFygpI0IGCiQ4PDFdLiU2NUEwEAAgIBAQYHAQEBAAAAAAABABEhMUFRECBhcYGRMFDwobHB0UDh8f/aAAwDAQACEQMRAAAB/Un5O9uAAAHGPKGCSvDnBBLBXkhglrwSV4JIa8sEEteCSvBJBXlqU58brrYAHZnrfR/W32b4CAAAAAAAAAAAAAAAAB5y+TvbgAAA4RQyQV5K8EkEEsFeSCCWvBJBBLBXkrwS14JIK8sFeXEam7845AGe32t/Qr9CvlsAAAAAAAAAAAAAAAADyZ8ne3AAAAcIsoYJa8GdeCWGvLXry14M4IJYK8teCWvBJBXkgrzYrV3IoswAP0S/RL5Wy22pAAAAAAAAAAAAAAAADyZ8ne3AAAAfMeYa8leCSvBLBXlgry14M68EsFeWCvLWgkgryQV5sbrrdatKAB7n+5/nHsH0Hq4AAAAAAAAAAAAAAAA8mfJ3twAAADhFBJXgkr15IK80EEtavJXgkhry168teCSvBLBXlx+vtU6c4AHsX7F8Gx/sXQuBnQczXDsjl1lw2Y08z5aM8aGZormJNlMebxy684bby1nhliiWDH8shwxJkTfOW0gHkz5O9uyF+rs3ZtRrHWNxkNhVx+vtRRZ8suM/v9XxwyxOpvYrU3cbrrMEE0FeWtXkrwSwV5YIJa9eSvXkgry0aNmhRsgAerPqzxXtL3zzPFl3hj+Wr8Nr5bGa2ZgrGNM4a7wh5bCYwxplCM2o1A2MwZeMUZoxhlzqnh2ryz5bAPJnyd7dkL9Xtb1bpVu1DRpWL12vWry4LQ7LDae/unc+v2rUOk9I7F1l5n26vBLBWlgglrV5IIJYK8taCWCvJXry06VjHa+0AB6c+nPH/Rn0Z5SAAAAAAAAAAAAAAAAPJnyd7dzzxtWYfhxwy5Z48cMuGGUkmHDHLhFlFFnjNbbgrywVpa8EtaCSCvLBXlrwSV68sFeWnTsY3XWgAPSn0p5J379KeSSF0omUAKJeAKJKYwul8AFUtHAwpmiEsgFEvAAHkz5O9uymzp7f2/RaT0nsPLLiGGS/fq/OOalSeSTCKHOlRs8eEMMmI01+vBLWgkgrywV5a8EtevJBXlpU7GO11oAD0r9K+R4v6S8lona51ecTZjWTOFEGxmEMAdqHXpCbYaibuY4pmtlo147AMCdzcuj+GePTXIADyZ8ne3bF2HVdj+jdUwWi2Ms2EsmF27Xlmw+mT2dPUOob3bu3aPT+n7ytWn6b8a77Xglr15IK8sEEtavLBBJXry0qVnH6+yAB6g+oPHOyfojyzYiUyJyPpphuZxNLM2WDJHwwhZMYZ007hvfLiSHIAAAAAHkz5O9ukzxmmj4YZATTR5Xa0rVqHBaLZUqNiGHP5xzQoWqGvs14JK8EsFeWCvLXgkr15IK8tCjao0bAAHrP6y8Rq+6+b6YbOSGJMkY85mZNlNKMYZ4xRmDQTLmyGplkwJ3/AMuxgAAAAAeTPk727KbOnsvZdRq/V9xWrTSy4feU88Vm1DQ19qpSn4Y814JYK8vCPKGLPH0LPLlj9db+c8QQSYPQ7LH6+1TqTgAezvs7wDtr1rpAAEZIAAAAAACMkAAAAAAPJnyd7dsXYdVv3fes8MMtg7Bq9Y6xuLt2vn+wazSOkdi3fu3XdP6dvsxutfhNJsadKxcuV85vNdqXUt3HHns3ZtRg9Hsde69tOgvAfTsZrbdevKAB7z+8/mrde69eAAAAAAAAAAAAAAAAHkz5O9ukzxt24IIJPvKSXDhhlvne+taB0Ds8smFDX2alaaTPGlRsRx5wx5UaFrZuy6irVn1rre1xmsuY7W28Vq7sceQA554/o1+jXyj1rahxJwPhcKZsZrZuXLC8LR9NWMsWDJ8uvj0MAAAAAAAAeTPk724AAAMUMMkEEleCSCvLDXlrwyV68kEEsEEsEElevJBXlr15sRqboAG39v0Xvn75+ZtUNDN6MYWzgZc18zhiyLhqhtfK8WTFnA34AAFOnP1V5V3TZ+9dU23s+v8AhcOQAB5M+TvbgAABwiyhgkrw5wQSw15YIJa8GcEEsEEkFeWvBJBBJBXlpUrOPoWQAO8PcPOvXH1x4cAAAAAAAAAAAPGvxr75UqT9HfUPxB2x3vstKv3fsIyJrZ9OB7O5eTPk724AAD5jzFBJBDnBBJBBJDBLBBLXgzgglhgkrwS14M4YJa9eXHa23WrygAeufrnw3u/2/wA7AAAAAAAAAAAHgn4J+l/n1x8oaR7L4Pma3a/Z2g9l6tOpSuegD4d+cvJnyd7cAAHCOHOGGSCHOCGSGvLDBJXhkggkhgkgglrwSQQSQQSwV5cTqbvHjkAcueP0J/Qr5czu91oAAAAAAAAAAA8xfMXsHjj7h+EZLUfubz/3XR6G9qERlCQ+nqnl5M+TvbgAHDhHlFDJDFlBDJDBLDBJBBJBDnBBLDDJBXlrw5wwSwV5KdOxjtfaAA2Tt+i9vffPzMAAAAAAAAAAAAOndx1jsXXbvOwXAAAB/9oACAEBAAEFAvhOn9HTp06dOnTqbfpw6k1YmZ8Lh14XDrwuHXhcOvC4deFw68Lh14XDrwuHXhcOvC4deFw68Lh14XDrwuHXhcOvC4deFw68Lh14XDrwuHXhcOvC4deFw68Lh14XDrwuHXhcOvC4deFw68Lh14XDrwuHXhcOvC4f4Tp06dOnT+jp06dPxYs/a5L2x06dOnTp/R06dOnU/wB3DQN3NH2x06dOnTp06dOnTon34dWL1sB7a6dOnTp06dOnTovFoxOfCZHNZKqf+/Yr6T2sNY9jaezG+zvGcfyBipjx+VnenRztuFfD7fjs1eHnsw+S/u1Hof2WN7X8lnI4nF5jaiFxsd1xs8iHZ7d6zc3WTgDsRe4NuteAcpliUDy3KBqGHymUyMMbsBBVP7RKZp7pW6f9zxvlW3ioOnU2+vdJa3B+zJuVB8jg7JruF4KteVqxcqYqswqtk7VK4SDFVsnaITTRa5wLHY8dqEw46Vk9f62zBKCTp06dOnTp06dE+3DoE/8A59jDULWUnrlCdW5g6OQstrWN6d7XLFrLPrlDtR0K4rMdboc1HFAx0q+DoVrVfWMRWpvixTx76zVI09SxMwjw9cJR63jhOLUMQID65Q+stYxD1jUQHt/1XE9pXxderL+t4+TVcFQqHHquJHSjh6w7D6zipCHiQRNW06RLI8RXDaAJgA4KrHlYJEtujDlaiMjFUOVqNc/+dokz4DFSyQkYIY3gMNz5ovNWdOnTp06dOnTon7eH8fP/ABexxlKLksWDMOwcK6xkOwcK6xl1CcgzmCnKV59YrTMcxk6dOnTp06dOnRP28P48Ur9GEWu03sTJAUe9qdT1FZAefqeyCshGFYHbyeNx7isgMTggYJJppRkpZKhCw8oxaBhFf1PZBW46QI2bQcXXcpa5wKVWzBhiKaQaz93OtKVklc4merZiONWyRTEWJD1bNdTqWos6dOnTp06dE/bw/j1bFhLuRzPNmJY7ItbpYebmsXWLthCMHLFewXZXBCtlK2SpVcxYVGxs9rI6/wCXHauRu2MsEm0TfO0b97YDAsYsojbJZoDvZRroZ7LWx+Dy4R5ayC++bhYzIkOFnHYqrHJ2cgV8rlaLlvNkLEtlnj8tbPRywpbGTG3I3bGW4sT/ANGvJ4XDFJY1/Y7JomwzDljer1MhDqOOw0mq2CdCxOwatrz9HzORJ08dsto406dOnTp06dE/bw/j5v8AXt7LiqUAZGtYPcyFPHgYo3Zpwd2lF1Uz9C7Z5o/XqQ+lrYaFK7j8iDJBt36dCu04OmJB1bydamSnkKeQq+Yrd8RgWRk8Rr2O5ou/PB0zs7fFjKUX6xvr1CckyEK8CEFKVixKdM9aE8hkB2R91a5HIR4TMWbltWTRIUhU6dOnTp06dE+3DoMPpjMzq1nLZq9rmxW8Ha1exaqHxOVchtWvQr6o9UufbUrB4WtVyNwOO1npXia93ufFq10aNq1uzQLgbhbktUyboOv2pXzaznX17J6pmblgmJzNnYxafkK+CyWBzti8PH+bs69TLja3xaQI2bVyniqyjUtTXSI8yVzhlKtYg3Y3V0A+P7Wy4pBNEcq1mMi1bIZkq2RsanbBB6N3oxrWCxjQulmWvYCj0bteD0bvK6LxaUPkwPDGMYN8aMYwb42J/wCjlHyLo9k4KTMLytsn8F6y/mascg2TFyeBNNxWsd08lUrWR28nZL9B5a7bjmsmIRx8uS/sFOx2+JBK9a12zyNlskZ69XY7tmvjnRPvw64HoYP2OMpRd7VmTOUjs5SvMlmwVdTnJHK0q0eoTka1ahCJSCfnlGRbdoqkYrkNZsHT2rPS6xYwx1nFgFmsq2SKS9dLApjFZ1L93BGLzkATACa/cBsMdzh2lrd6VIuY2C4+Hs7jWpQnu9bt9juXqTH3CpQNHYKxKE9nd7dHaKeRuW9kjWsPv2K+lra5051dux1vM2Njq1c2bci2cP8ANunTp06f0dP6On4sBX7rMo+Ir2bmM0+uHHTw9Z7M9bx8onwFA5bGv0bYshjoZGL6zi2e5i696nS17H0LFbXMfVWT1yxeyc9coTq3MHQvSr4oFSzLXcfLIC1zHgDxHOGsIu74Qc8dseIyc7FivUCazWrAZ2dviunTp/R06dOnT+joj/pw6HW6uU+Yz+SLmskPHw+mxnj1MzsRNi/Ee8bFnreh7NueV16Tbzmc6Sf5JzOIHjPyTcfKUd923s/hOnTp06f0dOnTp0R/14dEqdHF/MUG6ZcxkitY2PDnxAtDwX9p1zYtehsGt2/x/dfJ5jG4rS5apq0NsHQ1LMQLLRRS1v4Lp0/o6dOnTp/R06f9X4GZ3fGVGoY/5jZ9fs17eL2AuM2bI5LYvyLmq+DNp2nWMrvQmHld57gWY3gkrF/eR07ljdas6WV3c+U+C/o6dOn9HTp/R0T6/Thw8gwynf2l39pd/aXf2l39pd/aXf2l39pd/aXf2l39pd/aXf2l39pd/aXf2l39pd/aXf2l39pd/aXf2l39pd/aXf2l39pZK/pXc46/X7Xv7S7+0u/tLv7S7+0u/tLv7S7+0v/aAAgBAgABBQL4Dp06dOn9HTp/R06m36cOlWehnPbH9HTp06dOnTp06fixZ+1yXtjp06dOnTp06dOnTqf7uGgbuaPtjp06dOnTp06dOnRPvw6sXrYD2x06dOn9HTp06dOicWjE58J7HVBK1YuVMXWYVaydqlcJBirWTtEJpotc4FjseO1CYcdKwev9bZglBJ06dOnTp/R06J9uHQJf/P8AY6rHlYJEtqjHlaiMjFUeVqNc/wDnaJM+AxUskJGCKN4DDkfMl5qzp06dOnT+jp0T7cP49f8Ai9jjKUXJYsGYdg4V1jIdg4V1jLqE5BnMFOUrz6xWmU5jO6dOnTp06dOnRPtw/jz2SkCNm0HGV3KWucClVswYYimkGs/dzrSlZmA4merZiONWyRpiLEh6tmup1LUWdOnTp06dOifbh/HnsmJ/6NeTwuGKSxgNjsGibDMOWN6vUyEOo47DSarYJ0LE7Bq2vP0fNZEvTx2y2jjTp06dP6OnRPtw/j5v9f2OMpRfrG+vUJyTIQjwIQUpWDynTPWhLIZAdkfdWeSRCPCZizctqyaJSkKnTp06f0dOifbh0GH0xnsdIEbNq5UxVZRqWprpEeZK5wylWsQbsbi6AfH9rZcUgmiOVazGRatkMyVbI2NTtgj2N3owrWCxjQulIWvYCj0btaD0bv0dE4tKHyYH2PE/9HKPkXR7JwUmYXlLZP4L1l/M1Y5BsmLk8CebitY7p5OpWsjt5OyX6Dy123HNZMQjj5cl/YKljt8SCV61rtnkbLZIz16ux3bNfHOiffh1wPQwfscZSi72rMmcpHZyleZLNgq6nOSOVpVo9QnI1qzCESkG7TlGRbdoqkYzkNZsHT2rPS6xYwx1nGAFmcq2SMS/dLAhjFZ1L93BGLzkATAD7W/o6dP6OnTp06dS4sBX7rM/MHOGsIu8YQc8Xl6WYF8g6dOnTp06dOnTp06I/wCnDodbq5T5jP5IuayQ8fH6axhfE1iR5X+O/o6dOnTp06dOnToj/rw6JU6OL+YoN0y6zhm6YWYivQ5Pjv6OnTp/R06f0dOnT/q/AzO74yo1DH/MbPr9mvbjSh2UAgoCsHewX4z+jp06dOn9HTp06J9fpw4CNaWY+aH5DlJ1Ob4H/9oACAEDAAEFAvlY/fh2EXUx3v1wfWqe8x+3DZH0rHvEeLMw6eT94hxbHHlyPsZiMEQDXCvMwhuYs4ymYQ3ckIqBRkVq1IMoktMIZf4YEgRvhR+/Ds7f7XsZnGwoPANl/q9iUXgn+r2Cj/xDCI8ndapNDnN6xOZh0IfQ3wo/fh2hv8/Y3ZnaIhQUhDIunBSEMi6cFyx5pDGRckOXkg8YDGP4TKP34dp9ksEcQSXC8kCjImMKSnOA2IX+CJWYMSjmmMF5OYUU04PEZhFUThd+NlH78O0+yXf/ACFZpVxwiLJ4kQ3HfeTW+Tlqy5WkL6OYUeoKIhlyn+fj6sOa1iAjl8GP34dof+X2N2Z26cFyx5oxjBSjGbMITROM0mq1ZCl0Q8zRjzNCEWgEMHhCEPgx4tml/uex2COIID3SpzhiueHLEoyMxRSfuK66hO66wediQeTGE7QMKbRMKTjOAku4r87lFB3s14RgUU0OxXLLuK/1UOLYZc2S9ju/+Sn2jIYhksfWfZAh/JWC3YGer2c+byQ4tMNvmqHKGYaYof5Uq4Hx9Scxy+tTxhxdW6RqwcqH69jUh1TYmuItpR+3DlZ9TI+xuzOzBEy5IMuSHLEQoLl5YPSsGfljzOEMneEJtys7QCGCYcOUYhDXRDz8kHlaDcJPH0u0hCtXhKA4Q9G+3A7szEn1Ce7txZMvRofMDGQ04a7kJRvVp44/zsfvw7Kbkp/MYypDH1J2nW9Z9sxcwGSlkqPzkeLZDc9z5iz/AJQ23OFct+hKrHUIvy/Ntx3D9za+Yw+UEUML5R5U5r2dtY6iPHVPm4/fhyblah80fw3UD0On8D//2gAIAQICBj8C87Wnoqoy/e+7y/QzGhaqnmnb1f3Ao5j36St0gHl/LtqUr/KxHZy/h9ysw9TdvIi5db2MPSWpU+bTZYT0dsYqKOyjUCYrNWFXEi2YRMA2+LV1aYxUUdlGoEwSisQt9l2+BxkZZ6xKKmYzDFcvTvlfFNMq1V6THvWd7mshqGVWoROwEd7nEYKylX22eY101Vp9Kj2ciKMt+POyKrfqtJUqovdbb6cxnGWfLisyKP8ALIv04hptn1x+ouFKTpCw68Dxlny4rMij/LIv04hptn1xn69NTTcIDI3hgrdtsU6tY4qnFv8A5oarkVx07MQ9OyMpWwCnmXPeUen7YzoXF8xi+qZNh+zOKNJqdZXUmRqSmRp7PMc0v2k+9yJiWxolVd2G0kxKi7qNhIg95u9fbfv1xKi7qNhIg95u9fbfv1xw5nh6tEfBdl3EiOIWbia529McUM3F1zt6Y+M7NvJPr8xzf+l/uciJQaxWMZqk2I8Fe70GBxkZZ3TEoJem4C3zBsndGCipZtlsLQzK1BbaAO90Q1HKrUYA3S73PGKqjKJytBFscZqbilrkZQDTpuQ11htjhMpFXVK2Pjo6T1giCz03AUTMwbAbuny+b/0v9zkSl+9GfdfEB2GBUrnFUFW8wMsp+CyAkazM+wRVCY+NitwGTyslLr64yitTqq64rXvIlGeXJ/1vF55emKMmP1DxcUYp89/bFRnp5h6bLbcacuyKD0GKuahFm9z2RTap+KctZvn65Tirl6lLM2sO9UkZGeg+yKeWQyotSBI1+kvL5ltGNfUeRMSmTQTiabX23744czw9WiJ1CWO22MVJirbLI4jO5qDTMzhnznFxm5kNu3TphMtl1K5dNd5O2OHxH4erEZRwyx4Y0aOiMTMxYbYw1ajsu1iYnUYsdpn5erU11/Uq+3kRKDWKxh6Yq1PmV0S09EDBTczExYbtccIKeLqlb0QEqoysbpiCzowANswYHwqlv2THHlU4+PV3Jb/pjjCm/C1yMoFZlYUjcZWdMBDTfG1wkbd2uBTqo6u1wINu6C1Sm4UGVoIt1b44lem6IdJBEfMcKpwdeEy/ZGOkjsk5TAJtOjfDUqdKo1RLwFNm+BxUdcV0wRPdrgVMxSqJTOkqRGI0qmEJi8J8PvbtvkEb36jnrw9nIlL96KyihT+Wt70rZa/F2RkuCxXFKfVGY/8AoNFZSv0zlt8MU6D064lWEmqS6JxTy9U/lZqZbdBPPKKzV5/KS7ttmiUuac4Xifh8cT3TgVaaV6iYbMJHDluipkLlWqGXYpb9vTGal+ItPCkr5CeLDtndFDLvSzAlmVk1SR03ThcvS79NGVgmsyn0xT/Uaxr06PHTHTqXXyJA3T5o4sz/AMVw9fclh6J4+eWyM/mMlYBmDg2CyXVGL9NZjnzXJqyMm0/9nNH6d87Li8Nt2OQ7btsozlKtRzjI4Pecq1MH6pXUJyu2WWRk8vRbDSq5fvbe6tnWfIZZP/UD/N3u3kTEpk0SNR5fvGACxkt1t26OIWbia52x8V3aWskwHrzYTtttlDNlFrGuVkMZsXdafQRw5nh6tEcNKjhNWIyjFTYq2wyjGpIaBxajtK6bExxSzcXXO3pj47u8veJPrjgcR+B7uIy6LoNJWYUjeJ2dEEZwZjjE302lNfdNo2wnCXh5ekuFR6elkcKpWqtS1FmI6JwBVZmC3TM5bv7YVfEYSiLkUDoEuXstR0cUHmXvHqHnJrZhlSkNJsEYU41Qa1Wz/EVPVDVckScHiBEiJ3ciPmT4aVLraz1YvOWpKfyNJpKNcr25/VzxLTDvU/qK0pjUBOQ32mcbOQ3zRvrVOpbPXi85KVPGGtj/AJTMj9z/AKvZ0xZfCjTLkKQvijk9KIAd+nrn5y36r+nqXoPa6i9TpMtRv2W6IpZelagRZdGmJ1T7Tug1DyFl/m2w0eIOn6o52ls1+d/B42DZij4s8e3yP//aAAgBAwIGPwLzstpRgezt5fqUtaH1f3Ael7rkdB5fqjbPpAPL8/eQH1js5ENU3CFcqnAPTEnYA74QU8EmOk+qJOwB3wMRAnHwyDC0qQnVaHasEDi7VAqVio57IxUyCPMabfY7eRDxvw5WwgyTlkY2iKq1TTDE/X1bIyqzxd+/nWKq1TTDE/X1bIy1NiGXEeiYhkp2Lg9kBMwcLaIr08ReiosMZcmXClpunth3DUyDKxbvS/zGidjdnIkjdHcVRuEd9Qd4gWCy6O+oO8QLBZdGKQxR3wDvjBIYYwEDBqj4agbvMaH8f3eRGqC8CKLiQ4htj4bAygBWUk7YxOQBBqUSvTZAqViomNdkSRgTvjAGXHqnBxMoltjGCMGuPhsDugAMpJ2+Xofx/d5EfdGWU3E+yMNOxcEcYj4gaXV9MIWw8OVmK6cVyGQqZeG4WxlzX/p8HX6Siv8AK3YLPo7IUK1JWB24pxUWoJjD2LDBfAKtu6UJVV6V1yzFkNWYfED2eXpD7J7ORJG6BYLIxSGKJKABEnAIjCFXDugLQwYdTCyGq1SDVbVGLCuLdGOQxRIASiaKoOwR3AB5dF1U+08iNUF4EK5ReEfTXHeZbNsY5jBriaMCIkrAk7Y8a2bRHD7nDw6+90Rw8S49U4wAjGNGmCwZcIvtjEjAqNsSVlJlO+MNN1LbDHCxrxNU4wuyhpTvgO7qFa62DgZTK+RjDSdWbYYljWc5Xi/Vv8gR7qgdvbyI+6EJqNxtWifRGYxicvpil/4g5nq2dsNUVqf4ZmFhqqD41vRCCnLjztg4fFw+yCjNTVp6Z4oTM6Skjvl6dEUfdLTbsnzRUqq9L8IzCQar91mBBbZDZWnw2fhthde0xgs+dxfxTn7Iy1LMWzpjF19sSzYHywp9yd3p4ozXy/gxD+WZ9N0UHSpQDKblmGI0gxXq1BN0q2bLT5Cs325dFnZyJI3RMKs90EgCZjDIYY7iqOaMNOQgCuafDnPui/fGKQxRiZVLbok4BESN0dxVE9kYJDBqj4aqu4SjiYV4muVsYyBjGmAaHCwS+uNOsWQ2M4qrmZMY0RA+uQiaACf9uZuhqhvJny9Vf7Eumzt854dIFnOqJtgXefYDC5fNSFRwStvilfLdp5EWlpd+ofTLzkOR+YcTPs9NMT0RToZQ/l8sTJhpcymRsErOmMVX+ppnC23Uecdc+QxRFyL1m31S85xL4SI/4PIfiN+JK+36nt6NcWju3T1nTLTIXT59MZl/qY1HQLfXyG9f3m6tHV5yMlmjKotik6Rq3xWzlUgOajTJEzfco16NmmUSoLM6PdQbT6T6oXKpbK86zpPIVXgidTD1aerzv8z8txftYJ9cflsPC+zKXV5H/9oACAEBAQY/Av5rPylIt10WF2FOVAWFLcAnA9YSgWCUQfstNf08fCcZ+Aq/dcfCcZ+Aq/dcfCcZ+Aq/dcfCcZ+Aq/dcfCcZ+Aq/dcfCcZ+Aq/dcfCcZ+Aq/dcfCcZ+Aq/dcfCcZ+Aq/dcfCcZ+Aq/dcfCcZ+Aq/dcfCcZ+Aq/dcfCcZ+Aq/dcfCcZ+Aq/dcfCcZ+Aq/dcfCcZ+Aq/dcfCcZ+Aq/dcfCcZ+Aq/dcfCcZ+Aq/dcfCcZ+Aq/dcfCcZ+Aq/dcfCcZ+Aq/dcfCcZ+Aq/dcfCcZ+Aq/dcfCcZ+Aq/dcfCcZ+Aq/dcfCcZ+Aq/dcfCcZ+Aq/dcfCcZ+Aq/dcfCcZ+Aq/dcfCcZ+Aq/dcfCcZ+Aq/dcfCcZ+Aq/dcfCcZ+Aq/dcfCcZ+Aq/dfzyjY10hVtBl/chg74/WGv9NT8qnY7evVrt/WxQlP8AX/TMfKxxfurNXzdFzFR6Z+qP9Mx8rb/o3Hr+bUVN/wCrxncUtwe8W2MKHl4ySHs6+e/2PUINNln3XbpW3lr/AJQxExPpyZCPVXj6OauiSrdJznhgYObcNrIcx9LxGySRLB74xz2zoMvTkabMbNPEuzNqLVit1oqJGw05rIWZze6Ca/t5VMiozEdZ5zFjxuJu17SF42wFPq02tsV8nkAxwdM1vlUWKzzjqgUwMTMbSKJ1gYLF2OlGTx2FsPixVIE5O8VQWKGIZvaimVrYbNI1YOkRp3uLzVLl66tG9kE+Ht0bDrCMc5aHdVCbBnRa+WwSRbpvDXXbMSPGQrHTOnexxqBqHNWwCizXGxWYL0bxkDGdpctRMZ7Y2kSRyNu4OY94YCrk8Y6lUr+BZkrfhD8DIqjxOJsN3Qt3UfOi50PdrETSq7Z3ptPrMC3TsSxVOwqu2bCK72Ook2XQahZGpr112lEjxUWtR34K752rzUVNWtBqxGRqJoybW7dJSkpGPSRFz9cMujUszjlYXF5s7hnVREJzQHOMrbHvX/ubBht5zCw+sURx5hyFCVrtYirkO8t9a/W8SnG+OQxFlBMr2VaNHX1HBDMcuK15wqaTFgUgdurSlpdDrGFfxBDDrBwPdCO30yMc+LTsIiwYJRh3tyOtdcVves1bCFxXfPUafgrAkzl3RZGm4tYh+PWs3kp2TqDFZ9SzcbcxCbLrivdinleUH+zYCzMYg2Dpy3Lk/LfgalNlLMze8QyL63mkagCUwBogldZOs9QJ57o2cu3i+OMq1X3qT8Ly8cizUOplsn7u3RYpkYxaSYkJB2AUxOpxExxYpRUdbyM5OzUVUFlZS0rqY7HXbRzZLZuroK8IQWksJhxy28xdZXjbra1PEe+sie+qDKNRNq/UvqJfWLrW6TMczUQmRPbOhdm6jURQbftZHxfQWtyUDE00w8+ox5QIwYco7e9p6OcRaCpcpDbxVPOY1p+EadrHPt00FJLg2DXd/vA7pa9xkTruiRHOdanVSyhkrlGhteRA/wAPHcix3dwTukdxR27uURpxA3mX7mcZYoU3YaxVp0HVchcSw9iJEUqLFkNdrAd1H6go9pmUbeE06+JtOyJnlEup+IqL8M/E+BNom+WSogsIvgaijt3Dugee0bVehbsUIwWF8x2LUEhc18Zm2XQRPQNnUZYUNEjII+rE892gk3FjEGS7NqjvG3SJ03KdVtt0FRF83FVYhBL6pDEdaNNNJEp8Xeo2KMOx+LyVEXWKX+6r5e0ulWgnS8EVGhYaPU6hQILLdu5HA0E1qhOO27IKcxNumypUjFlQm3Y8WLOlYq+HvwYEHOdNsiM67SfFC5TC1gL3mHG2SKow3UaTMWvvI3shNhkZRZbD5QMxr3twjYxSdsuB1ygDYtUjbF+nTdaZvx4uK4uoPRJfVIYiWxpppIlOHuWCgrFvF4+y8oGBgnPqKawoEdBGJMuyPkqrjMRLS26z2RHbM/qiOHKGxZm2rloQRCjPlyj2esR+viSShzRjtlayKPm1iO3i4Thtbkq1X0VyQCeh/wAeds7B7vp05a8SSUOaMdsrWRR82sR28HIKYUL06m0CLZryjfpHd1mOB6yWK3RqPUAg1+bWOLFiwwl1q0an043MKdNdB5TppEcVgqstuUwtHDs1cPOP4cCuN0zH6J4aiqqwcQU7AJZdfT+0EDBR+zjY5ZqLt2sGRnT18/R/J/r+VeD925B/o76Qjs//AJ8Y7MOXJXcWFkKhwcwEeKX0jI1x3WGCyKAmfo9QtO3jJ0epcjH5WtkK1ijFoprLHKdTxpVROCKuTCaUxpO0Ne7ERwNi9DbQrB4rqNbM0wmzTdj7Bwjl3nUrLFzrMxoc8tefDQYV2wTvd4y61dfZeKcXbG7SrgxxFIqXYjUvrs+vJTwp6oXVoRl6GZsSGTuFNmzSFRb/AHV4IaqmtagAkuuQyEb9nU5xdodS57vuqckqPiSmvXGwyWt8LBQRp1Ke7Gu0I5DERy4vWg3w7IwiLE75j/tlSlXT00lcwBejjquZdtWOtjXeJtW2OdpiLJW6CYme7CVPYUzpG5mvemZ4PwrbQ1y6mykbyZUry1suZ4dZ6ksZOeQ7tgRyGBjlwu2oWdZTss8dWTI781YVavax6pamNv7vB0BU0qzMXi8OQm9m7wmHWxdGQauQauwqG69QZgt2kxpMcW8bYsW7abibFdx2Hb39GyqUmAsEA2xC55cv09vCeveyz5rCxSDK70mLrvVCbFYTqrrz0ngI6/XjbG2Y4Cv/AL1aIqUKbUquuWuyvFiA0DsgMwJuRAR3uW+IiC3RERFlld92uFsrDW1lWjGtFi3u69pQTrKHMMpPuTA9SZPTdMzxXMSteIResZArU2C69mxbVCLfiZ06ZrsJERkYGIiBjTThtePHEDKVHHhLLz2FWq4uxNnGrrSRT0vBNnUZ7S07+7gmQdxdkrh3/GqtGq0NhtNFB+hhoMrfXrDuCYkJKN2msRMXKcKaCL2FLAPGHskpoHNyT9oyTaVkyvMkmlMkRTrPPildZBdeh4jw8wWgx4pcKbuH63djilS2P6FDEJwdeOtO6KCGUWgJFp3mbscvvfP6+MiSTsBGTcVh64eW1bzX02urTHtEG7SJnSfpRrGnDZad59pxUz8e246by5xxuOh0HDIdEaxWWchjQ+oe/dvLWtZVDpsVveE9Zr2NY5mTKudx1g2TJNYc1Q09ADG0YgYiIbQEX+HdgsX5cOOtO73bh4uxTGC05Ojx7NxfW5cWXqZbUNwmss1AsF4Nr3q6TH9At3TYQxrOyRGT70xu1nhCiW6Rq46ljETFhq2KRj7CbVNoNVIMC0ixXAxZExOscU7LW2bVikq6lTrLYMiXfmvNiGQIABf9qOnKNOC8fEJxi8HfwNWjXy13IdOpftY58go7NKn4NVcMYAgMdQtC0ktoBEPsodcTFo2usVVWTGoyw5cKOxCucpaURr7ORGT7+m7nwlEG1kJUtUMe03POFhAQbnMmWNaWneKeZTz+SqK2vX3aq00jvDz+t3fR6eLZ5WotDUK1VY5QRHEFpEc5n6Wnp0LXjGnXC6wFgM7aJhHtdBk+uH19T119Hbx5iOFEnWqG5Z6QUH4azBa7ZmOc8+MadcLrAWAztomEe10GT64fX1PXX0dvGfetZ1zFCj2HA7gaCLE7piNR13RrxXa4pYzxUxvLmXa6O35uGtoq6y9RFy50kS7dvLcJax+jjEO6IVrTjmXoDT93tnby5F6fTxm4HqTYlsckEIPlO2P4RF2Tu14qKKtcWayZsbc2yww5bx3RO6dJIf5OflZQdexlSdPnF/P9e3+hIIZkSjskZ0mPmmOIhr3NiOyGMM4j5t0zxMJe5UT29Nhhr8+2Y4P2rPa/xO+XtO2O/wA+/wAp9PEwl7lRPb02GGvz7Zjg/as9r/E75e07Y7/Pv8p9PHT3n04nWF7p2a+vb2a8exc1Wvb02EH/AKZjjqyxks/1JMt/+LXdx1YayG/6kGUH/j13ce2c1unZ1GEenzbpn+Tn9X9fysv/APA/+7wwzu1ABVldJpFYSIquOJQJqMmT0Cy07AQIT3pkx9ccTUi3Wm0MzBVoerxETCwdMSnd1ImEtEuz6JRPp4k2mCwjTUzKAGNZ0jUi0iNZnhCvEKllqbA1xEoLqlV18SIyOsao073qn5FlSmibKTxrWhjtS8q1e4Kj/tTWtrP5jj5Ceu0V9d66yd3+Y9uvTUP9otOBchq3KONQaoxYs4101EwmRKNY4UN/IUqJP39AbdtFaXdLZ1OlDjCWdPqDrp2bo4sJU0TbUMF2AHtUbUhYWJfpJLRL5p+S1a2rNlchB6wMSNJmsWgLRidyyJRwURPaM6/8NRmCjUh1ide8JSJRy9IlGk/p48IVlcWeumt0ue7r2ENspV2fSYhBlH6B41KYGPXM6Rz5Rzn1zw0VtWwkM6LxAxOUt6a3dJsDMytnSaJaTz2lE+n5Ceu0V9d66yd3+Y9uvTUP9otPlpQUyItPbMj2x82vLjKqLqH4NeqZ10nXac97SOfOOB6yWq3/AEeoBDu+bWODk0OCF7epJrMdm+dB3bojTdPZxsSs2l+6sZKfn5ejhaLKrA6l3wBZdfbpM90NslP7OzhqaqrDIAygRJZdWBif8wYjUZ/Zxualqx3bdTWYxujtHUoiN3HWKu4Vf6krOA0nsndpppPASuu44Zr05FRzB7eRbZ00nb6fVx0iWYt129ORnfrPZG3t58RL0OTu+j1FkGvzbojnwZHWeELETOSUYwAnOgEWsRpBT2ev+Rn9X9fysv8A/A/+5xlcVXS4amRpx5lG1AF0IzNPFW8FXVJ/w/EKsDRshHbMp9Uce966MhUuZ1XnDLPSCnhYUUYmKmABwbOouyFOjX2jPOGco4w578hahOSxr8sci63aZVe0iuE5CVkw662uiSAQ2qWPZAjypWrg5xGPVnvM8769TJIsqoOqoip3a6PH1a73HrEjAl6/rcY8X2btXXH1Dx9hyMl7S0WSyG73rVx+PNJ3SxY1oaizsEdxEGhQUgqWW81HjPOuRqPgGvVCcGj390Fq2DEoqu1D2sd/6G042r200TZyKEKb5rqKvbMmVjxNHzDYo4J933fQtOs//wCWoTXDY6FqZnfBTt1y+QBl+LDPOflxLFp644+zRf5d8q0snY8LI7Gp1k/aTrKiTykdD3Y6LF/zCHjcF5lt3ZizZVsyGOyWNThYHQI8KUVrrZhY7fE9KJZDNC1xzLjrFMjDy65QkjJ+GfUbQotziW1a9Esf4ttsrITL2Qytoso2j9LBstPyjveFHPe8wuk40rbUvU4xkwsxhdNg1zMY27esPM95Ru4reK98lcr+cK5ikEXZw68IEH4NwTCZx2khIkbN3W68kOu2NvGPA7F2nHgkzRcxWVNc5D3vk4tjcTTovW+fBggYVZmA6U7l97cQYoKbV1ln5a82VbNp9A7yQG3d8qQKoGLNVQWWQsiDfJxMLLuT6MpjqyMpFduRxdVGQSWXiUpo+VKKlvMsQk7dyTcnZA6gsm8iL6he87DcuvIVvL/kq6ussXIrllLUtLOA2kCxCxJxGxqigoVHOIEu9xUoFGW64ecsiVkpq3PDe4mpyjqO650vCHTmGJgYg5746doTpjGqdm7FnIeVr1nJ9WGWXV7lPI+XlAdNDVGCMgOLvW9ioHWwSomYI4mZydLxWUfWbdxtLFLvheNotPF28ja0K8sbUI212HJs9W2J02RxeBM5CvXu+a8UFl1TrJluPjyjtd7cI1FE2ViEmMxIH2EJxExg5YWUueHzmbxzKO3JofapK80Nx2Myjr9ZHh7HgcXXhhrsyKrCTJkzrtnixjaqM8uy3zD5tMrPX8zN8JrmMpcxLAiuNltub9Swtg96EOKZJ0kfIsZft1LMvdf8q3LU+GNftf8A8llotzt2iC4C03ZPZAlMRxlBsV80FKU+V8rFOS8wzZp215uZy6AtWF1LdptemuCYtI9FZj7MYKNeLwOPNh5f997erVHKHc6EeUPLR0R6qVsyUUjvFZlhjMT4mNpzzKJyVo35pdvH+TiyWNWuGpKxla9vNsoTcrKUEPvOppRFitptmT0kNYDbhXzF6caScqi3FStauD4pg0mUOsiopzOcJaIFMaby29pRrYtsfnF3Md5O8u3qidbA9XNFe8wzeGynbPjXyiskGqLdGwonTdsKK3ivfJXK/nCuYpBF2cOvCBB+DcEwmcdpISJGzd1uvJDrtjb8up/zY/qnjPmM6EIbhn1SIMmJ/bxDHlLGDa5GXMvpTHb8xcDVE9EMQDDCIjvn1T5lPbOnSji3AQ6XdWOoNYxCzK9A2bCn6v0v/HjEiVe0o19Yd9rb1WB0501mJ1LSY9PGcGn/AN94svozofS1HTbPr036fp4w8ZCdSi2vr9SYn0M29SfT6N3FgjrZF62KmD0JZ0+lt5yIzMQGkR8/FE0MJRlZMJIe3b1LZaa/OEcVyZp1Sxs9KeXNnUnXT+305n9XFmuyrk+8wCF10lsFbd8fQZBdhRE9mvbxXrAe1Laom0IiPaTu0jdOms6bP5fJF6JdXj/CDJn/ANXFxllrFxRytTD2IlRSUW7i6b07RjtR4a8LJPsgIKfRxerrKd+PtKpPk42hNltSvdFSimfaFCLQa6emdOGWblhaEq06hlOu3cSxjujqeurR9Hp43QwJHUI1ghmNWbZCNde098aevWOJGCGSjtiJiZjvEPOP7wzHzxxMQQzMdsRMTppOk6/NMcIrJ62r0ZB4MMRBWmNya8S9czJ7+oVtvc5aFHGm4dfVrGvr7PmngZ3hocRITujQomRiJH1xMnH7eG03xZjw40Ss2RrmyrW95PZXpddgakHVaue9t2B2lMRwxyIMYVdydEgbshnUxWTuYp57QM/Yss0jkJ7ZHTWInlDLduwCa6ZgWNLWYEiKAgdBgi3SRRy4HQhneO8NJidwd3vD6x70c/08DoYT1I1DQonfEekf3o4xi27p963GUq7A2SoDVjMjlSY8yMdqfDYw41jd3pjlprMVbtOwt1W8pT6rYnTrLcqHLmBPacFK512zEFHp4RQ2WIbYjJSJmrpqGMWVUbElLCEtp+LHZMRIlGvPg65lBC5M7hBsgZJPu7hJZCwYnXkQzxfyK0ka6wnetsBk3bzz8OoOodm48nPcVZYDEmz6ER6OJGCiSHTcOsaju126x2xrpxOhjO3Xd3o7ukkM6+rQgmP1cRMTExMaxMc4mJ7JifV/LQQzIlHYQzpMfNMc+Dnqs1Z/EneWp/3+fe46e8+nrr0907NfXt7NeNzDNk6aamUlOnq1LXlz43KYay/eApAv2jMTxDCe4mD9EyYcmPzFM6xw07ni5MtNjazNrY+lv3SRDu38uEVq6zXXRrMdQtzDKfrF28+30+njp+Jf09NNnWZs09W3dppxC5M5WM6ivdOyJ584HXSJ73AkbWEQ/RIjKZHTs2zM6xxtbZe0f3WOYY/sIpjiJYw2TEaRJkR6R6o3TOkfyP6/lW2fvXiH9PcQif2d/i7uhcYa/h2Gw+p7QM94HI4RZ9KO/Izi8lrvj6JJj0zGgV200HkcijzBcyBqnEk+rmsk1R45fib6bIJoVqw9Izqx196lyOmmvHm1jqNZ+RydvGsotfKGMdVo4Xy8BV+qe7oQeRpWNInSN07p5Trxer1sVC6uT8z+T/MAsmzSUGPp4f8A/KhcosQprJK2iMBO2F7kkJ8j5RBE2sNbG5F2S8/ttZXeoGKp5xmfPEve4J6jFLl1Q9vPp9OOUbeMmePx1PHVUYHCVmroWKNmv4zxOUMvaY82VyLobNJKetKtkmI6jHG29j6tjZhvOVZUOmu6F3MxnPGUCDdJbDOr9ePodmscZRjVr8dZr+Vli42VWOenHeEbmqQssJuJXF7w+wt4Sp/dhkEHGEsHVtFVpnnbZJyvueWUrlw8SdXoVsOIY9YdWobR6cTsZ3tddOMncvdece6tgYVXXZ6aLVjG2L9ifFKXo1gJYxc7SnpnrpMFHCXVlJoZBua89Pt5FMp8RFPOWM63FtYYd98RLqh7OeyQjWO7xbUnC0sbEYWnSmiLKhryeRp3FWYsbljs2qWswU1uxp9ed4jEcNYvFJU2zlsFkqWVM6QvwmPxy8WNjE7VSxgMAar1gtG+syHluLmW7JIkUHToSCPL6DdEDaxdzOIzuZxz+6zoJs1a68cO6P4a5meRcUrPu1FHG/8A6RmQZiN1SQrUy8n5nCvc1KJKr1b1+4G9SpYO3vTzk9MPiEYtNd+MwVaoL0e5IZOao9CDtlasLsvVUs+GFqSR07Et/idPthjUiqAHIeY73Qa1Xhskm23Cuq4y9pq0aeTiiYN28xj6WozIFj8n4EKaauRQ/cqcQEe7DwR1G17LlqPKWby77JEhhkVeiIbd0xxVpVqNdFo/IMYfJQpldfiM2Pu4g65iUQ8hPxPtZ1jvTz73GSuR4fGb6fmiqV6GY2pT8JdSXutxOrIjLkUAoJtG4/ZNjcsZiNePMK8NRrY6oNTyTDadF+Iai0WPyGdtXqu9S72J65U2pmAZBCa+l1NkHMCNKK15dYvE3N+QdiutXfYtGZUhrYhYUlJ0KWD0+6O7T+WSgpkRae2ZHtj5teXD1xaszZVExASHdlmnKJKF6acDsrPLeO8NFH3g/eGdOY8+3jpQs5brt6e0t+sejZpu14EGpasi+jBgQyX93WO9wRGhoQBQJyayHaRREiM6xGkzE8D/ALSz3/o+xZz9PLu+riX7bPX622C6c+F2f8zbpu/Xx1oru6WmvU6Z7NPXu0004FpKYKj5C2QKFlPPkJzG2Z5cAE13wbOaxlTIJn9wdupfq4FbUOWZ/QE1lEnry7kTHe5z6OCJldwCJwspNZjoyY3QE7ojvaejiGPrPUBcoJijAdfVrMRz48R4Sx0NNer0WbNv727TTb+ns43qQ5gb4XuWozHqFptDcMTG8teUcMUupYYxM6NAFGUrmPQcRHKeA6qHK6n8PqKMOppynZuiN3OfRxDLFSwlZchNqWAMz6I1IYjWeJKalmBFXiJKUMgYROujtZHTpzp29n/CPlKL/WfZZ+xnR/6XytoDAxz5DERHOdZ5R65n+X2gMCMdgjEREensjl2/y9T/AJsf1TxcGKNfw2hT4jZHV6Yxuk93W7Y09XGDhLCX1Onv2/WiIVyn+z3uMh2+IOmrp7JEWTG0oZ05LlB8g4rIOtfHbdVK3XZAp117wQeu6Y04rV2npVgknIaRtlvPYZz6dD04uE+T8JIexiS1X9IOnsHXlMBru/Twvqfw/HB1P7nUjd/4cA1aL7wlUCA1yWVOQkdNOnrGnr14s0Poiu0D0jP1a5u1IY/uju/xcZTSZ6iq8V6mwhFmxe/r9Ei7sFLdNJ4o1zq5AduSryt96QKdd/eCD13FGnCq6o6y0trtXViIiGM275nXTXf3u30cV8i4rtdXj63iaN2SgNN0AZrUU93Rcz+iR46up+6vD9u7/bdPw/q+hv8AEc/Xt/RxnrFKYCAvtKsUQM7AIlCEjE6xyWXLiCxpsK+d4zvEo4B5biOdYKJGdZHp/q48u+Nker4axznbtm301ac/o67/AKP9rTjMKdSzLQeDNXWjS2mpmswlqZ3dwOoQ8o9UcuXGHrpZ01WsdEWIGI1aIqRAiRaa7Y3z+3+QxgeuqDft9X/9T+hIIZkSjsIZ0mPmmOfEiVh8xMaTEtZMTE9sTG7nE8BEsOYX9CJMpgP7ka93jqS1ksjsZJlvj/za68R1XuZtnUeo0z0n1xumdJ4E3ybY1HfqUychE8xgpnXs4Mqi7hPJcqCbTYkEDOk+z0M501iP2cdPefT116e6dmvr29mvHTCy8A/cFzBH/DBacSS2GspjSZAiGZj1axMcuN4kQlHOCGZgon1xMc9eB6tl7NkxI9RzD2lHZI7inSY46stZLY09pJl1OXZ39d3LiOu9ztvZ1WmzT5t8zpx0PEv6H+j1WdL7Pds4JQsZCz+muDKAKeX0g12z2cHFyMjDiOe/RbC4NO0Y6TIlgct2v7eE9JU169VUJrrktSiI+tPqnSIj9XHSZctMV2dM7DTX/gI5HgYa1jIXG1cGZHADy5Bumdscv+E/JERjUimBGPXM8oj9vCUx2JUtUfMsYGP6uBrXrFijj3TVXiZXVSyhknMUybFa9dNLW1b3Wj2QbkiQxGkmUyMeOfirdeq2pl7FJhuqlNpmGVYdYr7FtI0y9VUzVMxoQjO7bOkShNutNdxVa9+wht7HBZRUu2bFen0q82epdtGFeWMUrdKw9MlIwWWu42q5aKbGV6+Q6tbfZsU8mqjZGtWKS9kbBYAmcju26/RmCloXK3hLy8qGJ8NavUkV5c3GxllvnINaNcKvge2fpwyNkDMyO5lxOPt2KlbDxnbzhbV/21ALN+tb2j1iiy6vOPMohcyDBjkXZupMUdqtjN9icrfx9Rd67SAU7qzPDNTajwfU16xiphjERyiJkhtKa9dmSvU6tE22sfQqGDcHVyhv8Y5i1+HkT117xSbIEY05xhsipTSTmbVOqkZ2QaSt7/4u0jAukS5idszE+iZjjwNTF2LdqbOYrgAvrpGZw3gesZG0ogYdF2Nnb3o0nSJ1jGVayzgMrh6ubrNssVWJtW4prljWrmUtttQK468B/B6ga9vJqwoWH1a2XxOEtXRbXFar+XfjUpEVSzrNUn3orqFpyKdsROhSOTMR6isfRzV4JVbpOa4MFBzbhtZDmWKXXgJlEsjvhHPbOkTYGxhri4oY2hlslPXpkVKlkLuSqK1EWz17C4xpMMAmY266FJREF7oVtI5uXscBjbpsd43Gi8rgtoLeVytWHwrBFpjEEYactwSdXCtEOpcb4dZrtV2OW+ajLoeIpCXiEIapJQJz2n6Nve4i3XpPxz7uHo5zGG8q1iG0bFuihu8VkcKcEXA7s9onE9u4R/ozGp01jxS2FHrBHtzj5ti/+C7b23GwpybK6hWm+BCzXjRL4rxMRuXpugfob+/pu58RVyTHWWzVylORG5YZVrryrHeKKmDYDpualm3dMahzgdBmdVW1Nt1bC69eoZ1rBLizVqmxldFpc7ltFRuOYnSDjeUa6TMcXU77gVL7GPfSG0fhIsvtDdfYSot3RY+zG4oGYHUinTUp4sWJ8Quy+6nIRZQ81Or3EUIxgNrkPIdaWoEM7gOCnWJieL67JWXe8sNOBtsN3tWUS8Xr3oGNHT40+9wIMs3kBEMAxp22Vest0QLFt6fPnEcijQw+rMcSaBfUb1q9hDqrzSyodXHBiVRX01HpeBXsIDgwLtmNdNFU7B2J6DKz0WRdI21WahixFkXx/nQQ89dYOJmCiYmY4XaT4knrZkW9R9hjyNuVmqV0zlkzJSwqYzHoH0cuXGHECtGnAoroxldlgiQiatFmNU+Q0je+KbSHWeU666a6TAtRC6tI8thcvcMcnc1tWMPYpWQMsTFLwvWZ7vWnd19sr70jvEZjJ0epcjH5WtkK1ijFoprLHKdTxpVROCKuTCaUxpO0Ne7ERxkieLJnLY6pire1kjrUpNyDkQH7hweTbrPp5erhtiu20oXtdYbTh5TSmzYmSe8UFu6ZtOZIoGYCTmS03TM8e8tbfW8eGU6UW3eF94BR92+Kmvu2SZUogNPo8tYiC1maCElbTGNxC8HVNNtqXBQUVIxHrKkGdSfABqWvONY9PyydYatKg+kxhQAx+ufTPG0PGWI106iURs+f2zEnp+rgU17YjZOJkar/AGLz2xqXTEuTdsc52SWkcHYtPTWrriJY+wwEpXEzAxJsZIgMSU6c+CtWbCK9YIgjsOaCkCJTECRNMhWMFJR6eImJiYmNYmOcTE9kxPq/nfz/ACn2Zju1a06T6mPKAH/2xP8AnLFCU+BqMJSFx9EyGdpvn94mT2eof18RGnP1cJRRZMTUdFgrSSkZ8UH8LoMHSY8Lz78ad6eXZE8eYmWpicjQBFG9OkR1WLu0TVa2xpEeJScTOnLfu05cZSpZ8l5XH1To0gPIuvYtiFCNmpIsJSbBOmGSMRyj08IRUveTKylYupYCtmLt9mWyByiSJCalEQinu2bQNm4SmY/TEYCh5Tx2PHIZby+HmS4/OHaKhjKRPKnCdtLputPO4swHSR5RrppM7fOQ+YcTjl3vLTPL1SqihadFa9azgWJFrLlmNFVNqobGojIBqM6lwOKu2vKmXO7i8pdo2fLFq05Va1i6bLp0siqyw2SLELnY0ZDdtnu+ryt5gyeKwS/L/mPI0cUSqr7pZaq26ZoXemWTNXwxMVJdKIM4DSJLXXT+baer5TbUxzuWS2z61Ijpj/7u/wDnJAzkYGQnE9sFE6Tr+vhOGx8Ey/c2CcL/AIgA+PZoD1MsBOsz9Vf97kHUTK1AXhpsM9n4u3ESViayz0cdVExtg9Nk6a/X04874onnUrZK1jakWxX1tjakRYdtXJLEpjuRPP08XPLp2irBbrV682hVDSDoNS3d0pMInd0fX6eMxfxXmVmKV5hpUqWXT7pq3bRjTqxS1o5BzxZRhqB5jtZETOsfV2+VlF5nyHl7M4zBuxi/M44Ar2Gv0PFS73bfrSbwF3WOWLHf3e2Z1kOPPti7kMnex+fu4L3X5gs1Ro3LVvCV2nOUqV5WoQqLtPgFDsiOkOzXXXR7Mv5o95CeMtY5KKuCx+JRE219NlyzCWPOzZGI7sjKojnHYUxx5b8u+8WbPLuRxmQC14Yd1qca1rYUSutoqG9Tt1nT+eaRzmeURHbM8U6fpQhYHp6Waatn/wAzJmf5y3K49ROQ+epaSuNzFNnmbYCOZLZPOdOydfRxlcmba1aBuXFlYejxNlSoeQ9DG1iMIOwShhcTPdAfpSMcSvGVDaX8FIRu8Fiasz/Ft2NuwCn6RT2mXZHYPA43By511LahvsqTLH2G2b9WMnaFMVMmXdqke3RDyABjunMaTsXXuOrOfVNN4aE+LRWFdBeQTZVOEhuu5pMS2MfvL2kSnuCEs8QGSXiyMYi2vE+Kuioa9jQ0oDAJsrkroKFsnRcRLdvBK9hiLysDkqEe7kOqCWGs2B8QcW5sA8aPlbImblgIaTvVtPSei7mqVWdb2wYpMGqrFAzMXBv1LD31XNXiLVGrbx1tIrAiQpJAejiUU9QLAou5WxrT8weE6mMqnHjKt3JV8RM+B8sPUyHVEpbIsdVhkn3T0nbxV951LWOoMaIGurTlmwq50qjuo9eFzW5Nty7L16+HHomGrg05/wA7oE9bGrG0qemrpbjOJ9iPtmpVAk7brqURpx8Fyf2uH/NuPguT+1w/5tx8Fyf2uH/NuPguT+1w/wCbcfBcn9rh/wA24+C5P7XD/m3HwXJ/a4f824+C5P7XD/m3HwXJ/a4f824+C5P7XD/m3HwXJ/a4f824+C5P7XD/AJtx8Fyf2uH/ADbj4Lk/tcP+bcfBcn9rh/zbj4Lk/tcP+bcfBcn9rh/zbj4Lk/tcP+bcfBcn9rh/zbj4Lk/tcP8Am3HwXJ/a4f8ANuPguT+1w/5tx8Fyf2uH/NuPguT+1w/5tx8Fyf2uH/NuPguT+1w/5twfvjC4Hxms9T3k3yZ4nX07/FZbq6/PwHunCs8F/l+7m+X/AAvZH0PDZbpdnHwXJ/a4f824+C5P7XD/AJtx8Fyf2uH/ADbj4Lk/tcP+bcfBcn9rh/zbj4Lk/tcP+bcfBcn9rh/zbj4Lk/tcP+bcf//aAAgBAQMBPyH4CRIIIkEHfAu8LPt3rbn4w7pMe2Zz8uQIECBAgQIECBAgQIECBAgQIECBAgQIECBAgQIECBAEHaDsPdAfyJSnRT27uWyUP4VU9fl4O6D3gCvEz7/972UrKq2tnLm7z+WPxQADk6n4f+968G1/rTjowp4fLX4gQBheL9//ADvW976nwHOOrHWG8rMpAcWN10El0kZnKDMYLyJDbej77MiZCgwW+5P0uL8ooKIpFB13WrcWJ+MFs8cWWDHm9TzPuidn7BHDYTDcqJ7HiBgH4KhxNF52Xr1V4AtP/fovgQYUfW5L0blIZtL5aW65atDqeN0JHTyWEneOR3Dg11oUHfqF0xsWDy4hOAAddK3DpzeIWOP87uVBmReyItsCsvVdFbsiDQmDDHClRGNW0MiZWgKwrx9lyRukrnDOUKhpNJlif04F/VV1IgmeaU45dFkIK5V+xMGGpcwYSeVxURQF+d+qAWzu1/7382Eu4iEilCnsOeeN5C3QqzeNHYaQXdBsKIdY1zWJcIRAmTZsI0zbZbENGbn2kcvJGP2LZSmKkhWgDjugCb0SVnN5rmAd/CRyqFJu2vRZoMjnTqRg63Ednse0aq7rGmWJoMjnTqRg63DUcCObRSDQF1dTwlcBKvCurz0gEcraCQUjMad+aYRgFNoymHFEcCWw5C8YF5GNzHbcj1YAJaTevhgJ9sfvvM5NAZ2frg4W8y5HSDd02vg8rGTbT1UU2m/Y8kH5Br1cBINiINpyGTn2LbWxBB5fJf6q0k0Kwkiq4cex5rpb59SNn8ZJkEZV3mcEFk6Os0Yo2uTN4CpUCPPOXMgWUW5cU001wxDVpEl/DQJ8qAwGljlC8Eg8rytLDlG65kIh3ay7UYIQLwJndBQNQXkKokWfZy8ZtCQgoUBl9iDLi12yOt/Bsuqp2qBdRAeDPE+FEorEpWxZs/HI2VMHJDoE1zroxTxAww1Du7IQC0YCerQbB4AK7sfTHmYdXJcVl04cRP4iCzDYALE4g7zDQeZt0SuuyhCuCuFjNaluqwCacwSbLKO0sG3aagb6wgDFiNRApblsIgxQME6ha2wTWKYzCqErda1Tb3dMrstmLdKBlpW4xBQx8iGvFZVQltvUBSxkWJ2tlvN1/U5ZEgJWztltvUBSxkWJ2tlvKNOYg3kbnXZ3B8ux4Ad7PGYgC2YR8JLzpecS5gSGFDFQqJh9sJK6cHkPBsj5c1BHsq8zzAYNHX4YCfcH57xuwR6Ap9DXyRGc2o7qgRn2wwGgRC8goN8gzKrmNXHVRxLDbcLyCg3yDMquY1cdVHEsNtxQNrErZ4Xrk5qXajsu/POgkJbECnI8nrLdSbzS7aZPWJijsbtV2ra+GAH0Hg77HiHeChqMkaBbkWUVDd7wY+AAzVVdVlwpIPFmL80otEWQLsEcnca0gblwArBV9ycsOROFA79eUa14XxIZiGHZLnU8FZ47K9zZF9YouERqmKvB3VO8J8bwrEQjCdhKGMEBTqS/DYEm8vC6Z2HmSIyPaExWLEDJR4zwr0x3DB/wSg9zlhyJwoHfry74P4U1SLdDbEzOlkWvQRi4gSAFsUFXhWl5OLhLzQKAvZU23MaNvB3UFQddSo7AfbA+ALwuRMf8Eqwig5s9Eyc5fO6hIK1uX8UHTBkbjDpgKFhR1g80OHDMdHgpeNkmdsYzACTcVjaICDZslnAh+SDBehj4IJ9B4O8WlTSgeFMy+pZLBBJhzNhhyO2NaIZjBAfMW5EIItWipSCOFU8HlGwFAFxalSgiUVlNUJ4F/BZFwwuTUXdnKEMiOSeSVqBs/O0jBHMDsUkyHXUpMJFiUNd80sAAEdqWtA8B7FCVTQLuoFnbSZ2VAYTcsjHRwpqZY2sD2FRIOBlxIaTmlMiwUMojbAxaTOGvcUNlBGsNP6MUXqhwuOU8lGOii/CVAyAIyajzrUurm3UeaJUIxpYiN+hYFo4/JgkhDMv6zJwwq+iIq8rdwAkvttLzM5GiZYQqC2dpQhp5MxtECeeq1UTEPV016MRh5RRxBUKuy72hHTrN/stEphatFIWHk4nEXIoYOE3LIx0cKamWPfc+/wAjixjAhLUCdAupRjyjOCeBQFDiOeIpzsVtA0roXbgblcOOOLr8zsg34sKoiYo50UT0pYzEcAl4qNShs8biBnNhCspcZrJ3cWkANXN5gbnWpZVb4p1ZxofNFSxaKhthqGrLqxB06LS9GiKL+CCbPM/PeUwqX1v0JRi8lKH1YS2cxvA4guVvqM405AyqH9KwGiyxBa8M4OsaarUpc+C2QGaWKWSDYeuBxF7NBEsVBstD4kwhtfqXWOAMN2NDnY21xlArtZQPky0DZCLjXRCJtHUjR+ns5Use2AbdDzYDSjh2JIlWUmPdoueUBqF5mxe4EsqnHqYw6zZ9MZIWtwCZLiNDwzuOPLVXJE13JRADCdcABGZWHUKWJsx8KmLMA6BDbX2AR03KL0M0Rad0aO6ECctgxZBtN1XuoXuSqLwzdhXpRwwEzkABYGFHxkZ7bDuqAMCAY0BjSUsjTzc+hi3L61QyM0n5VAiArHjKxHjDnSQtVJlUw3tx0Y8F3tTa5iNl1MXN5bPWkyW1qlVI+QhXgrio40jH3y9oyHLKqDhDKwoI9IMNdGVaohUaspbNtyLOPggn1vJ72JDe1kbzkLrxuF64kAOPhujn4ND6fyhOdWWKUTVegOdUFlvoCPHxFKUJIfgJA1mbdQvad1kJivUqJFYoDTaR4D5mh8DJH1xNlIpFIkCOMMBi8ADFqJG1XIgNsyg6XSychr03BRVsIqHKQrJZzqqUVRj507PqX2opKtgBOEUfZLU+Sj5EKl1pYuJdLoWtHRvA8FiBpi1h9eXcfufHQg1MdVfxrp3QzVrVK4W6NQLHLlmozh6SOoQHxwtgTogLUPcUJHE+h7+aai+hiK4CLkQh0A3N/jA/hTVIt0NsSicF9SxjYu7j52EEKuJwMMZhlRNLc6rBrVXOeG+ihgGzWOYTr2HjExyG6RnkBdXSGgs8vKFpwhuIEfF8Z3xzBxk2lqS3ivLojBa6LkBSenhh21p5dUA+qVCzHPQCwdBtnECppV1bJ58qY+nhcFaUYYYNsRQvkRXKjcuXcqMpA8jZGNAxHpZ5zTlnOMuNkJioBtuMs2yMtogBYbSDGtyrAGy1bqx2Fr5/rvY781zsF/j3qSOoK1noC3L1X44mxmRZVQAtX/gclrz4661ql+sBAU4CqGPOSzTKwA2MI3RWXBWcStogg06FrvWzx1DlaXFBhF0N2gIpE6ps8po0Dq4nsNN8L75VpxHQKki8lcU1MfYPtkmGLqNO4GkAVwisg60BV4l62HTdx229bPHUaDUaRoFiVSuFbcGCGlCoU2MGZQBUvhpxZeLeNABgSQdwL5FFjh8dYAsvSKXi5mUGRWbuRXw8DiYAjgIFgNBlAMoYnYawqKtjE27DxOh3sC1gfPx9fklGe2w7qgDGouPnUggDkngZuwdlNDVQdUCwUap015zR3MBV1hReyWG9ieiwgtw6RPW6OUMAuqha5J9DFuX1qnGlftivti0oJ2IqUUgwGWXiVBAhFJq0LFrI2EzBlyA2EUhUU1mfVna/Zp0aq4TpwPSCstYxtgC4bOI63K/QF/5KmdIn3FUkWphKAWg5ZjvmmhxgGOkwjcjkKgUjBRjsO/Mr2x3UiFhtYDxVP/AuE7icZFLVGS1Oa6nNzSUJkWrE0SWJqYOaBBeCic39ZWyq4q4kAhN07uZkmCuQhAoc63FETomzrxgrxRjK1jGaYGqkxaNLVOdpj8nBOs9jQ+zUKuUjElg0sAVVgnlNtuvjB7S0kUOZU9GKsOYrwV01xO+FZebiJLA3J0VnmsmuA6q8d0XkYfeKCIgjkTz+zh9lLbDz96GZQLTkP+oMYou0XYewo9h0L0F71uWuoQq8S34dlOeL4r0WCFrMMOL7kY99TsQa9wOwBA6RjMcgqDzKO0LmzqDBS6mmcijBQ8FcEuzHT0bjW5yYxBuJ6nYMZl2821gCI4wsKDLZEQoFQlJyii6eUIyiUSEBOY5ZnCUABkZ0BludFtbBXIy+v0UkYwJjGTbT1UU2m/Y8kqXVME7Bxs5DArx0VAm10pNwCsBQnrEstWasJH5XsohYIwDYYXfHc13d4BcLMBtcErUDAe1bZEfwKUmvd59QDRBHKJAhpEWMtQ1Bd5CcKC0VICZyAAsDCj4yiiijFF3Ao9ih+Ku8tgD/APRj/pFrkSZkWYAbPAeKxMlAC23RUXVoGdq4ylVs+Qs36fwZjwVxWAAIYdY65a9AiJvmOYYtWnCio9DLU2WaRUeww1yF1aVEPS6hWWFxEZeJnXNgGAMyhw1aH8A2pLgvgmLFFFFFFFiii7S4dD7v/O9ga+oOhf6bBHaoOPiBBCtkowJ4pgIZyZwh3MXGliGouIivtveD9zOBwPCCAQgZRTVWq1GpydoWVKsmoqFqvOKNRNo5obQXgJhmmS4MJY9PLqJkrIkgaplctDpRaox9PwViiiixRRRRRR7C/sVj1e6CBQAKhoAMqsMgG2Bh+sfdX+lYQWSbKjla11qpV80VUefkoHFureghatTeM2zUepFJF+ZUxpFFU0U0qvjGClYoBZJ7TBo8afu0TJNyoRjlSu7bgbBpRj7CZtJfXyYYWqwYDWjKcEGS272n/bge4/gLcblo32LS0tHuB7GTXr4He5zwCdtqAMhq/wCsECBAgQIECBAgQIECBAgQIECBAgQIEC+ryZI6o5BTyLJyOGuK+CCBAgQIECBf/9oACAECAwE/IfgCDsCCCJ2gj2lz71wv36FfW6Hn4/LGCMEHwQAxKa7uU6Xej91j5aPigACl3soW/VZ1+WPxQADg968nPsh/Yenyx7wnvgHA976eafJKooVreOV9CJU4qR4Tp+gsU7KIn2N+G5kZLZ6g00xzStsRTsoifY34bhHEoTlrAxdczQJWXW94BA9NvnGHR4P5TC8gyGtAWpehjhayHHyLPYxuYbtoK888ePwAD8E3eCHsHyRaLvrWzPOPfHWcT1aLRrld0VegErlq0Tj5pk2ct5un7FVmRdWZc+srlq0Tj5pk2ct5Rw6sbDosunq3FwBs3sb8pvJAlI7rFjZnOl5xM3naXTbWN2XXuJYMRwGFy0zd+nNQ/JdFIsbaXc14/AAPabe8LYyLXmfz9vkgNUNI0nrBA1o/OLClK3nPZJu+tvzdTuFKVvOeyTd9bfm6ncUtrN5OXWtTNJv1AktMeM/pMO3RX5LhZbNfuD2NPggO35UqDtGpub3EV03Zmt6IEg+Yt5XKlzWFwWsxfHWeGhwr7cSocchw8KK+zjJGfjpOgdFY9Q9JzgUE8Fpvwnj8H6y614yxQlhim6aprnpzMr0q6y6VuACJpnPc34bgeeIKxSbMC114+CA7e8Gnx8kPp/Bj21bHxFIzTEbNpvyU8pS1xU6k84xeUE5V1BK5Dx73A3E0ozDxtplpHL18WFQpvTWU09ax8dZiIWM5fFL+2fjcRN6ZYnNF6F7p3u5bSSbVje4l1Fevjn17LwuJQVAp0uXTTyMvVmAVirK+XeKV3gPwTU5Ifb+p8kBqDSNJ6wIXMLfkz6zxHXk5da1MS9q0qumZ44lSvcgbTBMPJuyX2asCd5KL09pc6lL2jnbx5bVldeNXAdKuoIZayzRzk0NvuwLriqU8lcTw5+R7KkSBQosodC+O8B7T83e8Zo+nr+vkiDtGpuW3RQWHQLx9Y+NNGboYyeOoWo2rNl05XNcKiC+XX0hM/FFSlg2bRGuiM+y/L9vohaekG/2NX7r45mcCt8Z1uqrx1GAnSobnVKdOnhgiu2u8ir9E1AyE+xnOMc4gVEtpGWZHDNbqH01gZfS034RSjFviOt17teMwcjUmKrBVrKNtkaGFMF9KGHwn1nfJD2TUVARfS034QjLuVEONkq9Y0eOw9He/85H5Ifp/Bha6uljLbcsfxAUDS5DV8MuNMrWdpA8C5wYUffErei2Ju8i1pV+HjqHrpRhX1BeAIpF3vGBw9BvfE+goz+0TTCBqRXLHW2uKah1Y09UT0KSNJ2sHIDi1Va1eJasJvl7C1pV9Tx1CsobCvLOppdRWyuaUyG46hhtgzNB1T6My9SCVDVUZEoNYeOkGOELm3K7G0yrq4uZlW21w/hyw8LiWBf8AIHavZdZUDKGBAhAxAE1dGg6vYXe8D39z+SYNQaRpPWNHWUjQnRzE3dRVfo9IOaGrPuu5R5RZhHwtxLKazJKDkt8NRGQGFBrjgsHWaZJ4zrycutanh48HsGo3VCrRV5kDiLYjT77iKWd4AmktafKWih1tNbXKvpjC+Vmp9Nw9f4Q0IioXno6Nw93RQoMLiu17zUu3Ft2h1ejgKzgZZiqH7oUhiQoJR0s4MGDsO13QitADquCaC6+Qfp8rYovYXYe+AqL71uF2J1/bN/6duc3A9XrwbXBNyjowg8IgsHyHRppFGkvD/hUUUUUUXYXdCjz96kmR79Pt/wBJ+No+lgvV4PFTxV9MuJXKlfnFeq81cTX7fHWKLFFF2FFF2iillO9QnNrxx/8ATNgji3Uc/eLONxdAbf4/sUly2rocX4+H8hPnJ++PjMUWKKKKLFFFFiijoiyd0EFqGT8Mbfq16/6VljW3wXZfKrtlVKGSjiNFABXTnx4GU2Bt6vQfVcu2Yqx0dA0fXPxm5aNy0tLdpaPdDg94CAWyKJbwDigrQLVX+vF8hq+2Jl/fb++fg//aAAgBAwMBPyH4BCEIQ7CEIQhFXef+urv+3p8tOwhCEIQ7CEIZO716Oedq+/y0hCEIQhCEIQ75/wCnEHywhCEIQhCEIQmve6YJ+gcvy07CEIQhCEId99Ja/kgyyjcPO6Lge/6gRW6gjeYVxKY68ueLzUCK3UEaC2loX5dZZ4fdIwpL8XgPOByzK8/O3HuSt/JlB7W6+88bljcIQ7CEIQh36nkNfZf35Ik/xHHGfadRalAx4dL4srMvcBkPVV+MV466S8iBUNVi301L3AZD1VfjFeOukpXILLpWPrrEJQ4RqOUtVydeE9/SbcAfn4+HHHrH5S2ubgeFffxlZ7Wto8Na4ghDsIQhCHfvCH7P7+SUJFdYzbL0D8Rq2zoP5n6XGPLp6Rq2zoP5n6XGPLp6T76az7z7Z4fzAqPC0V7amcLwCvbUMoN6A/EIQhCEOw7Gr5UItjazAfjQWalkJ7UjUasRqg3W6rpzPFLa1BttDCjPxbr77i64LQZeDz941gS8Bx1xxLXXgL9omHN7GL1fnxL3m2WPeXQ2bsP4iYwQoNpsK6c9IQhCHYdjV3uDn5K3lFqPqwnIfQ1r/kVWEB6FNe6VGNoLuuw519mbyqq1n4Tov96wd/n4RJ8nH0v8vZUHFpcDNy8/jXSAyMtPWj9sK2/1R4XXrU1ZWJo05K4xvp4TJwoXTHHvDsIQhCHfg6sX3f4+SULFcMtA16YMeXSffTWfeDeSBX4nhyNLPvERj2Ap9JWbG7HCqoarM6HVVAHB9uOJ95tL96g0LJlrPvviPDnsAz5zxV2A/YgCALwB+IdhCEIQm/eu6Nff+fyQWxtZlaHnvNeUXVK1OGHo+PhELMC8ivfUaGu0Rrz6QwCLKDYbcTd57i+8ahdquT1a9PWVWeVL9o3f3WKeZuJRbVKPNvEb7sIMefT1hZ4ooONXjjxioi4BftPxWLvpV78NzOwlEDRtp4Os3CKIB8p5SmGvOtesdFuwF+zBgXePN73s3Ccu99LsfJSzs2N9mKr+oqkrVfH9Yj6gS3YyriLHschOMNaIjWJvnqD0uKFo4M6bt86r7TzP156TIy1SL31+3/Zyyrxzg+rUXJW/CltYjNZWS9gHOg1hrR9eMYTwWLV7Y1zDe043qwDea8Rrc4ryP9Na9L8ZQxQhblBN+jMpGBALNBxk37q5ltN6O7+81vzXBDsYPAgy0OXq5zOSyG8m1Drg9od+8PF8kahYrhiQEPB/IIAbMGfPrAqfC0V7S9yO6B+JVBWmsYvrUIgN2xnkPH3n301n3nimhC+9TwgAg/mNNi+HUtQUZoFnjRA1+WFe2pa5jdH4Q+0w+6rlQlooWeTuMizpZVnJbivaJxvVjy/PvqeBCBPuFxJTq2gLfGtwhrukWMFsbcH7m/lh2EIdhCHYQg73B7YeeP7/AOkI0SBbM+vpl+0+8S7p4nv2wjYIpSf4SEIQhCEIQhCHvKF/gbfu/wBIXFdeQcnhDnrl0qy2wirLRXUCdCI22MVCv3zgGnxheNGPjkOwIQhCEIQhCHF96/mHfuv9KwtITyhFlqF6AeZl9EgUxlyY56XLUpTXgwRNiea/o+OEIECEDsIQ7CEECiu6oFuojWkT8HpQ/wBIWTaA4LcDR1K5jXN6jt2pL8TA2EuM0D3Oo6rtaNQ6Nsut/wDgdAD4xDsIQhCEIQhCU7yyKyYrC3z0slZvX+vO89+dtMbyX4Gnwf/aAAwDAQACEQMRAAAQkkkkwk5NQUvttpAAAAAAAAAAAAAAAAAEkkkhCy6QekNttAAAAAAAAAAAAAAAAAAkkkknCgzLootttIAAAAAAAAAAAAAAAAEkkkkjEkNn3UttuAAAAAAAAAAAAAAAAAkkkklYaGr7kltt2S2UW2SS22GCywyUAEOWR3QHA8kXfttugwwgkEwAkEEkEAQgAjqijL6V4ccHdttIAAAAAAAAAAAAAAAAEhppBnsKFjaQttogAAAAAEAAEAgAAAAAmBS7T6WQMaSlttKSySy22WW22Wy02AAEqcboOhFrZwsttvkAggEggAgUgAAAAAAgIGJ2NQ3kQ7lttSyWWSSWWWSSgAAAAAE15Y9zMx1gkZttuAAEAAAAAAAgAAAAAAlZLcmUkp/y5tttAAAAAAAAAAAAAAAAAEGIkhPGvuaR8tt/W2yym220AAAAAAAAAkkkkdF6rkLQ1ttEEAAkGwkkAAA3kAAAEkkkn9qHV/b1ttgAAAAAAAAAAABXG2WQkkkkUXAWN4rttuAAAAAAAAAAAAP3WwSEkkhYFTjb7hdtrAAAAAAAAAAAAF6mySQkkm2NQ719D9ttwAAAAAAAAAAAACoAAAH/2gAIAQEDAT8Q+BdMT4Sj0/E+jwm4mz3/ALP7f2D6+vGDfvBv3h/sG4N+8o/Ir9z9r711v3RGBxGCoGkPyvnz58+fPnz58+fPnz58+fPnz58+fPnz58+fPnz58+aWQfyfa/DPo8IP5B9p9r8QfyH7Qfb8Q/yD+QfyEiORFdK1Gd2h5pP13XS2ERI2GQuSz5aG/H8wWfafw9YN+P6g/kH3/MO/L8Q78fr8wfc+8O/L6/EG/eDfv9ekO/f9TwlQegv8u8yrScQtmL2Wbu8/LDiDfv8AuHfvBvz/ADBvwg35/mHPrBn7QfmD9kP7IP3B+H7SrrE7wotNNjQPsVMUtjQIHyt1DmH9n17wfiDL4kH4/GYId+c5ekO/SHL5/mD7MH5nkYvYPeJYacOqp0KLzDzXHkPg0bZSaUcYsf34QGxkZ+bfsSJe18tlyMGipqi5yC0IlELPpQf7n5fbcwJe7wtfYfx2nVeVK8OaIpEoUl/5aob7QuVipkZFhrjRKCm0GHRyvyYPPOV7eEKEHK/z6Vxvd06u6FwoK2HBTnO2IRMWGYTeEDjX2POP+wALSjvBukJP4Y3fVcg2EWzzO7kpSO5VwbsyL50xjIYcYZ5yiRADRBx4gM7P1Mxyy64DltXFN00DTZdPSlCKJXxtsI4IASCCthSsGrCVFo41+w6UTPsa4OQCA1fHaWYoGeQm9sodrTICWHc6P/cumMpXfuGAtISnGUJhFTCTB1sRFPgMgBCB1VVIGESkaYycBtAAO6GogaiDiOKCKKsuVE9XgUgw9gg2C7ASgugqw+NWxmpQRkmoy0BuxKESwEoLoKsPjVsZqASUIZg4ozEGRiQSY3M4yqqm7FhcuDLDYwvCTOAKguxFBKIQcLYFCiSkJNudTp3ElUCxFT68SR+4AWqwz9mCD81NfRn6/ufpP1/cG/SDfv8AuHf19bhu/UfYfvvInfxvQCU9AUcQ8NjZDYIKuGGGWbnCdwG6ZIW3ajV5VUhIDorUAyMhFkKMY6ki5o44Iksno/rz/O4odXmwGuWPmzvZYRVCIdhjX1LLqCdSPGlftKrYTCXQAT1odyV3dQou4YK9JTkuwN0AMjzwsQiCLVYVe6D+rDW6lfwPkHpYRSYa5jV+l+4QMgOkFGuWnFMFnafPK0oYMdefOBkS8upoqEnfLE9h3fWHcdgrHPDiACtrA0ZdNxEl1SRBqUUAFZU5LjXcw0zlppF7aTyUspGcBQZIwCq+Sd4kEwUbKmFGot3AVvCpN/V7jRUNQYxqYalLgnOSCnoxTBEhBEBUMNUKOK4xDC430NJiGsumTG8er+SwLtM4Ej3eNt5IWhYCMtiwpMxvFmAlVzgCTCIwQ0SmJJQIUrASHiM6W3UJUXKxEYIaJTEkoEKVgWpSlcBbnbZLksPFMsI8+mmV2BeiP0s8t9mh+fiM1SLbJHlmPEYKW1XKVw2kVqwJJlNicvYKKRotSREoyhZz9PxP2Z+0P2Zp6M4es/Rn095y8v1Ofp+ofQX3P97xGteF1faLMvny/JMCVHZJgjOxIgNxdgEFeg8BFoBbboLRtBu4KItmE54l8CUUjli0Att0Fo2g3cFEWzCc8S+BKKRyxTNEFyl14tS2XrFsxCFUounBrMDGArkgkAHDlBNoNVIFGkGXKHv/AI7Cwbgut0Tl6fqfv+pz9P1Ofn/Zp6M4es09H8T9Zy8v1P5/PwKTb7qdrGcPhDCEpNUd0A2ij+a8b4Ly7oCSwDKRtd88pmbL8CqwO1XWHhnIByIWLtQ7fcU5goMPaMsx5rlgmWCFgQ2QytlTJosY1XYOa3rn07AC0YKt47obM4ih+dxiLmETAHy9DYYoCJLVdT7FoVfF0sUaFirsdCgFDkygMsPmx0UjEqK3krt9xTmCgw9oyz38ooqNbYzkJEqCh5bik4QD3jj33zBaUoQyBZkiFdSmCQpTBni4fQcI5QV9ktUOWE154uEtbSmiDUucBMZ1BrhnYsABIGdpCgWpaA4xChweKgoixFbGhWPUV1TtczkkSwpi5C1vCELIIMCJdwFR5/gJEa/NAiqLVFEOcG0JZU1z9Jz8/wCzT0Zw9Zp6P4n6fucvL9Tn6d+kiwqS0LLRBk4s6wfk0h+QEWTGWNaQKa4qhSHb6eOfWAKMMVknFuhgpuOLD+YqwWkJYUdwmiW7rLD8iiQc6CvBaWYA+vEIma48B03DuolsNJS5gFs5AQCr+5FCl3qYXiA0mBZSrJUEEVUkTJQEA+Y4vHM52+qmX5TNrd4imjC7UdflAyeW0zLatCG4bCCpJrgOogUaKdOPU1dM7KK/qxNnns7QEXbHUIjVOVCBaPmxsG3WmTVRDxkACLueaaoaqHALMzKVTAxmAmAj1/hGYUjx9kHR3LaB89w3nVr3iPy03peYBYxNrKv4C48smFNQQTNoygGGFVXb30x6TmyYlAQD5ji8fwM51Elw8IKJwFJWkSVqNtImXgHXN6nBTQZL9NLAkjToA9Ft4m+IFLRyrGswN5hblSItXV1PCKliILCGM6BI4rEau2tF62x9gKPYmhbMbTKglB4xWQrylUo4USHLh3yatpLimNughyDrcuF6Us2FDO+eWAQDBGA2z9v7Hz5s09GcPWfoz6e85eX6nP0/Ufqh9n87zzwLt2sKowGc5iP3oF7Jy6sejhRPgJEoOZbcgCfAYQoVr7QHQBnW1F4NbO4spbM6OR+KW5rdA5ZA/YWohyy2lphyMqoGThnbV7C0nTaBpAT9KSCzAOkgJh0YRnm8EDM2HEqMaPAa2lhM3gjGpxAqYGS9x7kfdAElsgWz13kup+52nfhZbIXmMNcfmkCPMaxpBvQVBWnhIhdQeu66aZsEDL/ryM9Y/wBUSbv/AAwM/wAqKWJgYKwO2+Xg04slCsQeLSwDdAWVdMNJgkkLmoccLdkA+APzjCqhEUR+NS3JG+AoQ7EYm7j0aBlClMUvWfuuGvxt4kCD5Rg0UQDQp5YWJCDRIoAChi4CcQLAQBaI0WRsmm3Ji7sUF+WOYnPR8FFY2vKYIAgNJA6kU6NFR+sQtLVHKoG+swCktf5hx2CKckaMYsHW62rijEC2sGZQIFKCi2L9seK8Gc/rmfpOfp+Zy9Jy+uYt+dfXtHgdT7Cd63gTLAbWgBai1AqDrmMih6DqribD7BVOoKJx1Z+HgSbcp53Ym2RBz9decWiHN5P0N6j6p/Kim0vTYgYiSOUmEQwzVGp8L/iJuIc2topcwUKpfZk252QmnRgNYYmq8rA7njrdB/sTEZHUkoGEDEf+L4VMTYfw1EAucyj7zDOYx0tMqrh6IjE1uYjOGFIqJPej0ShD66QSfmY/tTQihQ0OLo8TniI6CGQ5hRLB3onYPYX/ALoSOZhHGpRsLhOglZxFu+0L4EwLZB1+LlFFRrbGchJZoz5gd+wQQOYyjdc5nE9CxuM5I3LFDdw6LKvArUq4DjqAYKvbSreI2uHMNN7e0qykVId1xKpSnQOHVrMr+m4ltCzIwVhjcJLcDKKNMzb1mWro7aMWsukfKYoatEDaacrIEZCpr1qUVNl+WIBBObZKw4eEapLJIhWNNzZVAFChioEx2ptGUTi+aFDbIkONK23kDZEtWrNVFuQqQoFllLPICIeg4EDlIbz4NMF0tKAsEzCCR+SRT7ryrNMX7Zg6i/YB+e8iSKxcA2QpLRws633igKbJ9EoKrQuV+P1pmCTPAKjKr/gRLhbAAKsLGvOjEAhIasUSlix25GihqE76nTLQawcDDcDWFVlFQGA0AJ+Ra4Eiwl1PgLsjQNTNoUmotIzVTnnXHgxm9VZjNvE3rgYQtqSGoctuw3pWNAFIMahRKI4jV2YrBZQj53ipx2AxmgQHIq7PZsStDWMoJ/v3L9BbYlIawdCSqgGFXo6ichf4oIN/ARUmo8eJYXVTawuSGgHhXIDirnWC9sN8DfyJ3nJqhQHoxBw0b2GKzbVLfl+ZZ0j7qv4rvIlexQMuKALVnm3Ob+SUtyRvgKEOxGLJ9CibSIQRGmVd4xRY2VeKuh0mk14epea7RWE+4NEvbVVCWwv1LuPXMQLpMNfURMNC2TIbJ+64a/G3iSkAiAUW0xJYaPhVGnMwVFB4l/h6C3eSNsRjJ+MapSsWALaYmNgxc5WEEYGCa3BNxFPJTwS39gdV4I4knL8R8GjxKOHQhk4BYBsMClAsVLCZoKGFu25CVj9SGTkJiAjGEBQbVgCpKmgFYIt+f4lt8jy/5d2qMSWXsQpA841dtHVqwDJcEtBdn9Xk8VZW1ZJlrX7UdITNuJZQ3RtQEXZScnA/gsazlRA5nVhg/GkINeFN1j11YFOqdLfGQmc/CMCKW1XT6NSsukuIZAM0V3w1eyaskVOXCswiuoYYknHU6JlDKlUVAdsJ6S9YN4yPRCEErhbKmvLw4ot+r94NxIDiaeq8poCclcxCxvmn3UiaLo9TOR9kkAv+rqiqI8+U/sz+kUX9n9oo/wCxftn9o4v2y+NMegv6iqq7VXze7crTsockzSVira7KYapF8wMGWGezaimsDKxKYhmUFvYB0JhQbrM0jjoFEtMijTt97zOBqR9Yr5NTAQraMJ3ThgQtxRD2iWkXNhxeUEkotSDD57DcGKRcRRLTc/GNdTNQXeF79wq84c3hUsvWDzMHNr4H9cs3OE7gN0yQo+mbUgSBtAkwu/8AUnrux6tZnz5IH8qsQ24ZMttXSZMP1X1xF3xivLEhR6wdrAVCOLTFP2QDirwlNDHrWuyCoSFBNJcRDJHMz8IJMZQh0RhfoYQ8KFUh8AfnGFVCIoj8bZ4Sg+7P6M/pH9+wu+ukVxb9ot+39n1eUe/H6/EW/OpUuQHlt+x9+9hKLjys0Vn+m+j34iidQEQBVJCFNglAALVXBuH1SmCXOrVwtRlZkvsHqDcGAiMU/e44HLaQARM7I4hEEpugUyCUMoFqMzYILzOgKaDOwibbtbsY6LEIA+Fb6FUeeF8lCKontE/u/omz7z7k/wCE2exNntNz7T7Eovwmz2i+0X15yhNWPu/ge/ea2cUeJO2q/wBKTwhtEZysD4wN+nYiBES9RigOj9ZLlNQaAed2enOCyCJV450EEvh4tc0bIJtqml3Uj9OvEsXQyeSHBuSfYKEomU6taB3xI+5UU9EtFozgD8GG7T13oDNpfxcto761Pe/Up/Xiz/p59J/0/U3eM/gf2fyP2z+B/Z9j8z+k+rx4ji/sIFWgFPQP4RU9o+Rweh3QH/ARDyuAAtZajyAqGshjn+lhK0vkOLGJwKoM9dIu2TLTUySJBSaQUSFQdXDxl3It1P1mdEUEnLKFmLquxgaoWuAxt7fgI+iAmgxpwTTEUAHZM3Sj3v7haBYyR8WxjSz3P5go5mMUPvgH0eWpurfM8Dy1/Z4XlLfXWbMf8J4E2Y8pe9eUt9VuW6S95JfP3ls4/wDIsMt1ezqrvPTHewMGIK1hqt8CCP8Aqbt27du3bt27du3bt27du3bt27du3bt/eyn543VyXufVHGUzffwK+C3bt27du3b/AP/aAAgBAgMBPxD4HB2AvPYZuwxVBiDM4IcVDzDPGhn27y1k2txQXpa23mHV8rGL7I7JgqXEPMGYNww8wZg2Q4lhnUu+hruvcEidFPjCJ4Py3BBzBmDiDcGIeYIMQQ58IOIMTzBnvXGkZW1VLvN2rvN3eflhggxBmHMGyCyGDcGGdcOWDLKOsK9n/vey2OupWnLWYXWQ0CB8r0hzBuDEHMGYdwYgzBsmk3gzPWH5/wDO8iWvqmMNnHXizPW5mX23L7b7LlzXZcuX2X2X2DLly+y5ffHE3iClAboWuaqy4UvMEKligilbUIbBekWBBOLQwb6GaiCS1IImir5ui0ImkWBBOLQwb6Gais5BntIEg0gwtEMjGQnqSc1QurLNllhAC9VZUaGgAtXIgFQVWC1x3hm0NMqhRIoTZjIF0mpeWwQLUR5OXwOAAFVNCxppmjDjs7MH57AzU1ms3g28T99503XM4t6jhxt5KOO2pUr4Ff4K7+u9Wg5hmtaGzIWWFIiRSIGUAaFhdokw2fmMVHcbYgUKilYCqSKCAwwQVlVS5WNn5jFR3G2IFCopWKFrMuKtLVjLaXJY/vpfdQV7PDOwL0ROkLKNFxc2NGapHKcogo4KhHQDZtVhh3QrU0KBNaEy5icNFFfDC3UiQKGULOiazWbTl2d+ycdk/a/J3gNZl0Ahrxuf8fJEQ7aSOoER8magxgnkEPSaeCgfMEfWAJGiuGpK4lBV8Kcs08FA+YI+sASNFcNSVxKCr4U5YJSqHUywvRy5C8vWJuwja+eZ6wMcNjUvWzn43BJ2VobvNMvjc35HOl1dNDRrpNntu05znN5szXsfjfk+VMDONTQRbLEvHIxbwbIFEkBlgA+8McVo4m8BaWWbLLMkA5rIbCyWVC3kuY6beOOqBQcrQcsIa+Pca2+ouzdBqH5BupUVhZpwORYL+esEF2QCabtZTiEHQGgo1VtLWValaFjXLDYNKysiVXBwplGtLAuqrTJsorIiXcBeeYHJBIQb0chBcXp7AwLAbwcqanac5zm82Zr2Pxvyd4CRugeFMy+pZfSzrOfCcX2YmZ/e7zOZz2nxee/9jh5HRcoZxhBzDYhMjEHUpaPKo942gFELVtJdEIO7CYQOK6VmyIHCMdM6LBXABanKkRYrKtNuRMBiIywhjGgTLxMUaKpOC1bZXkQMRqcFAPIvtUSgGq1Vtgpa2FOFEUJuql5GWMhwTG3QRsKy6cxNpGtqKGXnyiDNDFYFC6G2azacuzv2deys/FPz3nlVK62x9Kq9f8eP8KtttZHUCI+IwE86I00lLI0pVsLPqqYy5eNXBZTQMBUClAVa1avMLExWOelo/eW7kzwYbVYYaSJ1erDZc6V1VLcs8eS4eVIHLW5KzBMIJ9CnRqxVVUsuALZhQ2cgD5jANMB0jYMIHJSU5lF1SietUMrjGJbC0NBmxqWXBibzZix2FmPE6ZvHROo/fev4Bt6yjN8hdeMczPcO9XZXZUSZnHZuHxgZxqaCLZYl45GUioFuSwQWUtB5xlBmGFWXDKYuSF5JVbHUtW6DFWSrOk5uKjqGKG6G2cbxG1aQJ1MUALLQUiojspdWQF4BrjPu1ma3t0pCPiuOAY3AsS2BKMvCDdqcs6eOAZGDcCPkMOu1gz3akPEJG2gDAqABs7FLtuWIRD5BYGqlTqg1SXU9oiUKUAIFFSgoUMUo+VvfGjID9FugvVkLbABsiCqCuWIJkEFSpQLA1XFwcILrCg50oOyKQ8GurSjBAokULBMwfOmpLsDkMmJs0zae8PeRATrGdov04xjrfyT7HAUFb1lWoLOdGIBaAwlSuDO90FjRQyAwAy44pEwUOBlOHIklUWlhhwNAAY6GA0NiraAtdALtAZ1UN+b4KGC0Zqpzrid4MfdKX9FmIahFgS1JDUoPhLWCMMXfU7ARIUh3dLw6WcC1gsJB9ECx1OsCsBoEVSVAoEqWU5lqhjIFwXKAzhjQjflIQgCL4KcNXwr11WsMfa3F+hDk6TBNQa0ZmrQbRdgoOalAGAsazV7rm7cmM2VQhA4hiYlIoLuICj1apVIFs21S3LgdDvMkWqfNwdcuvXPyRW22sjqBEfEYhdyCgpBYiNI4TDN3DI0VVFrU4aOkpJFaorVOiuKcRBvhh4um1YtpKS2B8/CAFLKLYywsbN9M5JYUoENDZKPqphcvGrmHK/Zar9kt5wOiRRUUUGl2DxLYrjC9QIHxG4AbrNXFNYtpol4YKXQicopCpowZwYJ9bcY9gnRyrg+nChPAWhZWSRuQOjoR7GXGRlg0oMg2KjI5yqiWxhAQaZArNV+YZ6Wq+FStL3dWFDFQYCgxgixLB417Y7rRj22gA8VQn2q5kdOOgnMuXLly4y+25cuXL7L/ANT47DmixMUfEeYtxx8RZY8MeILrQRVbd93Mp9VBF8EHgvJ8SpXxD2vdyGAUC1QFoAVCMBBSo23mDnCU0MQvHYItqym3kawHx9TB2HBMkyTklBFx2Cioj4jzLg5Vd5bUMHoH3f8ASrTH4zSQYWN3FAqi67VAC1XAAcriiPhYEwam5Hgia5rgQhWfz0ftUdS5cuXLfg+12PNOSUEoK5i4mTsMEXEU2PYVJ0H5/wCd5qQZfRfZZ/0gWgbYYB8QI+UOle0ewAO1b6AItWF4xDBnxAwLeVmTkxzYaHggXrTNkrsrsr4CrznRl0slkt8pyTFfcA5psZUQUXRFR8vdQMoABVVoAMquAMrBRCnKRwKsf6YlKlSOtmWoXCdC1BcYJOesaJWGUZAVhbVjVPqbegaGYBbYhvMbxMZWspaLrszMzMzM998J0uwxYmCYMTBjUt6S3p2F/WWlql/SXisp5+XPeb1DbpDKg76oAf8AX9RTxX6p74/y/W38H//aAAgBAwMBPxD4CiizHFHBjjjizHHKj27whlhK3SvQq71OvlhiODzHHHFZHFHBxHHHyRUPU7uER88tn0q+ny1xcRxxx9lR9lxxxWe9UxQeeAFeFGPD5ZtHNo445tH2XNu3ds8e9UZQvxvEwcg+Ilrn5YdgeY4+9fbt1lPDvGVK6JmrP4ZzjpXyQ0XAja6DwtQvjceCd2rk0uYtlUXLyFNak9DD40o1468YX3gpYnCnlCsaRZqT0MPjSjXjrxlkUaqVBc0wEWroTrCEK6wx8aXfHXiUIJX0rC8i7XBZpzdDZBfipTlrQaM2dQzCEAucG9qV+CzYLMxHqkL6KLT1HPbuHc+3bv7O8eDt6ZzzPJnRxnr8kqWzFhT+gxsOTMHJIzoNlaGyto2SQhj6z2FXFbzIi5dqzPwFU2AgaDTGijEIY+s9hVxW8yIuXags8q0dooUF0UFGKieWXVZHg0Zzjq9YXhgOwBDLAWsDNci4uAAC5ywbU0cnSqBFKBWQV1uYmgzjRIbFZ3W3MKWYBcrgK7nNTfvbWHk95ivkd9aSvSnv8kfEakAj5jhjrdJTfNBcOa+KZ5UaioGpXytjePIHTIdIc18Uzyo1FQNSvlbG8eQOmQ6QJEmU1XMYaXWDF8EKA01hfKjKOrKqVemH4SpqSrNXpY/CJthC186Fzj2+k37c4nHsflfh+VfRmILUtm6R+8tWhDVhRyWzC5uMsBQ9cUtXmnTTWovYKWq7yG6F01zMkQqkL6Cpb0DLGYInmQNIbrI0FI6liwUXmUDxT4FMzA59GLaoltZTqUHFSi3NlG7KybOYeQhIWq6FsomRmyruXckaA1NuVUc5xzENDpU8Wzh4dPDATzaQLAm0ZByLqzs6Tftzicex+V+HvMu4oY+eH4fb5J95/JCQwJ1BJ6jLy43FkHXmHzzANL2u5QXReXGbiYBdA033PNqjNVKC6LNYloSgiYFwBgAjBLF1F3FMiXgbENiXDnp0inOJhLbADoVUEb5vogAFuolXhSsAXNfIYJrlCjpdmQmYQNC2qKuunfPJ1hAduCF30tK1cLtFCEtouOTS6FtbVvZNd/s4eXecK7l0oR+X2+SPhNSAieI4YqKezifhroNVPCbWLHphdeFxy9NoQvBdALoC/Ang+hewEmtOqatWCn1IRF2XgcLyCC7Okq/EPmMAswDCgGdxS3Pvn+uy/G4aNUEDMYaWMMLwdCZyWgixTQAbMN8Rm27Tr3kHMtQsQherQt8XPZO59u3O/h3qMWvABJ70b8K+SUZiC1LZukfvLOaFOJtKK1mcV6Qlj5e3JguzByzhxhlL+iwKunLB4bqa6imcsh4F5rGdR98BYQgWbBEUxYmxgydqsDas31Y88bnIKFHLrJwzjVuWIhCJq2X0yu3g28EKaFgwYyLQyZQ2dSNiigdehUXmksdesAgrceAumM6iyHA0lsbODjhYl2MNF1tDG2kqDhTAvjArsuvJ3I+gQosbC02g1CtKAbcMHigjy6UpZnZg5lK80D2mZyBTDAwTk2Lgq2kaFBTA4cx6USEQqyCaWXqssLhg28u9lr7Ff1r/ABXyT7z+SOGEGfMp0qp+8u1r6xbJ0wU7ONseijg0DZTk53DLdGalDqgwrYZYNXp8LWWHkW6gVVui9YWr5QngFxFeHZG6644Ak+qzX5VCCxCibWVV1YLrIgrivl7C6o0XOyWaSxkIRvj9oFWxbDLKndQVN1lg0OR8LbE4Q1VuEC6DSxWxeYRXsFXUYCElHknCWJWKV9xrw7wallQoBWFCKPmOY6bzEgaUUFBYg1wZbArGKMkrgVz9Fcroa1cCWzXXCqWLIUGVqiIBCznRaAVm5FW6vezhf2GfR7fJHwmpARPEcMXvAiGiZESwjkTU3kZgO+wXs7vbGxr2Sd7ulN+U0TNZWOxoWNaZcQ8EAZhApzS4zAnqFC4LsFoixQthxPCbWLHphdeFz/1ZthP3hgrbBA1VgEGlPKIS9SAo6I4TwhycDLzZQseRwx8M7EExy3XZy4zPUyFedC/WdZe/v39kT6ikYs4QoZdJt6wrQM13iSlwg4G3MChTNRKYByCq0LVgYmQ33l3rU+6XeTLmbKBbLlty9YZQnh3XaFkdAFr6E21q82X3flYWwQOIYYYGIYIYEEMsQ6sMFd2tWlzpmTxArx/0uLilE64BaDK6C1QJoxbvPl2f/qFvkAJUyNNUJW4h/wABg5ghghgzDDDBmCGWh6d4E9GU6o9r/SboyCYAF0KUORWAgTKWKrQBtV0HtHhkWCyzrLVihCnEBFCUGGFQYQCkAAHxhcEDjsjDBUMHEMMMMMofU94b4pnRPuBf6UEFJNKLE8KhALsekXmry8ZhpEN3uutitJA0ELCILJHThrRxYW80l8fGC+wFdtDsg4hhhgcQQyxo3CAcHdROBLVwAbV4CKMtubLV6B6H+k6+kgfDKgNE0EBbjYM5MV3ITFygKqvcOEuw8Wx2ihThJzVhpTloZq2gtVCpb8WkpCuZSVlZSVlJWVm0pKzEv08+8/OqyCChsW1yzABU/wBfiPeo89X1uf8AkNT2da4r4P8A/9k=
                                         =" />
                                      </a>
                              
                              
                              
                                      <p>Hagen GmbH<br>
                                          Paul-Ehrlich-Weg 3<br>
                                          31226 Peine</p><br>
                                      <p>Sitz des Gerichtes: Amtsgericht Peine<br>
                                          Registerblatt HRB 204800
                                          Inhaber und Geschäftsführer: Christian Hagen, Torben Hagen</p>
                              
                              
                                  </div>
                              </div>
                              </html>', 'text/html');
                            // Send the message
                            $result = $mailer->send($message);

                        } catch (Exception $e){
                            echo $e->getMessage();
                            file_put_contents($file, $e->getMessage() ."\n", FILE_APPEND | LOCK_EX);
                        } 
            
            } catch (Exception $e){
                echo $e->getMessage();
                file_put_contents($file, $e->getMessage() ."\n", FILE_APPEND | LOCK_EX);
            } 
            
         }
    }
}

?>