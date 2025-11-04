<?php
    require_once "./conexao.php";
    
    session_start();
    if (!isset($_SESSION['id'])) {
        header('Location: ../login/index.php');
    } else {
        $id = $_SESSION['id'];
        $nome = $_SESSION['nick'];
        $tipo = $_SESSION['tipo'];
    }
    

    if (!isset($_GET["objeto"])) {
        header('Location: ./index.php');
    }

    $objeto = $_GET["objeto"];


    $op2 = Null;
    if ($objeto == 'autor') {
        $palavra = "Autores Cadastrados";
        $op1 = "Data de nascimento";
    }
    else if ($objeto == 'resenha') {
        $palavra ="Resenhas Cadastradas";
        $op1 = "Data de publicação";
    }
    else if ($objeto == 'obra') {
        $palavra = "Obras Cadastradas";
        $op1 = "Data de início";
        $op2 = "<option value='qtd'>Quantidade de capitulos</option>";
    }
    elseif ($objeto == 'resenhista'){
        $palavra = "Resenhistas Cadastrados";
        $op1 = "Maior publicador";
        $op2 = "Mais favoritado";
    }
    else {
        header('Location: ./resenha/feed.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista</title>
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
<style>
        a {
            color: black;
            text-decoration: none;
            padding: 0;
            margin: 20px;
        }
        iframe {
            width: 100%;
            height: 100vh;
            flex-grow: 1;
        }

    </style>
</head>
<body>
    <h2>Lista de <?php echo $palavra; ?></h2>

    <?php
        $url = "../feed.php";
        $url = urlencode($url);
        echo "<a href='./index.php?url=$url' target='principal'>";
        ?>
    Organizar por:
    <select id='select' onchange="filtrar()">

        <option value="alfabetica">Ordem alfabética</option>

        <option value="data"><?php echo $op1; ?></option>
        
        <option value="favorito">Nº de pessoas que favoritaram</option>

        <?php if ($objeto == 'obra') { 
            echo $op2;
        }?>

    </select>
    
    <input type="checkbox" name="inverter" id="inverter" onclick="filtrar()">Inverter

    <br>

    <iframe 
        src='<?php echo "./$objeto/listar.php" ?>' 
        frameborder="0" 
        name="listar_todos" 
        id="listar_todos">
    </iframe>

    <script>
    var select = document.getElementById('select');
    var listar = document.getElementById('listar_todos');
    var inverter = document.getElementById('inverter');

    function filtrar() {
        var filtro = select.value;
        var ordem = '';

        if (inverter.checked) {
            ordem = "invertida";
        }

        listar.src = "./<?php echo $objeto; ?>/listar.php?filtro=" + filtro + "&ordem=" + ordem;
    }
</script>
    
</body>
</html>