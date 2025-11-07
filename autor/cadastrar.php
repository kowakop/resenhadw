<?php
    require_once "../conexao.php";
    require_once "../verificar_user.php";

if (isset($_SESSION['tipo'])) {
    if (isset($_GET['id'])) {

        $id = $_GET['id'];

            if ($_SESSION['tipo'] == "admin") {

                $sql = "SELECT * FROM autor WHERE autor_id = ?";
                $comando = mysqli_prepare($conexao, $sql);
        
                mysqli_stmt_bind_param($comando, 'i', $id);
                mysqli_stmt_execute($comando);
        
                $resultados = mysqli_stmt_get_result($comando);
        
                $autor = mysqli_fetch_assoc($resultados);
        
                $nome = $autor['autor_nome'];
                $nascimento = $autor['autor_data_nasc'];
                $morte = $autor['autor_data_morte'];
                $foto = $autor['autor_foto'];
        }
        else {  
            header("Location: ../index.php");
        }
    }
    else {
        
        $id = 0;
        $nome = "";
        $nascimento = "";
        $morte = "";
        $foto= "";
    }
}
else {
    header("Location: ../index.php");}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Autor</title>
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    
    <style>
        body {
            background-color: e4b3b33d;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        #cadastro-autor {
            margin: 5% auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 600px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border: 1px solid #f0bbbbff;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 2em;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            font-size: 1em;
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input[type="text"],
        input[type="date"],
        input[type="file"],
        select {
            width: 100%;
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ffffffff;
            border-radius: 8px;
            box-sizing: border-box;
            background-color: #efebebff;
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        .radio-label {
            display: inline-block;
            font-size: 1em;
            margin-right: 20px;
            color: #333;
        }

        button {
            font-size: 1em;
            border-radius: 8px;
            border: none;
            width: 100%;
            padding: 12px;
            background-color: #f69090ff;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
salvar dados do altor
        button:hover {
            background-color: #eaddddff;
        }

         #data_morte_container {
            display: none;
        }

      

        /* Estilo para o link 'Voltar' */
        a {
            color: #b78989ff;
            font-size: 1.2em;
            text-decoration: underline;
            display: block;
            margin-bottom: 20px;
            text-align: center;
        }

    </style>
</head>

<body>

    <div id="cadastro-autor">
        <h1>Cadastro de Autor</h1>

        <a href="../index.php" target="_top" class="link">Voltar</a>

        <form action="salvar.php?id=<?php echo $id ?>" method="POST" enctype="multipart/form-data">

            <!-- Nome do Autor -->
            <div class="form-group">
                <label for="nome">Nome do Autor:</label>
                <input type="text" id="nome" name="nome" required value="<?php echo $nome ?>" placeholder="Digite o nome do autor">
            </div>

            <!-- Data de Nascimento -->
            <div class="form-group">
                <label for="data_nasc">Data de Nascimento:</label>
                <input type="date" id="data_nasc" name="data_nasc" required value="<?php echo $nascimento ?>">
            </div>

            <!-- Autor Já Morreu -->
            <div class="form-group">
                <label>O autor já morreu?</label><br>
                <input type="radio" name="opcao" value="sim" onclick="mostrar()" <?php if ($morte != "" && $morte != null) echo "checked"; ?>> <span class="radio-label">Sim</span>
                <input type="radio" name="opcao" value="nao" onclick="mostrar()" <?php if ($morte != "" && $morte == null) echo "checked"; ?>> <span class="radio-label">Não</span>
            </div>

            <!-- Data da Morte (aparece se o autor já morreu) -->
            <div class="form-group" id="data_morte_container">
                <label for="data_morte" id="texto_morte">Data da Morte:</label>
                <input type="date" id="data_morte" name="data_morte" value="<?php echo $morte ?>" />
            </div>

            <!-- Foto do Autor -->
            <div class="form-group">
                <label for="foto">Foto do Autor:</label>
                <input type="file" id="foto" name="foto">
            </div>

            <!-- Botão de Submissão -->
            <div class="form-group">
                <button type="submit">Salvar dados do Autor</button>
            </div>

        </form>

        <a href="listar.php" class="link">Confira a listagem de autores já cadastrados!</a>

    </div>

    <script>
        function mostrar() {
            var opcoes = document.getElementsByName("opcao");
            var campo = document.getElementById("data_morte");
            var texto = document.getElementById("texto_morte");
            var container = document.getElementById("data_morte_container");

            selecionado = "";
            for (var i = 0; i < 2; i++) {
                if (opcoes[i].checked) {
                    selecionado = opcoes[i].value;
                    break;
                }
            }

            if (selecionado == "sim") {
                campo.style.display = "block";
                texto.style.display = "block";
                container.style.display = "block";
            } else {
                campo.style.display = "none";
                texto.style.display = "none";
                container.style.display = "none";
            }
        }

        // Chama a função mostrar para ajustar o estado inicial do campo Data da Morte
        mostrar();
    </script>

</body>

</html>
