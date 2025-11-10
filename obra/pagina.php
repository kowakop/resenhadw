<?php
require_once "../conexao.php";
require_once "../verificar_user.php";

$id = $_GET['id'];

// Dados da obra
$sqlObra = "SELECT 
    obra_id, 
    obra_nome, 
    obra_data_inicio, 
    obra_data_final, 
    obra_qtd_capitulos,
    obra_qtd_volumes,
    autor_nome,
    obra_foto
FROM obra
INNER JOIN autor ON obra_autor_id = autor_id
WHERE obra_id = ?";
$comando = mysqli_prepare($conexao, $sqlObra);
mysqli_stmt_bind_param($comando, "i", $id);
mysqli_stmt_execute($comando);
$resultados_obra = mysqli_stmt_get_result($comando);

// Favoritos
$sql = "SELECT COUNT(*) AS qtd_favoritos 
        FROM favorito 
        WHERE favorito_id = ? AND favorito_tipo = 'ob'";
$comando = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($comando, "i", $id);
mysqli_stmt_execute($comando);
$resultados_fav = mysqli_stmt_get_result($comando);
$qtd_favoritos = mysqli_fetch_assoc($resultados_fav)['qtd_favoritos'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Obra</title>
<style>
    body {
        font-family: sans-serif;
        background: #f6f6f6;
        color: #222;
    }

    a {
        text-decoration: none;
        color: #0077cc;
    }

    .obra {
        background: white;
        max-width: 600px;
        margin: 30px auto;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .obra img {
        width: 500px;            
        height: 350px;           
        object-fit: cover;       
        border-radius: 8px;      
        display: block;
        margin: 0 auto 15px;
    }

    .obra h1 {
        margin-bottom: 10px;
    }

    .obra p span {
        font-weight: bold;
    }

    .botao {
        display: inline-block;
        margin-top: 10px;
        background: #0077cc;
        color: white;
        padding: 8px 16px;
        border-radius: 6px;
        transition: 0.2s;
    }

    .botao:hover {
        background: #005fa3;
    }
</style>

</head>
<body>
<?php 
    $url = "../listar.php?objeto=obra";
    if(isset($_GET["voltar"])) {
        $voltar = $_GET["voltar"];
        if ($voltar == "fav") {
            $url = '../favoritos.php?objeto=ob';
        } else {
            $url = "../listar.php?objeto=obra";
        }        
    }
    $url = urlencode($url);

    echo '<a href="../index.php?url=' . $url . '" target="_top">voltar</a>';
    ?>


<?php
if ($obra = mysqli_fetch_assoc($resultados_obra)) {

    $foto = $obra["obra_foto"];
    $arquivo = "../fotos/$foto";
    if (!file_exists($arquivo) || !$foto) {
        $arquivo = "../fotos/padrao-obra.png";
    }

    $data_inicio = date('d/m/Y', strtotime($obra['obra_data_inicio']));
    $data_final = $obra['obra_data_final'] ? date('d/m/Y', strtotime($obra['obra_data_final'])) : 'Em andamento';

    echo "<div class='obra'>";
    echo "<img src='$arquivo' alt=''>";
    echo "<h1>" . htmlspecialchars($obra['obra_nome']) . "</h1>";
    echo "<p><strong>Autor:</strong> " . htmlspecialchars($obra['autor_nome']) . "</p>";
    echo "<p><strong>Início:</strong> $data_inicio</p>";
    echo "<p><strong>Final:</strong> $data_final</p>";
    echo "<p><strong>Capítulos:</strong> " . htmlspecialchars($obra['obra_qtd_capitulos']) . "</p>";
    echo "<p><strong>Volumes:</strong> " . htmlspecialchars($obra['obra_qtd_volumes']) . "</p>";
    echo "<p><strong>Favoritos:</strong> $qtd_favoritos</p>";

    // Verifica se o usuário já favoritou
    $sql = "SELECT * FROM favorito WHERE favorito_usuario_id = ? AND favorito_id = ? AND LOWER(favorito_tipo) = 'ob'";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'ii', $id_user, $id);
    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);
    $favoritou = mysqli_fetch_assoc($resultado);

    if (!$favoritou) {
        echo "<a href='../favoritar.php?id=$id&objeto=ob' class='botao'>Favoritar</a>";
    } else {
        echo "<a href='../favoritar.php?id=$id&objeto=ob' class='botao'>Desfavoritar</a>";
    }

    if ($tipo == "admin") {
        echo "<br><a href='cadastrar.php?id=$id'>Editar</a>";
    }

    echo "</div>";

} else {
    echo "Obra não encontrada.";
}
?>
</body>
</html>
