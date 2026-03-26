<?php 
// Includiamo la connessione al database
include 'db.php'; 
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star Registry - Mappa delle Stelle</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>🔭 STAR REGISTRY</h1>

    <div class="container">
        <?php
        // Query per estrarre una stella casuale con la sua costellazione
        $query = "SELECT s.*, c.nome AS n_cost 
                  FROM stelle s 
                  LEFT JOIN costellazioni c ON s.id_costellazione = c.id 
                  ORDER BY RAND() 
                  LIMIT 1";
        
        $res = $conn->query($query);
        $s = $res->fetch_assoc();

        if ($s): ?>
            <h2>✨ Stella Casuale: <?= htmlspecialchars($s['nome']) ?></h2>
            
            <p><strong>Codice SAO:</strong> <?= htmlspecialchars($s['codice_sao']) ?></p>
            <p><strong>Coordinate Celesti:</strong> <?= htmlspecialchars($s['coordinate']) ?></p>
            <p><strong>Costellazione:</strong> 
                <span style="color: var(--accent); font-weight: 500;">
                    <?= htmlspecialchars($s['n_cost'] ?? 'Nessuna costellazione assegnata') ?>
                </span>
            </p>
        <?php else: ?>
            <p>L'archivio è vuoto. Inizia aggiungendo una nuova stella o costellazione!</p>
        <?php endif; ?>
    </div>

    <div class="nav">
        <a href="catalogo.php">🔭 Vai al Catalogo</a>
        <a href="aggiungi_stella.php">➕ Aggiungi Stella</a>
        <a href="aggiungi_costellazione.php">🌌 Nuova Costellazione</a>
    </div>

</body>
</html>