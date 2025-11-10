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

    <!-- MENU à DIREITA -->
    <div id="base_menu">
        <div id="logo_menu">
            <?php
            $url = "resenha/feed.php";
            $url = urlencode($url);
            echo "<a href='./index.php?url=$url'>";
            ?>
                <img src="./fotos/logo.png" id="logo" style="height: 70px;">
            </a>
        </div>
        <hr>
        <br>

        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="feather feather-home icon" viewBox="0 0 24 24" style="color: currentcolor;">
                    <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <path d="M9 22V12h6v10"></path>
                </svg>

        <?php
        $url = "resenha/feed.php";
        $url = urlencode($url);
        echo "<a href='./index.php?url=$url' class='link_menu' >";
        ?>
            <span class="texto_menu">Home</span>
        </a>

        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" class="icon" style="color: currentcolor;">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 21-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
            </svg>

            <?php
            // Obras favoritadas
            $url = "favoritos.php?objeto=ob";
            $url = urlencode($url);
            echo "<a href='./index.php?url=$url' class='link_menu'>";
            echo "<span class='texto_menu'>Obras salvas</span>";
            echo "</a>";

            // Autores favoritados
            $url = "favoritos.php?objeto=au";
            $url = urlencode($url);
            echo "<a href='./index.php?url=$url' class='link_menu'>";
            echo "<span class='texto_menu'>Autores salvos</span>";
            echo "</a>";

            // Resenhas curtidas
            $url = "./resenha/liked.php";
            $url = urlencode($url);
            echo "<a href='./index.php?url=$url' class='link_menu'>";
            echo "<span class='texto_menu'>Resenhas curtidas</span>";
            echo "</a>";

            // Resenhistas favoritadas
            $url = "favoritos.php?objeto=re";
            $url = urlencode($url);
            echo "<a href='./index.php?url=$url' class='link_menu'>";
            echo "<span class='texto_menu'>Resenhistas salvos</span>";
            echo "</a>";
            ?>


        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="icon" style="color: currentcolor;">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m3 21 5-5m-4-4 8 8c3-3 1-5 1-5l6-6h2l-6-6v2l-6 6s-2-2-5 1"></path>
                    </svg>   
        
        <?php
        $url = "listar.php?objeto=obra";
        $url = urlencode($url);
        echo "<a href='./index.php?url=$url' class='link_menu' >";
        ?>
           
        <span class="texto_menu">Obras</span>
        </a>
        
        <?php
        $url = "listar.php?objeto=resenha";
        $url = urlencode($url);
        echo "<a href='./index.php?url=$url' class='link_menu' >";
        ?>
             <span class="texto_menu">Todas as resenhas</span>
        </a>

        <?php
        $url = "listar.php?objeto=autor";
        $url = urlencode($url);
        echo "<a href='./index.php?url=$url' class='link_menu' >";
        ?>
             <span class="texto_menu">Autores</span>
        </a>

        <?php
        $url = "listar.php?objeto=resenhista";
        $url = urlencode($url);
        echo "<a href='./index.php?url=$url' class='link_menu'>";
        ?>
             <span class="texto_menu">Resenhistas</span>
        </a>


        <?php
        $url = "resenha/form_resenha.php";
        $url = urlencode($url);
        echo "<a href='./index.php?url=$url' class='link_menu' >";
        ?>
             <span class="texto_menu">Nova Resenha</span>
        </a>

        <?php
        $url = "resenhista/pagina.php?id=$id_user";
        $url = urlencode($url);
        echo "<a href='./index.php?url=$url' class='link_menu' >";
        ?>
             <span class="texto_menu">Meu Perfil</span>
        </a>



        <hr>
        <?php
        if ($tipo == "admin") {
            $url = "obra/cadastrar.php";
            $url = urlencode($url);

            $url2 = "autor/cadastrar.php";
            $url2 = urlencode($url2);

            echo "
            <div><strong>🔧 ADMIN</strong></div>
            <a href='./index.php?url=$url' class='link_menu' >Cadastrar Obras</a>
            <a href='./index.php?url=$url2' class='link_menu' >Cadastrar Autores</a>
            ";
        }
        ?>

        <hr>
        <a href="./devs/about.php" class="link_menu" target="principal">Sobre Nós</a>
        <a href="./devs/contato.php" class="link_menu" target="principal">Contate-nos</a>
        <a href="./devs/termos.php" class="link_menu" target="principal">Termos</a>
        <a href="./login/deslogar.php" class="link_menu"> Sair</a>
    </div>

        <!-- IFRAME à ESQUERDA -->
         
        <?php
        $url = $_GET['url'] ?? 'resenha/feed.php';
        echo "<iframe src='$url' name='principal' id='principal'></iframe>";
        ?>
</body>
</html>
