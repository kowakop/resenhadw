<?php
    require_once "../conexao.php";
    require_once "../verificar_user.php";

    $id = $_GET['id'];

$sqlUser = "SELECT usuario_id, usuario_nome, usuario_data_nasc, usuario_email, usuario_foto, usuario_nick
             FROM usuario 
             WHERE usuario_id = ?";
$stmt = mysqli_prepare($conexao, $sqlUser);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$resultados_user = mysqli_stmt_get_result($stmt);

//favoritos
$sql = "SELECT COUNT(*) AS qtd_favoritos 
           FROM favorito 
           WHERE favorito_usuario_id = ? AND favorito_tipo = 're'";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$resultados_fav = mysqli_stmt_get_result($stmt);

$qtd_favoritos = mysqli_fetch_assoc($resultados_fav)['qtd_favoritos'];

//resenhas
$sql = "SELECT COUNT(resenha_id) AS qtd_resenhas 
               FROM resenha 
               INNER JOIN obra o ON resenha_obra_id = obra_id
               WHERE obra_autor_id = ?
               group by resenha_id";
$stmt = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$resultados_resenhas = mysqli_stmt_get_result($stmt);

$qtd_resenhas = mysqli_fetch_assoc($resultados_resenhas)['qtd_resenhas'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página do Resenhista</title>
    <style>
        body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #111;
      color: #fff;
    }

    .header {
      background: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1200&q=60') no-repeat center center;
      background-size: cover;
      height: 200px;
    }

    .profile-container {
      display: flex;
      gap: 30px;
      padding: 20px 40px;
      background-color: rgba(0, 0, 0, 0.8);
    }

    .sidebar {
      width: 200px;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 15px;
    }

    .sidebar img {
      width: 130px;
      height: 130px;
      border-radius: 50%;
      border: 3px solid #333;
    }

    .sidebar button {
      width: 100%;
      background: #222;
      border: none;
      color: #fff;
      padding: 10px;
      border-radius: 6px;
      cursor: pointer;
      transition: background 0.2s;
    }

    .sidebar button:hover {
      background: #333;
    }

    .content {
      flex: 1;
    }

    .username {
      font-size: 2rem;
      font-weight: bold;
    }

    .tabs {
      display: flex;
      gap: 20px;
      margin-top: 10px;
    }

    .tab {
      background: #222;
      padding: 6px 14px;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
    }

    .tab.active {
      background: #444;
    }

    .info-section {
      margin-top: 30px;
    }

    .info-item {
      margin-bottom: 15px;
    }

    .info-label {
      color: #bbb;
      display: block;
      font-size: 0.9rem;
    }

    .info-value {
      font-weight: bold;
    }

    .connection-bar {
      background: #222;
      border-radius: 6px;
      padding: 10px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 20px;
    }

    .connection-bar a {
      color: #aaa;
      text-decoration: none;
    }

    .connection-bar a:hover {
      color: #fff;
    }
    </style>
</head>
<body>
    <a href="../listar.php?objeto=resenhista">voltar</a>
    <?php
    if ($usuario = mysqli_fetch_assoc($resultados_user)) {
    $foto = $usuario['usuario_foto'];
    $arquivo = "../fotos/$foto";

        if (!file_exists($arquivo) || $foto == null) {
            $arquivo = "../fotos/padrao-user.jpeg";
        }
        echo "<div class='header'></div>";
        echo "<div class='profile-container'>";
            echo"<div class='sidebar'>";
                echo"<img src='$arquivo'>";
                echo"<button>Favoritar</button>";
            echo"</div>";

            echo"<div class='content'>";
                echo"  <div class='username'> 
                <p>" . htmlspecialchars($usuario['usuario_nick']) . "</p> </div>";

        echo"<div class='tabs'>";
            echo"  <div class='tab active'>Informações</div>";
            echo"  <div class='tab'>Resenhas publicadas</div>";
            echo"  <div class='tab'>Obras favoritas</div>";
            echo"  <div class='tab'>Autores favoritos</div>";
        echo"</div>";

      echo"<div class='info-section'>";
        echo"  <div class='info-item'>";
            echo"    <span class='info-label'>Sobre:</span>";
            echo"    <span class='info-value'>" . htmlspecialchars($usuario['usuario_nome']) .  " <br> </span>";
            echo "<span class='info-value'>" . date('d/m/Y', strtotime($usuario['usuario_data_nasc'])) . "</span>";
      echo  "</div>";

        echo "<div class='info-item'>";
          echo"<span class='info-label'>Contato:</span>";
          echo"<div class='connection-bar'>";
            echo"  <span>" . ($usuario['usuario_email']) . "</span>";
          echo"</div>";
        echo "</div>";

        echo"<div class='info-item'>";
            echo"  <span class='info-label'>Quantidade de resenhas publicadas:</span>";
            echo"  <span class='info-value'>$qtd_resenhas</span>";
        echo"</div>";

        echo"<div class='info-item'>";
            echo"  <span class='info-label'>Usuários que favoritaram " . ($usuario['usuario_nick']) . "</span>";
            echo"  <span class='info-value'>$qtd_resenhas</span>";
        echo"</div>";
      echo"</div>";
    echo"</div>";
  echo"</div>";

        //echo "<img src='$arquivo'>";
        //echo "<h1>" . htmlspecialchars($usuario['usuario_nome']) . "</h1>";
        //echo "<p><span>Data de nascimento:</span> " . date('d/m/Y', strtotime($usuario['usuario_data_nasc'])) . "</span></p>";
        //echo "<p>Favoritos: $qtd_favoritos</p>";
        //echo "<p>Resenhas: $qtd_resenhas</p>";
        if ($tipo == "comum") {
            echo "<a href='cadastrar.php?id=$id'>editar</a>";
        }
        echo "</div>";
    } else {
        echo "Autor não encontrado.";
    }
    ?>
</body>
</html>