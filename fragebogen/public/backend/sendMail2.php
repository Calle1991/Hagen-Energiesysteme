
<?php

header("Access-Control-Allow-Origin: *");
$rest_json = file_get_contents("php://input");
$_POST = json_decode($rest_json, true);

if(isset($_POST['sendmail'])){
    $mail = $_POST['mail'];
    $tel = $_POST['tel'];
    $meter = $_POST['meter'];
    $stromverteilerChecked = $_POST['stromverteilerChecked'];
    $tiefbauChecked = $_POST['tiefbauChecked'];
    $wanddurchbruchChecked = $_POST['wanddurchbruchChecked'];
    $ladesaeuleChecked = $_POST['ladesaeuleChecked'];
    $installationChecked = $_POST['installationChecked'];
    $name = $_POST['name'];


    // mehrere Empfänger
$empfaenger  = 'p.tobinski@hagengmbh.de,i6jmmaojxx+CHUXR+J33UE@in.meistertask.com'; // beachte das Komma

// Betreff
$betreff = 'Energiesysteme - Fragebogen';

// Nachricht
$nachricht = '
<html>
<head>
  <title>Angebotsanfrage</title>
</head>
<body>
<table>
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
        '. $mail .'
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
        '. $meter .'
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
</html>
';

// für HTML-E-Mails muss der 'Content-type'-Header gesetzt werden
$header[] = 'MIME-Version: 1.0';
$header[] = 'Content-type: text/html; charset=iso-8859-1';

// zusätzliche Header
$header[] = 'To: p.tobinski@hagengmbh.de, i6jmmaojxx+CHUXR+J33UE@in.meistertask.com';
$header[] = 'From: Hagen Energiesysteme';

// verschicke die E-Mail
mail($empfaenger, $betreff, $nachricht, implode("\r\n", $header));
echo 'Email versendet';
}else{
    echo 'Daten unvollständig!';
}


?>
