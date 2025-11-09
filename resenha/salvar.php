<?php
require_once "../conexao.php";
require_once "../verificar_user.php";

if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit;
}

$id_usuario = $_SESSION['id']; // id do usuário logado

// Coleta dos dados vindos do form
$titulo = trim($_POST['titulo']);
$conteudo = trim($_POST['conteudo']);
$id_obra = isset($_POST['autor']) ? intval($_POST['autor']) : 0;


if ($titulo == "" || $conteudo == "" || $id_obra == 0) {
    header("Location: cadastrar.php?e=1");
    exit;
}


if (strlen($titulo) > 100) {
    header("Location: cadastrar.php?e=2");
    exit;
}


$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id == 0) {

    $sql = "INSERT INTO resenha (resenha_titulo, resenha_conteudo, resenha_usuario_id, resenha_obra_id)
            VALUES (?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'ssii', $titulo, $conteudo, $id_usuario, $id_obra);
} else {

    // condição para admin editar
    if ($_SESSION['tipo'] != "admin") {
        header("Location: ../index.php");
        exit;
    }

    $sql = "UPDATE resenha 
            SET resenha_titulo = ?, resenha_conteudo = ?, resenha_obra_id = ?
            WHERE resenha_id = ?";
    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($comando, 'ssii', $titulo, $conteudo, $id_obra, $id);
}

// quando salva cria dois Iframe tem que ver os bgui aí ze *sun, achei uma solução em js pra isso ae
mysqli_stmt_execute($comando);
mysqli_stmt_close($comando);

// windows.top acessa a janela principal e location href é um href, leva o cabra para a janela escolhida
echo "<script>
    window.top.location.href = '../index.php';
</script>";
exit;
