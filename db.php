<?php
$conn = new mysqli("localhost", "root", "", "databasestelle");
if ($conn->connect_error) { die("Errore connessione: " . $conn->connect_error); }
?>
