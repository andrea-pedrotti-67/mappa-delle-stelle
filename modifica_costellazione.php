<?php 
include 'db.php'; 

// 1. Recupero i dati attuali della costellazione
$cost = null;
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $res = $conn->query("SELECT * FROM costellazioni WHERE id = $id");
    $cost = $res->fetch_assoc();
}

// 2. Salvo le modifiche quando viene inviato il form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_cost = intval($_POST['id_cost']);
    $nome_nuovo = $conn->real_escape_string($_POST['nome']);

    $sql = "UPDATE costellazioni SET nome = '$nome_nuovo' WHERE id = $id_cost";
    
    if ($conn->query($sql)) {
        header("Location: catalogo.php");
        exit();
    } else {
        $errore = "Errore nell'aggiornamento: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Modifica Costellazione - Star Registry</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>✏️ Modifica Costellazione</h1>
    
    <div class="container">
        <?php if (isset($errore)) echo "<p style='color: #ff7b72;'>$errore</p>"; ?>

        <?php if ($cost): ?>
        <form method="POST">
            <input type="hidden" name="id_cost" value="<?= $cost['id'] ?>">
            
            <p><strong>ID Costellazione:</strong> <?= $cost['id'] ?> (Sola lettura)</p>

            <label for="nome">Nuovo Nome della Costellazione:</label>
            <input type="text" id="nome" name="nome" value="<?= $cost['nome'] ?>" required>
            
            <button type="submit" class="btn">Aggiorna Nome</button>
        </form>
        <?php else: ?>
            <p>Costellazione non trovata nell'archivio.</p>
        <?php endif; ?>
    </div>

    <div class="nav">
        <a href="catalogo.php" class="btn" style="background-color: transparent; border: 1px solid var(--border-color);">❌ Annulla</a>
    </div>
</body>
</html>