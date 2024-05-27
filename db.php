<?php
$servername = "localhost";
$username = "root";
$password = ""; // Remplacez par votre mot de passe MySQL
$dbname = "studio_jeu";

// Créez une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifiez la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}
?>
