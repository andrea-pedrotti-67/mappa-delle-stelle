<?php 
include 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $conn->real_escape_string($_POST['nome']);
    
    $sql = "INSERT INTO costellazioni (nome) VALUES ('$nome')";
    
    if ($conn->query($sql)) {
        header("Location: catalogo.php");
    } else {
        $errore = "Errore nell'inserimento: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Nuova Costellazione - Star Registry</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>🌌 Nuova Costellazione</h1>

    <div class="container">
        <?php if(isset($errore)) echo "<p style='color: #ff7b72;'>$errore</p>"; ?>

        <form method="POST">
            <label for="nome">Nome della Costellazione:</label>
            <input type="text" id="nome" name="nome" placeholder="Esempio: Cassiopea, Andromeda..." required>
            
            <button type="submit" class="btn">Registra Costellazione</button>
        </form>
    </div>

    <div class="nav">
        <a href="catalogo.php" class="btn" style="background-color: transparent; border: 1px solid var(--border-color);">❌ Annulla</a>
    </div>
</body>
</html>