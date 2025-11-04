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
    autor.autor_nome,
    autor.autor_foto,
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
    $ordem = ($ordem == "ASC") ? "DESC" : "ASC";
    $sql .= " ORDER BY obra.obra_qtd_capitulos $ordem";
} elseif ($filtro == "favorito") {
    $ordem = ($ordem == "ASC") ? "DESC" : "ASC";
    $sql .= " ORDER BY qtd_favoritos $ordem";
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
<style>
body {
    font-family: Arial, Helvetica, sans-serif;
}
.container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 15px;
    margin: 20px;
}
.obra {
    border: 1px solid lightblue;
    padding: 20px;
    width: 240px;
    text-align: center;
    border-radius: 10px;
    background-color: #f7faff;
    transition: transform 0.2s;
}
.obra:hover {
    transform: scale(1.05);
}
img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 50%;
    margin-bottom: 10px;
}
.obra p {
    margin: 5px 0;
}
a {
    text-decoration: none;
    color: inherit;
}
</style>
</head>
<body>

<div class="container">
<?php
while ($obra = mysqli_fetch_assoc($resultado)) {
    //$foto = $obra["obra_foto"];
    //$arquivo = "../fotos/$foto";
    //if (!file_exists($arquivo) || !$foto) {
    //    $arquivo = "../fotos/padrao-autor.png";
    //}

    $inicio = date('d/m/Y', strtotime($obra["obra_data_inicio"]));
    $final = $obra["obra_data_final"] ? date('d/m/Y', strtotime($obra["obra_data_final"])) : "Em andamento";

    echo '<a href="pagina.php?id=' . $obra['obra_id'] . '" target="_top">';
    echo '<div class="obra">';
    //echo '<img src="' . htmlspecialchars($arquivo) . '" alt="Foto do autor">';
    echo '<p><strong>' . htmlspecialchars($obra['obra_nome']) . '</strong></p>';
    echo '<p>Autor: ' . htmlspecialchars($obra['autor_nome'] ?? 'Desconhecido') . '</p>';
    echo '<p>Início: ' . htmlspecialchars($inicio) . '</p>';
    echo '<p>Final: ' . htmlspecialchars($final) . '</p>';
    echo '<p>Capítulos: ' . htmlspecialchars($obra['obra_qtd_capitulos']) . '</p>';
    echo '<p>Volumes: ' . htmlspecialchars($obra['obra_qtd_volumes']) . '</p>';
    echo '<p>' . htmlspecialchars($obra['qtd_favoritos']) . ' pessoas favoritaram</p>';
    echo '</div>';
    echo '</a>';
}
?>
</div>

</body>
</html>
