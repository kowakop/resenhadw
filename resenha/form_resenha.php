<?php
require_once "../verificar_user.php";
require_once "../verificar_user.php";

if (isset($_SESSION['tipo'])) {
  if (isset($_GET['id'])) {

    $id = $_GET['id'];

    if ($_SESSION['tipo'] == "admin") {

      $sql = "SELECT * FROM resenha WHERE resenha_id = ?";
      $comando = mysqli_prepare($conexao, $sql);

      mysqli_stmt_bind_param($comando, 'i', $id);
      mysqli_stmt_execute($comando);

      $resultados = mysqli_stmt_get_result($comando);

      $resenha = mysqli_fetch_assoc($resultados);

      $titulo = $resenha['resenha_titulo'];
      $data = $resenha['resenha_data'];
      $conteudo = $resenha['resenha_conteudo'];
      $usuario = $resenha['resenha_usuario_id'];
      $obra = $resenha['resenha_obra_id'];
    } else {
      header("Location: ../index.php");
    }
  } else {

    $id = 0;
    $titulo = "";
    $data = "";
    $conteudo = "";
    $usuario = "";
    $obra = "";
  }
} else {
  header("Location: ../index.php");
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Resenha</title>
  <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
</head>

<body>
  <h2>Nova resenha</h2>
  <form action="criar_post.php" method="post" enctype="multipart/form-data">

    Obra Resenhada: <br>
    <select name="autor" required>
      <?php
      $sql = "SELECT * FROM obra";

      $comando = mysqli_prepare($conexao, $sql);
      mysqli_stmt_execute($comando);
      $resultados = mysqli_stmt_get_result($comando);

      while ($obra = mysqli_fetch_assoc($resultados)) {
        $nome = $obra['obra_nome'];
        $id_obra = $obra['obra_id'];
        $foto = $obra['obra_foto'];

        echo "<option value='$id_obra'";
        if ($id_obra == $id) {
          echo "selected";
        }
        echo ">$nome</option>";
      }
      ?>
    </select> <br><br>
    
    <textarea name="conteudo" placeholder="Escreva algo... (emojis vão ser suportados, não sei como)" required></textarea>
    <button type="submit">Publicar</button>

  </form>
</body>

</html>