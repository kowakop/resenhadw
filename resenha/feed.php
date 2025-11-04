<?php
require_once "../conexao.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Feed de Resenhas</title>
    <link rel="stylesheet" href="feed.css"> 
</head>
<body>
    <h2>📚 Resenhas Recentes</h2>

    <div class="feed">
        <?php
        $sql = "SELECT 
                    *,
                    o.obra_nome AS obra_titulo,
                    o.obra_foto AS obra_foto,
                    a.autor_nome AS autor_nome
                FROM resenha
                LEFT JOIN obra o ON resenha_obra_id = obra_id
                LEFT JOIN autor a ON obra_autor_id = autor_id
                ORDER BY resenha_id DESC";

        $resultado = mysqli_query($conexao, $sql);

        if (mysqli_num_rows($resultado) > 0) {
            while ($linha = mysqli_fetch_assoc($resultado)) {
                $titulo = $linha['resenha_titulo'] ?? 'Sem título';
                $texto = $linha['resenha_texto'] ?? '';
                $obra = $linha['obra_titulo'] ?? 'Obra desconhecida';
                $autor = $linha['autor_nome'] ?? 'Autor desconhecido';
                $foto = !empty($linha['obra_foto']) ? "../fotos/" . $linha['obra_foto'] : "../fotos/padrao-obra.png";
                $id = $linha['resenha_id'];

                echo "<div class='resenha'>";
                echo "<img src='" . htmlspecialchars($foto) . "' alt='Capa da obra' class='capa'>";
                echo "<h3>" . htmlspecialchars($titulo) . "</h3>";
                echo "<h4>" . htmlspecialchars($obra) . "</h4>";
                echo "<p>" . nl2br(htmlspecialchars($texto)) . "</p>";
                echo "<p class='autor'>👤 " . htmlspecialchars($autor) . "</p>";
                echo "<a href='pagina.php?id=" . urlencode($id) . "'>Ver mais</a>";
                echo "</div>";
            }
        } else {
            echo "<p>Nenhuma resenha encontrada.</p>";
        }

        mysqli_close($conexao);
        ?>
    </div>
</body>
</html>
