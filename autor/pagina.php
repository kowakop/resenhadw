<?php
    require_once "../conexao.php";

    $sql = "SELECT autor_id, autor_nome, autor_data_nasc, autor_data_morte, autor_foto FROM autor WHERE autor_id = ?";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "i", $id); //transforma "?" em id 
    mysqli_stmt_execute($comando);
    $resultados = mysqli_stmt_get_result($comando);

    if ($autor = mysqli_fetch_assoc($resultado)) {
        echo "<h1>" . $autor['autor_nome'] . "</h1>";
        echo "<p><strong>Data de nascimento:</strong> " . $autor['autor_data_nasc'] . "</p>";
        echo "<p><strong>Data de morte:</strong> " . $autor['autor_data_morte'] . "</p>";
        echo "<img src='../fotos/";
    } 
    else {
        echo "Autor não encontrado.";
}



?>