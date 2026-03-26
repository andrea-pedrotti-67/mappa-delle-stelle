<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Catalogo Stellare</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>🔭 Catalogo Stellare</h1>
    
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>Costellazione</th>
                    <th>Nome Stella</th>
                    <th>SAO</th>
                    <th>Coordinate</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT c.nome AS c_nome, c.id AS c_id, s.* FROM costellazioni c 
                        LEFT JOIN stelle s ON c.id = s.id_costellazione 
                        ORDER BY c.nome";
                $res = $conn->query($sql);
                
                while($row = $res->fetch_assoc()) {
                    echo "<tr>
                            <td>
                                <strong>{$row['c_nome']}</strong> 
                                <br><a href='modifica_costellazione.php?id={$row['c_id']}' style='font-size:0.8em'>[Modifica]</a>
                            </td>
                            <td>" . ($row['nome'] ?? '<i style="color:gray">Nessuna stella</i>') . "</td>
                            <td>" . ($row['codice_sao'] ?? '-') . "</td>
                            <td>" . ($row['coordinate'] ?? '-') . "</td>
                            <td>";
                    if($row['codice_sao']) {
                        echo "<a href='modifica_stella.php?sao={$row['codice_sao']}' class='btn' style='padding: 5px 10px; font-size: 0.8em;'>Modifica</a>";
                    }
                    echo "</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="nav">
        <a href="index.php" class="btn">🏠 Torna alla Home</a>
        <a href="aggiungi_stella.php" class="btn">➕ Aggiungi Stella</a>
    </div>
</body>
</html>