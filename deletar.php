<?php
session_start();
require_once "./conexao.php";


if (!isset($_SESSION['id']) || $_SESSION['tipo'] != "admin") {
    header('Location: ./login/index.php');
    exit;
}
$id = $_GET['id'];

$sql1 = "DELETE FROM likes WHERE likes_resenha_id = ?";
$sql2 = "DELETE FROM resenha WHERE resenha_id = ?";

$cmd1 = mysqli_prepare($conexao, $sql1);
mysqli_stmt_bind_param($cmd1, "i", $id);
mysqli_stmt_execute($cmd1);
mysqli_stmt_close($cmd1);

$cmd2 = mysqli_prepare($conexao, $sql2);
mysqli_stmt_bind_param($cmd2, "i", $id);
mysqli_stmt_execute($cmd2);
mysqli_stmt_close($cmd2);


header("Location: ./resenha/feed.php");
exit;
?>
