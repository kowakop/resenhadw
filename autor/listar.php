<?php
require_once "../conexao.php";
require_once "../verificar_user.php";

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

// left join junta dados mesmo se o resenha não tiver obras ou favoritos
// group by agrupa as linhas pelo resenha para o count
// e distinct pra só contar uma vez cada obra ou favorito
$sql = "
SELECT 
    autor_id,
    autor_nome,
    autor_data_nasc,
    autor_data_morte,
    autor_foto,
    COUNT(DISTINCT obra_id) AS qtd_obras,
    COUNT(DISTINCT favorito_id) AS qtd_favoritos
FROM autor
LEFT JOIN obra ON obra_autor_id = autor_id
LEFT JOIN favorito ON favorito_id = autor_id AND favorito_tipo = 'au'
GROUP BY autor_id
";


if ($filtro == "data") {
    $sql .= " ORDER BY autor_data_nasc $ordem";
} else {
    if ($filtro == "favorito") {
        if($ordem == "DESC") {
            $ordem = "ASC";
        } else {
            $ordem = "DESC";
        }
        $sql .= " ORDER BY qtd_favoritos $ordem";
    } else {
        $sql .= " ORDER BY autor_nome $ordem";
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
  <link rel="stylesheet" href="../listar.css">

</head>

<body>
    <div class="container lista-container">
        <?php
        while ($autor = mysqli_fetch_assoc($resultado)) {
            $foto = $autor["autor_foto"];
            $arquivo = "../fotos/$foto";
            if (!file_exists($arquivo) || !$foto) {
                $arquivo = "../fotos/padrao-autor.png";
            }
            if ($autor["autor_data_morte"]) {
                $morte = strtotime($autor["autor_data_morte"]);
                if ($morte == false) {
                    $morte = "<span>Vivo</span>";
                } else {
                    $morte = "Morte: <span>" . date('d/m/Y', $morte) . "</span>";
                }
            } else {
                $morte = "<span>Vivo</span>";
            }

            $nascimento = date('d/m/Y', strtotime($autor["autor_data_nasc"]));

            $url = "autor/pagina.php?id=" . $autor['autor_id'];
            $url = urlencode($url);

            echo '<a href="../index.php?url=' . $url . '" target="_top" class="item-link">';
            echo '<div class="item-card">';
            echo '<img src="' . $arquivo . '" alt="foto do autor" class="item-image">';
            echo '<h3 class="item-title">' . htmlspecialchars($autor['autor_nome']) . '</h3>';
            echo '<p class="item-info">Nascimento: <span>' . htmlspecialchars($nascimento) . '</span></p>';
            echo '<p class="item-info">' . $morte . '</p>';
            echo '<p class="item-info">Total de obras: ' . $autor['qtd_obras'] . '</p>';
            echo '<p class="item-favoritos">' . $autor['qtd_favoritos'] . ' pessoas favoritaram esse autor</p>';
            echo '</div>';
            echo '</a>';
        }
        ?>
    </div>
</body>

</html>