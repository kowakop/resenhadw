<?php
    require_once "../conexao.php";

    $nome = $_POST['nome'];
    $data_nasc = $_POST['data_nasc'];
    $data_morte = $_POST['data_morte'];
    $autor_morto = $_POST['opcao'];



    $nome = trim($nome);
    $data_nasc = trim($data_nasc);
    $data_morte = trim($data_morte);

    // para ajustar o tempo

    $tempo_nasc = strtotime($data_nasc);
    $tempo_morte = strtotime($data_morte);
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

    // condição em caso o autor esteja morto

    if ($autor_morto  == "sim") {

        if ($nome == "" || $data_nasc == "") {
            header("Location: cadastrar.php?e=1");
        }

        if ($tempo_morte == false) {
            header("Location: cadastrar.php?e=6");
        } 

        elseif ($tempo_morte > $hoje) {
            header("Location: cadastrar.php?e=7");
        }
    } 

    else {
        $data_morte = NULL;
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
        $sql = "INSERT INTO autor (autor_nome, autor_data_nasc, autor_data_morte, autor_foto) VALUES (?, ?, ?, ?)";

        $comando = mysqli_prepare($conexao, $sql);
        
        mysqli_stmt_bind_param($comando, 'ssss', $nome, $data_nasc, $data_morte, $novo_nome);
    }

    else {
        //editar
        $sql = "UPDATE autor SET autor_nome = ?, autor_data_nasc = ?, autor_data_morte = ?, autor_foto = ? WHERE autor_id = ?";
        
        $comando = mysqli_prepare($conexao, $sql);

        mysqli_stmt_bind_param($comando, 'ssssi', $nome, $data_nasc, $data_morte, $novo_nome, $id);

    }

    $comando = mysqli_prepare($conexao, $sql);

    mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);

    header("Location: ../index.php");

?>