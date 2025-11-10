<?php
require_once "./conexao.php";
$voltar = $_GET['voltar'];

session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ./login/index.php');
    exit;
}

$id_user = $_SESSION['id'];

// Verifica se o ID da resenha veio na URL
if (!isset($_GET['id'])) {
    header('Location: ./index.php');
    exit;
}

$id_resenha = $_GET['id'];

// Verifica se o usuário já curtiu
$sql = "SELECT * FROM likes WHERE likes_usuario_id = ? AND likes_resenha_id = ?";
$comando = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($comando, 'ii', $id_user, $id_resenha);
mysqli_stmt_execute($comando);
$resultado = mysqli_stmt_get_result($comando);

$curtiu = mysqli_fetch_assoc($resultado);

if (!$curtiu) {
    // Inserir novo like
    $sql = "INSERT INTO likes (likes_usuario_id, likes_resenha_id) VALUES (?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'ii', $id_user, $id_resenha);
} else {
    // Remover like
    $sql = "DELETE FROM likes WHERE likes_usuario_id = ? AND likes_resenha_id = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'ii', $id_user, $id_resenha);
}

mysqli_stmt_execute($comando);
mysqli_stmt_close($comando);


header("Location: http://localhost:81/resenha/pagina.php?voltar=$voltar&id=$id_resenha");
exit;
?>
