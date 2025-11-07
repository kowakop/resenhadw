<?php
require_once "../conexao.php";
require_once "../verificar_user.php";
if ($_SESSION['tipo'] == "admin") {
} else {
    header("Location: ../index.php");
}
if (isset($_GET['id'])) {

    $id = $_GET['id'];

    if (isset($_SESSION['tipo'])) {
        if ($_SESSION['tipo'] == "admin" || $_SESSION['id'] == $id) {


            $sql = "SELECT * FROM obra WHERE obra_id = ?";
            $comando = mysqli_prepare($conexao, $sql);

            mysqli_stmt_bind_param($comando, 'i', $id);
            mysqli_stmt_execute($comando);

            $resultados = mysqli_stmt_get_result($comando);

            $obra = mysqli_fetch_assoc($resultados);

            $nome = $obra['obra_nome'];
            $inicio = $obra['obra_data_inicio'];
            $final = $obra['obra_data_final'];
            $capitulo = $obra['obra_qtd_capitulos'];
            $volume = $obra['obra_qtd_volumes'];
            $autor_id = $obra['obra_autor_id'];
        }
    }
} else {

    $id = 0;
    $nome = "";
    $inicio = "";
    $final = "";
    $capitulo = "";
    $volume = "";
    $autor_id = "";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Obra</title>
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">

    <style>
        body {
            background-color: #e4b3b33d;
            font-family: Arial, sans-serif;
        }

        #login {
            margin: min(120px, 12vh) auto;
            background-color: white;
            width: 60%;
            height: auto;
            min-width: 280px;
            max-width: 600px;
            padding: 20px;
            border-radius: 10px;
            font-size: 1.2em;
            box-shadow: rgba(154, 65, 83, 0.3) 3px 3px 3px 3px;
            
        }

        h1 {
            color: black;
            margin: 0.5vh 0 2vh 0;
            font-size: 2em;
            text-align: center;
        }

        input, select {
            width: 100%;
            text-align: left;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #8431312b;
            border-radius: 5px;
        }

        button {
            font-size: 1em;
            border-radius: 5px;
            border: none;
            margin-top: 1vh;
            width: 100%;
            height: 40px;
            background-color: lightcoral;
            color: white;
            padding: 3px;
            box-shadow: rgba(98, 39, 39, 0.16) 3px 3px 3px;
        }

        button:hover {
            background-color: rgba(164, 20, 20, 0.66);
            box-shadow: none;
            color: rgba(255, 255, 255, 1);
        }

        .form-group {
            margin-bottom: 1.5em;
        }

        label {
            font-weight: bold;
        }

        .form-title {
            text-align: center;
            font-size: 1.5em;
            margin-bottom: 1em;
        }

    </style>

</head>

<body>

    <div id="login">
        <h1>Cadastrar Obra</h1>

        <form action="salvar.php" method="post" enctype="multipart/form-data">

            <!-- Nome da Obra -->
            <div class="form-group">
                <label for="nome">Nome da Obra:</label>
                <input type="text" id="nome" name="nome" required value="<?php echo $nome ?>" placeholder="Digite o nome da obra">
            </div>

            <!-- Data de Início -->
            <div class="form-group">
                <label for="inicio">Data de Início:</label>
                <input type="date" id="inicio" name="inicio" required value="<?php echo $inicio ?>">
            </div>

            <!-- Data de Término -->
            <div class="form-group">
                <label for="final">Data de Término:</label>
                <input type="date" id="final" name="final" value="<?php echo $final ?>">
            </div>

            <!-- Quantidade de Capítulos -->
            <div class="form-group">
                <label for="qtd_cap">Quantidade de Capítulos:</label>
                <input type="number" id="qtd_cap" name="qtd_cap" required value="<?php echo $capitulo ?>" placeholder="Informe a quantidade de capítulos">
            </div>

            <!-- Quantidade de Volumes -->
            <div class="form-group">
                <label for="qtd_vol">Quantidade de Volumes:</label>
                <input type="number" id="qtd_vol" name="qtd_vol" required value="<?php echo $volume ?>" placeholder="Informe a quantidade de volumes">
            </div>

            <!-- Autor -->
            <div class="form-group">
                <label for="autor">Autor:</label>
                <select name="autor" id="autor" required>
                    <option value="" disabled selected>Escolha um autor</option>
                    <?php
                    $sql = "SELECT * FROM autor";
                    $comando = mysqli_prepare($conexao, $sql);
                    mysqli_stmt_execute($comando);
                    $resultados = mysqli_stmt_get_result($comando);

                    while ($autor = mysqli_fetch_assoc($resultados)) {
                        $nome = $autor['autor_nome'];
                        $id_autor = $autor['autor_id'];

                        echo "<option value='$id_autor'";
                        if ($id_autor == $autor_id) {
                            echo " selected";
                        }
                        echo ">$nome</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Foto -->
            <div class="form-group">
                <label for="foto">Foto da Capa:</label>
                <input type="file" id="foto" name="foto">
            </div>

            <!-- Botão de Envio -->
            <div class="form-group">
                <button type="submit">Salvar Obra</button>
            </div>

        </form>
    </div>

</body>
</html>
