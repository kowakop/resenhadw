<?php
require_once "./conexao.php";
require_once "./verificar_user.php";

$id_user = $_SESSION['id'];
$objeto = $_GET['objeto'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Favoritos</title>
<link rel="stylesheet" href="./favoritos.css">

<style>
body {
  font-family: Arial, sans-serif;
  padding: 20px;
}
h2 {
  margin-bottom: 15px;
}
.container {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
}
.card {
  border: 1px solid #ccc;
  padding: 15px;
  width: 200px;
  border-radius: 10px;
  text-align: center;
  transition: 0.2s;
}
.card:hover {
  background: #f5f5f5;
}
.card img {
  width: 100px;
  height: 100px;
  object-fit: cover;
  border-radius: 50%;
}
a {
  text-decoration: none;
  color: black;
}
</style>
</head>
<body>

<?php
if ($objeto == "ob") {
    $titulo = "Obras Favoritadas";
    $sql = "SELECT o.obra_id AS id, o.obra_nome AS nome, o.obra_foto AS foto
            FROM favorito f
            JOIN obra o ON f.favorito_id = o.obra_id
            WHERE f.favorito_usuario_id = ? AND f.favorito_tipo = 'ob'";
    $pagina = "./obra/pagina.php?id=";
    $padrao = "./fotos/padrao-obra.png";
}
elseif ($objeto == "au") {
    $titulo = "Autores Favoritados";
    $sql = "SELECT a.autor_id AS id, a.autor_nome AS nome, a.autor_foto AS foto
            FROM favorito f
            JOIN autor a ON f.favorito_id = a.autor_id
            WHERE f.favorito_usuario_id = ? AND f.favorito_tipo = 'au'";
    $pagina = "./autor/pagina.php?id=";
    $padrao = "./fotos/padrao-autor.png";
}
elseif ($objeto == "re") {
    $titulo = "Resenhistas Favoritados";
    $sql = "SELECT u.usuario_id AS id, u.usuario_nick AS nome, u.usuario_foto AS foto
            FROM favorito f
            JOIN usuario u ON f.favorito_id = u.usuario_id
            WHERE f.favorito_usuario_id = ? AND f.favorito_tipo = 're'";
    $pagina = "./resenhista/pagina.php?id=";
    $padrao = "./fotos/padrao-user.jpeg";
}
else {
    echo "<h2>objeto inválido.</h2>";
}

$comando = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($comando, "i", $id_user);
mysqli_stmt_execute($comando);
$resultado = mysqli_stmt_get_result($comando);

echo "<h2>$titulo</h2>";
echo "<div class='container'>";
    while ($fav = mysqli_fetch_assoc($resultado)) {
        $foto = $fav['foto'];
        $arquivo = "./fotos/$foto";
        $nome = $fav['nome'];
        $fav_id = $fav['id'];
        
        if (!file_exists($arquivo) || !$foto) {
            $arquivo = $padrao;
        }
    
        if ($objeto == "ob") {
            echo "
            <a href='../obra/pagina.php?voltar=fav&id=$fav_id' class='card'>
                <img src='$arquivo'>
                <span>$nome</span>
            </a>";
        }
        elseif ($objeto == "au") {
            echo "
            <a href='../autor/pagina.php?voltar=fav&id=$fav_id' class='card'>
                <img src='$arquivo'>
                <span>$nome</span>
            </a>";
        }
        elseif ($objeto == "re") {
            echo "
            <a href='../resenhista/pagina.php?voltar=fav&id=$fav_id' class='card'>
                <img src='$arquivo'>
                <span>$nome</span>
            </a>";
        }
    }
    
    echo "</div>";

echo "</div>";
?>

</body>
</html>
