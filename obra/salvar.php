<?php
require_once "../conexao.php";
// issets verifica se o valor existe caso contrario ele coloca nulo
$id = isset($_POST['id']) ? $_POST['id'] : "";
$nome = isset($_POST['obra_nome']) ? $_POST['obra_nome'] : "";
$data_inicio = isset($_POST['obra_data_inicio']) ? $_POST['obra_data_inicio'] : "";
$data_final = isset($_POST['obra_data_final']) ? $_POST['obra_data_final'] : "";
$qtd_capitulos = isset($_POST['obra_qtd_capitulos']) ? $_POST['obra_qtd_capitulos'] : "";
$qtd_volumes = isset($_POST['obra_qtd_volumes']) ? $_POST['obra_qtd_volumes'] : "";
$autor_id = isset($_POST['obra_autor_id']) ? $_POST['obra_autor_id'] : "";

// retirar espaços
$nome = trim($nome);


// tempo atual
$hoje = time();

// validação
if ($nome == "" || $data_inicio == "" || $qtd_capitulos == "" || $autor_id == "") {
    header("Location: cadastrar.php?e=1"); // campos obrigatórios vazios
    exit;
}

if (strlen($nome) > 255) {
    header("Location: cadastrar.php?e=2"); // nome muito grande
    exit;
}

if (!is_numeric($qtd_capitulos) || $qtd_capitulos <= 0) {
    header("Location: cadastrar.php?e=3"); // qtd capítulos inválida
    exit;
}

if ($qtd_volumes != "" && (!is_numeric($qtd_volumes) || $qtd_volumes < 0)) {
    header("Location: cadastrar.php?e=4"); // qtd volumes inválida
    exit;
}

if (!is_numeric($autor_id) || $autor_id <= 0) {
    header("Location: cadastrar.php?e=5"); // autor inválido
    exit;
}

// upload de imagem
$novo_nome = "padrao-obra.png";

if ($_FILES['obra_foto']['error'] == UPLOAD_ERR_OK) {
    $nome_arquivo = $_FILES['obra_foto']['name'];
    $caminho_temporario = $_FILES['obra_foto']['tmp_name'];
    $extensao = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));

    $extensoesValidas = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];

    if (in_array($extensao, $extensoesValidas)) {
        $novo_nome = uniqid("obra_") . "." . $extensao;
        $caminho_destino = "../fotos/" . $novo_nome;

        move_uploaded_file($caminho_temporario, $caminho_destino);
    } else {
        header("Location: cadastrar.php?e=6"); // extensão inválida
        exit;
    }
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

header("Location: ../index.php");
exit;
?>
