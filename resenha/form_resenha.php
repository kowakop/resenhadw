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
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nova Resenha</title>
  <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
<style>

body {
  font-family: Arial, sans-serif;
  background: #fff;
  color: #222;
  margin: 0;
  padding: 2vh 3vw;
}

.titulo-pagina {
  text-align: center;
  color: #0078ff;
  font-size: 1.5vh;
  margin-bottom: 2vh;
}

.form-resenha {
  width: 70vw;
  max-width: 80vw;
  margin: 0 auto;
  background: #f7f7f7;
  padding: 2vh 2vw;
  border-radius: 1vw;
  box-shadow: 0 0 1vw rgba(0, 0, 0, 0.1);
}

.label {
  display: block;
  margin: 1vh 0 0.5vh;
  font-weight: bold;
  font-size: 1.5vh;
}

.campo-selecao,
.campo-texto,
.campo-textarea {
  width: 100%;
  padding: 1.2vh 1vw;
  border: 1px solid #ccc;
  border-radius: 0.6vw;
  font-size: 1.5vh;
}

.campo-textarea {
  height: 25vh;
  resize: vertical;
}

.imagem-obra {
  display: block;
  margin: 2vh auto;
  max-width: 25vw;
  max-height: 20vh;
  border-radius: 1vw;
}

.nome-obra {
  text-align: center;
  font-weight: bold;
  color: #0078ff;
  font-size: 2vh;
}

.botao-publicar {
  width: 100%;
  background-color: lightcoral;
  color: #fff;
  border: none;
  border-radius: 0.6vw;
  padding: 1.5vh 0;
  margin-top: 2vh;
  font-weight: bold;
  font-size: 2vh;
  cursor: pointer;
  transition: background 0.2s ease;
}

.botao-publicar:hover {
  background-color: rgba(164, 20, 20, 0.66);
}


</style>
</head>

<body>
  <h2 class="titulo-pagina">Nova resenha</h2>

  <form class="form-resenha" action="salvar.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">

    <label class="label">Obra Resenhada:</label> <br>
    <select name="autor" required onchange="mostrar()" id="select" class="campo-selecao">
      <?php
      $sql = "SELECT * FROM obra";
      $comando = mysqli_prepare($conexao, $sql);
      mysqli_stmt_execute($comando);
      $resultados = mysqli_stmt_get_result($comando);

      while ($obraItem = mysqli_fetch_assoc($resultados)) {
        $nome = $obraItem['obra_nome'];
        $id_obra = $obraItem['obra_id'];
        $foto = $obraItem['obra_foto'];
        $arquivo = "../fotos/$foto";
        if (!file_exists($arquivo) || !$foto) {
          $foto = "padrao-obra.png"; 
        }

        echo "<option value='$id_obra' data-foto='$foto'";
        if ($id_obra == $obra) {
          echo " selected";
        }
        echo ">$nome</option>";
      }
      ?>
    </select> 
    <span id="espaco"></span>

    <img src="#" alt="" id="foto_obra" class="imagem-obra">
    <h2 id="nome_obra" class="nome-obra"></h2>

    <br><br>
    <label class="label">Título:</label> <br>
    <input type="text" name="titulo" value="<?php echo htmlspecialchars($titulo); ?>" required class="campo-texto">
    <br><br><br>

    <textarea name="conteudo" placeholder="Escreva algo... (emojis vão ser suportados)" required class="campo-textarea"><?php echo htmlspecialchars($conteudo); ?></textarea>
    <br><br>

    <button type="submit" class="botao-publicar">Publicar</button>

  </form>

  <script>
    var select = document.getElementById('select');
    var foto_obra = document.getElementById('foto_obra');
    var nome_obra = document.getElementById('nome_obra');
    var espaco = document.getElementById('espaco');

    function mostrar() {
      var opcaoSelecionada = select.options[select.selectedIndex];
      var foto = opcaoSelecionada.getAttribute('data-foto');
      foto_obra.src = "../fotos/" + foto;
      nome_obra.innerText = opcaoSelecionada.text;
      nome_obra.style.margin = "0.83em";
      espaco.innerHTML = "<br><br>";
    }
  </script>
</body>
</html>
