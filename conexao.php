<?php

// Lógica de conexão ao banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "euxt";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");
// Verificar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>