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

$sql = "
SELECT 
    obra_id,
    obra_nome,
    obra_data_inicio,
    obra_data_final,
    obra_qtd_capitulos,
    obra_qtd_volumes,
    obra_foto,
    autor.autor_nome,
    COUNT(DISTINCT favorito.favorito_id) AS qtd_favoritos
FROM obra
LEFT JOIN autor 
    ON obra_autor_id = autor_id
LEFT JOIN favorito 
    ON favorito.favorito_id = obra.obra_id 
    AND favorito.favorito_tipo = 'ob'
GROUP BY obra.obra_id
";

if ($filtro == "data") {
    $sql .= " ORDER BY obra.obra_data_inicio $ordem";
} elseif ($filtro == "qtd") {
    $sql .= " ORDER BY obra.obra_qtd_capitulos " . ($ordem == "ASC" ? "DESC" : "ASC");
} elseif ($filtro == "favorito") {
    $sql .= " ORDER BY qtd_favoritos " . ($ordem == "ASC" ? "DESC" : "ASC");
} else {
    $sql .= " ORDER BY obra.obra_nome $ordem";
}

$resultado = mysqli_query($conexao, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lista de Obras</title>
<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="../listar.css">
</head>
<body>

<div class="container lista-container">
<?php
while ($obra = mysqli_fetch_assoc($resultado)) {

    $foto = $obra["obra_foto"];
    $arquivo = "../fotos/$foto";
    if (!file_exists($arquivo) || !$foto) {
        $arquivo = "../fotos/padrao-obra.png"; 
    }


    $inicio = date('d/m/Y', strtotime($obra["obra_data_inicio"]));
    $final = $obra["obra_data_final"] ? date('d/m/Y', strtotime($obra["obra_data_final"])) : "Em andamento";


    $url = "obra/pagina.php?id=" . $obra['obra_id'];
    $url = urlencode($url);

    echo '<a href="../index.php?url=' . $url . '" target="_top" class="item-link">';
    echo '<div class="item-card">';
    echo '<img src="' . $arquivo . '" alt="foto da obra" class="item-image">';
    echo '<h3 class="item-title">' . htmlspecialchars($obra['obra_nome']) . '</h3>';
    echo '<p class="item-info">Autor: <span>' . htmlspecialchars($obra['autor_nome'] ?? 'Desconhecido') . '</span></p>';
    echo '<p class="item-info">Início: <span>' . htmlspecialchars($inicio) . '</span></p>';
    echo '<p class="item-info">Final: <span>' . htmlspecialchars($final) . '</span></p>';
    echo '<p class="item-info">Capítulos: <span>' . htmlspecialchars($obra['obra_qtd_capitulos']) . '</span></p>';
    echo '<p class="item-info">Volumes: <span>' . htmlspecialchars($obra['obra_qtd_volumes']) . '</span></p>';
    echo '<p class="item-favoritos">' . htmlspecialchars($obra['qtd_favoritos']) . ' pessoas favoritaram essa obra</p>';
    echo '</div>';
    echo '</a>';
}
?>
</div>

</body>
</html>
