<?php 
include 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Uso real_escape_string per evitare errori con nomi che contengono apostrofi (es. L'Aquila)
    $sao = intval($_POST['sao']);
    $nome = $conn->real_escape_string($_POST['nome']);
    $coord = $conn->real_escape_string($_POST['coord']);
    $cost = intval($_POST['cost']);

    $sql = "INSERT INTO stelle (codice_sao, nome, coordinate, id_costellazione) 
            VALUES ($sao, '$nome', '$coord', $cost)";
    
    if ($conn->query($sql)) {
        header("Location: catalogo.php");
    } else {
        $errore = "Errore durante l'inserimento: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Aggiungi Stella - Star Registry</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>➕ Nuova Stella</h1>

    <div class="container">
        <?php if(isset($errore)) echo "<p style='color:red'>$errore</p>"; ?>
        
        <form method="POST">
            <label for="sao">Codice SAO (ID Unico):</label>
            <input type="number" id="sao" name="sao" placeholder="Esempio: 123456" required>

            <label for="nome">Nome della Stella:</label>
            <input type="text" id="nome" name="nome" placeholder="Esempio: Betelgeuse" required>

            <label for="coord">Coordinate Celesti:</label>
            <input type="text" id="coord" name="coord" placeholder="Esempio: 05h 55m | +07°" required>

            <label for="cost">Costellazione di appartenenza:</label>
            <select id="cost" name="cost" required>
                <option value="" disabled selected>Seleziona una costellazione...</option>
                <?php
                $res = $conn->query("SELECT * FROM costellazioni ORDER BY nome ASC");
                while($c = $res->fetch_assoc()) {
                    echo "<option value='{$c['id']}'>{$c['nome']}</option>";
                }
                ?>
            </select>

            <button type="submit" class="btn">Registra Stella nell'Archivio</button>
        </form>
    </div>

    <div class="nav">
        <a href="catalogo.php" class="btn" style="background-color: transparent; border: 1px solid var(--border-color);">❌ Annulla</a>
    </div>
</body>
</html>