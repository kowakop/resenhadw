<?php
    require_once "../conexao.php";

    $nome = $_POST['nome'];
    $data_nasc = $_POST['data_nasc'];
    $data_morte = $_POST['data_morte'];
    $foto = $_POST['foto'];

    $nome = trim($nome);
    $data_nasc = trim($data_nasc);
    $data_morte = trim($data_morte);

    // para ajustar o tempo

    $tempo = strtotime($data_nasc || $data_morte);
    $hoje = time();

    // condições em caso do usuário preencher errado

    if ($nome == "" || $data_nasc == "" || $data_morte == "") {
    header("Location: ../index.php?e=1");
    }

    if ($tempo === false) {
        header("Location: index.php?e=6");
    } 

    elseif ($tempo > $hoje) {
        header("Location: index.php?e=7");
    }

    elseif (strlen($nome) > 70){
        header("Location: index.php?e=14");
    }

    // criando condições para a foto ser salva no banco

    if (!isset($_FILES['foto'])) {
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
            header("Location: index.php?e=15");
        }
    }

    // inserindo no banco

    $sql = "INSERT INTO autor (autor_nome, autor_data_nasc, autor_data_morte, autor_foto) 
    VALUES (?, ?, ?, ?)";

    $comando = mysqli_prepare($conexao, $sql);
    
    mysqli_stmt_bind_param($comando, 'ssss', $nome, $data_nasc, $data_morte, $novo_nome);

    mysqli_stmt_execute($comando);

    mysqli_stmt_close($comando);

    header("Location: ../index.php");

?>