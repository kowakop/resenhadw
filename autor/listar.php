<?php
require_once "../conexao.php";

if (isset($_GET["filtro"])) {
    $filtro = $_GET["filtro"];
} else {
    $filtro = "alfabetica";
}

if (isset($_GET["ordem"]) && $_GET["ordem"] == "invertida") {
    $ordem = "DESC";
} else {
    $ordem = "ASC";
}

// left join junta dados mesmo se o autor não tiver obras ou favoritos
// group by agrupa as linhas pelo autor para o count
$sql = "
SELECT 
    a.autor_id,
    a.autor_nome,
    a.autor_data_nasc,
    a.autor_data_morte,
    a.autor_foto,
    COUNT(DISTINCT o.obra_id) AS qtd_obras,
    COUNT(DISTINCT f.favorito_id) AS qtd_favoritos
FROM autor a
LEFT JOIN obra o ON o.obra_autor_id = a.autor_id
LEFT JOIN favorito f ON f.favorito_id = a.autor_id AND f.favorito_tipo = 'au'
GROUP BY a.autor_id
";


if ($filtro == "data") {
    $sql .= " ORDER BY a.autor_data_nasc $ordem";
} else {
    if ($filtro == "favorito") {
        $sql .= " ORDER BY qtd_favoritos $ordem";
    } else {
        $sql .= " ORDER BY a.autor_nome $ordem";
    }
}

$resultado = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Autores</title>
    <style>
        .conteiner {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin: 30px 0px;
        }

        .autor {
            border: 1px solid lightblue;
            padding: 20px;
            width: 220px;
        }

        img {
            width: 60px;
            height: 60px;
        }

        a {
            color: black;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="conteiner">
        <?php
        while ($autor = mysqli_fetch_assoc($resultado)) {
            $foto = $autor["autor_foto"];
            $arquivo = "../fotos/$foto";
            if (!file_exists($arquivo) || !$foto) {
                $arquivo = "../fotos/padrao-autor.png";
            }

            if ($autor["autor_data_morte"]) {
                $morte = "Morte: <span>" . date('d/m/Y', strtotime($autor["autor_data_morte"])) . "</span>";
            } else {
                $morte = "<span>Vivo</span>";
            }

            $nascimento = date('d/m/Y', strtotime($autor["autor_data_nasc"]));

            echo '<a href="pagina.php?id=' . $autor['autor_id'] . '">';
            echo '<div class="autor">';
            echo '<img src="' . $arquivo . '" alt="foto do autor">';
            echo '<p>' . htmlspecialchars($autor['autor_nome']) . '</p>';
            echo '<p>Nascimento: <span>' . htmlspecialchars($nascimento) . '</span></p>';
            echo '<p>' . $morte . '</p>';
            echo '<p>Total de obras: ' . $autor['qtd_obras'] . '</p>';
            echo '<p>' . $autor['qtd_favoritos'] . ' pessoas favoritaram esse autor</p>';
            echo '</div>';
            echo '</a>';
        }
        ?>
    </div>

</body>

</html>