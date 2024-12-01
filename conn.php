<?php
$servername = "autorack.proxy.rlwy.net:35321"; // Substituído com o seu servidor e porta
$username = "root"; // Substituído com o seu nome de usuário
$password = "bAFNGAdDbjMoEUeVWiKdRdaLNRKDBxJr"; // Substituído com a sua senha
$dbname = "railway"; // Substituído com o nome do seu banco de dados

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
