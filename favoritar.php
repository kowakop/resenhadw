<?php
require_once "./conexao.php";

session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ./login/index.php');
    exit;
} else {
    $id_user = $_SESSION['id'];
    $nome = $_SESSION['nick'];
    $tipo = $_SESSION['tipo'];
}

if (isset($_GET['objeto']) && isset($_GET['id'])) {
    if ($_GET['objeto'] == "re") {
        $url = "./resenhista/pagina.php?id=";
    } elseif ($_GET['objeto'] == "ob") {
        $url = "./obra/pagina.php?id=";
    } elseif ($_GET['objeto'] == "au") {
        $url = "./autor/pagina.php?id=";
    } else {
        header('Location: ./login/index.php');
    }
    
    $id = $_GET['id'];
    $objeto = $_GET['objeto'];
    $url = $url . $id;
}

$sql = "SELECT * FROM favorito WHERE favorito_usuario_id = ? AND favorito_id = ? AND favorito_tipo = ?";
$comando = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($comando, 'iis', $id_user, $id, $_GET['objeto']);
mysqli_stmt_execute($comando);
$resultado = mysqli_stmt_get_result($comando);

$favoritou = mysqli_fetch_assoc($resultado);

if (!$favoritou) {
    $sql = "INSERT INTO favorito (favorito_usuario_id, favorito_id, favorito_tipo) VALUES (?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'iis', $id_user, $id, $_GET['objeto']);
}
else {
    $sql = "DELETE FROM favorito WHERE favorito_usuario_id = ? AND favorito_id = ? AND favorito_tipo = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'iis', $id_user, $id, $_GET['objeto']);
}

mysqli_stmt_execute($comando);
mysqli_stmt_close($comando);

header("Location: $url");

?>
