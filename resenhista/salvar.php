<?php
    require_once "../conexao.php";

    $nome = $_POST['nome'];
    $data_nasc = $_POST['data_nasc'];
    $nick = $_POST['nick'];



    $nome = trim($nome);
    $data_nasc = trim($data_nasc);
    $nick = trim($nick);

    // para ajustar o tempo

    $tempo_nasc = strtotime($data_nasc);
    $hoje = time();

    // condições em caso do usuário preencher errado

    if ($nome == "" || $data_nasc == "") {
    header("Location: cadastrar.php?e=1");
    }

    if ($tempo_nasc == false) {
        header("Location: cadastrar.php?e=6");
    } 

    elseif ($tempo_nasc > $hoje) {
        header("Location: cadastrar.php?e=7");
    }

    elseif (strlen($nome) > 70){
        header("Location: cadastrar.php?e=14");
    }

    // criando condições para a foto ser salva no banco

    if (isset($_FILES['foto'])) {
        $nome_arquivo = $_FILES['foto']['name'];
        $caminho_temporario = $_FILES['foto']['tmp_name'];

        //pegar a extensão do arquivo
        $extensao = pathinfo($nome_arquivo, PATHINFO_EXTENSION);

        $extensoesValidas = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];


        if (in_array(strtolower($extensao), $extensoesValidas)) {
            //gerar um novo nome
            $novo_nome = uniqid() . "." . $extensao;

            // lembre-se de criar a pasta e de ajustar as permissões.
            $caminho_destino = "../fotos/" . $novo_nome;

            // move a foto para o
            move_uploaded_file($caminho_temporario, $caminho_destino);

        } else {
            header("Location: cadastrar.php");
        }
    }

    // inserindo no banco

    if ($id == 0) {
        //novo
        $sql = "INSERT INTO usuario (usuario_nome, usuario_data_nasc, usuario_nick, usuario_foto) VALUES (?, ?, ?, ?)";

        $comando = mysqli_prepare($conexao, $sql);
        
        mysqli_stmt_bind_param($comando, 'ssss', $nome, $data_nasc, $nick, $novo_nome);
    }

    else {
        //editar
        $sql = "UPDATE usuario SET usuario_nome = ?, usuario_data_nasc = ?, usuario_nick = ?, usuario_foto = ? WHERE usuario_id = ?";
        
        $comando = mysqli_prepare($conexao, $sql);

        mysqli_stmt_bind_param($comando, 'ssssi', $nome, $data_nasc, $nick, $novo_nome, $id);

    }

    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);

    header("Location: ../index.php");

?>