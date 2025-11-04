<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: ./login/index.php');
    exit;
} else {
    $id_user = $_SESSION['id'];
    $nick = $_SESSION['nick'];
    $tipo = $_SESSION['tipo'];
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Resenhando Mangás</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            display: flex;
            flex-direction: row;
            height: 100vh;
        }
        #principal {
            flex: 3;
            border: none;
            width: 100%;
            height: 100%;
        }
        #base_menu {
            flex: 1;
            background: #f0f4ff;
            border-left: 2px solid #ccc;
            overflow-y: auto;
            padding: 10px;
        }
        .link_menu {
            display: block;
            color: black;
            text-decoration: none;
            padding: 6px 10px;
            border-radius: 6px;
            margin: 4px 0;
        }
        .link_menu:hover {
            background: #d8e2ff;
        }
        .texto_menu {
            display: inline-block;
            margin-left: 6px;
            vertical-align: middle;
        }
        #logo_menu {
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <!-- IFRAME à ESQUERDA -->
    <iframe src="./resenha/feed.php" name="principal" id="principal"></iframe>

    <!-- MENU à DIREITA -->
    <div id="base_menu">
        <div id="logo_menu">
            <a href="index.php" target="principal">
                <img src="./fotos/logo.png" alt="logo Resenhando Mangás" id="logo" style="height: 70px;">
                <img src="./fotos/Resenhando.png" alt="texto resenhando mangás" id="logo2" style="height: 80px; width: 250px;">
            </a>
        </div>

        <a href="index.php" class="link_menu" target="principal">
            🏠 <span class="texto_menu">Home</span>
        </a>
        <a href="./listar.php?objeto=obra" class="link_menu" target="principal">
            📖 <span class="texto_menu">Obras</span>
        </a>
        <a href="./listar.php?objeto=resenha" class="link_menu" target="principal">
            📝 <span class="texto_menu">Resenhas</span>
        </a>
        <a href="./listar.php?objeto=autor" class="link_menu" target="principal">
            👨‍🎨 <span class="texto_menu">Autores</span>
        </a>
        <a href="./resenhista/index.php" class="link_menu" target="principal">
            🧑‍💻 <span class="texto_menu">Resenhistas</span>
        </a>
        <a href="./obra/index.php" class="link_menu" target="principal">
            🔍 <span class="texto_menu">Pesquisar Mangás</span>
        </a>

        <hr>
        <?php
        if ($tipo == "admin") {
            echo "
            <div><strong>🔧 ADMIN</strong></div>
            <a href='./obra/cadastrar.php' class='link_menu' target='principal'>Cadastrar Obras</a>
            <a href='./autor/cadastrar.php' class='link_menu' target='principal'>Cadastrar Autores</a>
            ";
        }
        ?>

        <hr>
        <a href="./devs/about.html" class="link_menu" target="principal">Sobre Nós</a>
        <a href="./devs/contato.html" class="link_menu" target="principal">Contate-nos</a>
        <a href="./devs/termos.html" class="link_menu" target="principal">Termos</a>
        <a href="./logout.php" class="link_menu">🚪 Sair</a>
    </div>

</body>
</html>
