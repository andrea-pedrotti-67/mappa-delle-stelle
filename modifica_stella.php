<?php 
include 'db.php'; 

// Recupero i dati della stella
if (isset($_GET['sao'])) {
    $sao = intval($_GET['sao']);
    $res = $conn->query("SELECT * FROM stelle WHERE codice_sao = $sao");
    $stella = $res->fetch_assoc();
}

// Salvo le modifiche
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sao_v = intval($_POST['sao_v']);
    $nome = $conn->real_escape_string($_POST['nome']);
    $coord = $conn->real_escape_string($_POST['coord']);
    $cost = intval($_POST['id_c']);

    $sql = "UPDATE stelle SET nome='$nome', coordinate='$coord', id_costellazione=$cost WHERE codice_sao=$sao_v";
    
    if ($conn->query($sql)) {
        header("Location: catalogo.php");
    } else {
        $errore = "Errore durante l'aggiornamento: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Modifica Stella - Star Registry</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>✏️ Modifica Stella</h1>

    <div class="container">
        <?php if(isset($errore)) echo "<p style='color: #ff7b72;'>$errore</p>"; ?>
        
        <?php if ($stella): ?>
        <form method="POST">
            <input type="hidden" name="sao_v" value="<?= $stella['codice_sao'] ?>">

            <p><strong>Codice SAO:</strong> <?= $stella['codice_sao'] ?> (Sola lettura)</p>

            <label for="nome">Nome della Stella:</label>
            <input type="text" id="nome" name="nome" value="<?= $stella['nome'] ?>" required>

            <label for="coord">Coordinate Celesti:</label>
            <input type="text" id="coord" name="coord" value="<?= $stella['coordinate'] ?>" required>

            <label for="id_c">Costellazione:</label>
            <select id="id_c" name="id_c" required>
                <?php
                $res_c = $conn->query("SELECT * FROM costellazioni ORDER BY nome ASC");
                while($c = $res_c->fetch_assoc()) {
                    $sel = ($c['id'] == $stella['id_costellazione']) ? "selected" : "";
                    echo "<option value='{$c['id']}' $sel>{$c['nome']}</option>";
                }
                ?>
            </select>

            <button type="submit" class="btn">Aggiorna Record</button>
        </form>
        <?php else: ?>
            <p>Stella non trovata nell'archivio.</p>
        <?php endif; ?>
    </div>

    <div class="nav">
        <a href="catalogo.php" class="btn" style="background-color: transparent; border: 1px solid var(--border-color);">❌ Annulla</a>
    </div>
</body>
</html>