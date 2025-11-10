<?php
require_once "../conexao.php";


$id = $_GET['id'];
$nome = isset($_POST['nome']) ? $_POST['nome'] : "";
$data_inicio = isset($_POST['inicio']) ? $_POST['inicio'] : "";
$data_final = isset($_POST['final']) ? $_POST['final'] : "";
$qtd_capitulos = isset($_POST['qtd_cap']) ? $_POST['qtd_cap'] : "";
$qtd_volumes = isset($_POST['qtd_vol']) ? $_POST['qtd_vol'] : "";
$autor_id = isset($_POST['autor']) ? $_POST['autor'] : "";

// retirar espaços
$nome = trim($nome);


// tempo atual
$hoje = time();


if ($nome == "" || $data_inicio == "" || $qtd_capitulos == "" || $autor_id == "") {
    header("Location: cadastrar.php?e=1"); 
    exit;
}

if (strlen($nome) > 255) {
    header("Location: cadastrar.php?e=2"); 
    exit;
}

if (!is_numeric($qtd_capitulos) || $qtd_capitulos <= 0) {
    header("Location: cadastrar.php?e=3"); 
    exit;
}

if ($qtd_volumes != "" && (!is_numeric($qtd_volumes) || $qtd_volumes < 0)) {
    header("Location: cadastrar.php?e=4"); 
    exit;
}

$tempo_inicio = strtotime($data_inicio);
$tempo_final = !empty($data_final) ? strtotime($data_final) : 0;


if ($tempo_inicio == false) {
    header("Location: cadastrar.php?e=6");
    exit;
}

if ($data_final != "" && $tempo_final == false) {
    header("Location: cadastrar.php?e=7"); 
    exit;
}


if ($tempo_inicio > time()) {
    header("Location: cadastrar.php?e=8");
    exit;
}


if ($tempo_final != 0 && $tempo_final > time()) {
    header("Location: cadastrar.php?e=8"); 
    exit;
}

if (!$autor_id || $autor_id <= 0) {
    header("Location: cadastrar.php?e=5"); 
    exit;
}

if (!empty($_FILES['foto']['name'])) {
    $nome_arquivo = $_FILES['foto']['name'];
    $caminho_temporario = $_FILES['foto']['tmp_name'];


    $extensao = pathinfo($nome_arquivo, PATHINFO_EXTENSION);

    $extensoesValidas = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];


    if (in_array(strtolower($extensao), $extensoesValidas)) {

        $novo_nome = uniqid() . "." . $extensao;


        $caminho_destino = "../fotos/" . $novo_nome;

 
        move_uploaded_file($caminho_temporario, $caminho_destino);

    } else {
        header("Location: cadastrar.php");
    }
} elseif ($id != 0) {
    $sql_foto = mysqli_query($conexao, "SELECT obra_foto FROM obra WHERE obra_id = $id");
    $dados_foto = mysqli_fetch_assoc($sql_foto);
    $novo_nome = $dados_foto['obra_foto'];
}


// inserindo ou atualizando no banco
if ($id == 0 || $id == "") {
    $sql = "INSERT INTO obra 
            (obra_nome, obra_data_inicio, obra_data_final, obra_qtd_capitulos, obra_qtd_volumes, obra_autor_id, obra_foto) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'sssiiis', $nome, $data_inicio, $data_final, $qtd_capitulos, $qtd_volumes, $autor_id, $novo_nome);
} else {
    $sql = "UPDATE obra 
            SET obra_nome = ?, obra_data_inicio = ?, obra_data_final = ?, obra_qtd_capitulos = ?, obra_qtd_volumes = ?, obra_autor_id = ?, obra_foto = ? 
            WHERE obra_id = ?";

    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, 'sssiiisi', $nome, $data_inicio, $data_final, $qtd_capitulos, $qtd_volumes, $autor_id, $novo_nome, $id);
}

mysqli_stmt_execute($comando);
mysqli_stmt_close($comando);

header("Location: ../listar.php?objeto=obra");
exit;
?>
