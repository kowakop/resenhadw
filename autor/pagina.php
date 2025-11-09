<?php
require_once "../conexao.php";
require_once "../verificar_user.php";

$id = $_GET['id'];

$sqlAutor = "SELECT autor_id, autor_nome, autor_data_nasc, autor_data_morte, autor_foto 
             FROM autor 
             WHERE autor_id = ?";
$stmt = mysqli_prepare($conexao, $sqlAutor);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$resultados_autor = mysqli_stmt_get_result($stmt);

//favoritos
$sql = "SELECT COUNT(*) AS qtd_favoritos 
           FROM favorito 
           WHERE favorito_id = ? AND favorito_tipo = 'au'";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$resultados_fav = mysqli_stmt_get_result($stmt);

$qtd_favoritos = mysqli_fetch_assoc($resultados_fav)['qtd_favoritos'];

//obras
$sql = "SELECT COUNT(*) AS qtd_obras 
            FROM obra 
            WHERE obra_autor_id = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$resultados_obras = mysqli_stmt_get_result($stmt);

$qtd_obras = mysqli_fetch_assoc($resultados_obras)['qtd_obras'];

//resenhas sobre suas obras
$sql = "SELECT COUNT(*) AS qtd_resenhas 
               FROM resenha r
               INNER JOIN obra o ON r.resenha_obra_id = o.obra_id
               WHERE o.obra_autor_id = ?";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$resultados_resenhas = mysqli_stmt_get_result($stmt);

$qtd_resenhas = mysqli_fetch_assoc($resultados_resenhas)['qtd_resenhas'];


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style-paginas.css">
</head>

<body class="pagina-autor">
    <?php
    $url = "../listar.php?objeto=autor";
    if(isset($_GET["voltar"])) {
        $voltar = $_GET["voltar"];
        if ($voltar == "fav") {
            $url = '../favoritos.php?objeto=au';
        } else {
            $url = "../listar.php?objeto=autor";
        }       
    }
    $url = urlencode($url);
    echo "<a href='../index.php?url=$url' class='link_menu' target='_top'>voltar</a>";
    ?>

    <div class="autor-container">
    <?php
    if ($autor = mysqli_fetch_assoc($resultados_autor)) {
        $morte = $autor['autor_data_morte'];
        $foto = $autor['autor_foto'];

        if ($morte != null) {
            $morte = strtotime($autor["autor_data_morte"]);
            if ($morte == false) {
                $morte = "<span>Vivo</span>";
            } else {
                $morte = "Morte: <span>" . date('d/m/Y', $morte) . "</span>";
            }
        } else {
            $morte = "<span>Vivo</span>";
        }

        $arquivo = "../fotos/$foto";
        if (!file_exists($arquivo) || $foto == null) {
            $arquivo = "../fotos/padrao-autor.png";
        }

        echo "<div class='autor-card'>";
        echo "<img src='$arquivo' alt='Foto do autor' class='autor-foto'>";
        echo "<h1 class='autor-nome'>" . htmlspecialchars($autor['autor_nome']) . "</h1>";
        echo "<p class='autor-info'><span>Data de nascimento:</span> " . date('d/m/Y', strtotime($autor['autor_data_nasc'])) . "</p>";
        echo "<p class='autor-info'>$morte</p>";
        echo "<p class='autor-stats'>Favoritos: $qtd_favoritos</p>";
        echo "<p class='autor-stats'>Obras: $qtd_obras</p>";
        echo "<p class='autor-stats'>Resenhas: $qtd_resenhas</p>";

        $sql = "SELECT * FROM favorito WHERE favorito_usuario_id = ? AND favorito_id = ? AND lower(favorito_tipo) = 'au'";
        $comando = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($comando, 'ii', $id_user, $id);
        mysqli_stmt_execute($comando);
        $resultado = mysqli_stmt_get_result($comando);
        $favoritou = mysqli_fetch_assoc($resultado);

        if (!$favoritou) {
            echo "<a href='../favoritar.php?id=$id&objeto=au' class='botao'>favoritar</a>";
        } else {
            echo "<a href='../favoritar.php?id=$id&objeto=au' class='botao'>desfavoritar</a>";
        }

        if ($tipo == 'admin') {
            echo "<br><a href='cadastrar.php?id=$id' class='link-editar'>editar</a>";
        }

        echo "</div>";
    } else {
        echo "<p class='autor-erro'>Autor não encontrado.</p>";
    }
    ?>
    </div>
</body>


</html>