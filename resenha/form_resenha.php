<?php
require_once "../conexao.php";
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
  <form action="salvar.php" method="post" enctype="multipart/form-data">

    Obra Resenhada: <br>
    <select name="autor" required onchange="mostrar()" id="select">
      <?php
      $sql = "SELECT * FROM obra";
      $comando = mysqli_prepare($conexao, $sql);
      mysqli_stmt_execute($comando);
      $resultados = mysqli_stmt_get_result($comando);

      while ($obraItem = mysqli_fetch_assoc($resultados)) {
        $nome = $obraItem['obra_nome'];
        $id_obra = $obraItem['obra_id'];
        $foto = $obraItem['obra_foto'];

        echo "<option value='$id_obra' data-foto='$foto'";
        if ($id_obra == $obra) {
          echo " selected";
        }
        echo ">$nome</option>";
      }
      ?>
    </select> <br><br>

    <img src="#" alt="" id="foto_obra" style="max-width:200px;">
    <h2 id="nome_obra"></h2>

    <br><br>

    Título: <br>
    <input type="text" name="titulo" value="<?php echo htmlspecialchars($titulo); ?>" required>
    <br><br><br>

    <textarea name="conteudo" placeholder="Escreva algo... (emojis vão ser suportados)" required><?php echo htmlspecialchars($conteudo); ?></textarea>
    <br><br>

    <button type="submit">Publicar</button>

  </form>

  <script>
    var select = document.getElementById('select');
    var foto_obra = document.getElementById('foto_obra');
    var nome_obra = document.getElementById('nome_obra');

    function mostrar() {
      var opcaoSelecionada = select.options[select.selectedIndex];
      var foto = opcaoSelecionada.getAttribute('data-foto');
      foto_obra.src = "../fotos/" + foto;
      nome_obra.innerText = opcaoSelecionada.text;
    }


  </script>
</body>
