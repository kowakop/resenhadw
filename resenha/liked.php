<?php
require_once "../conexao.php";
require_once "../verificar_user.php"; 

$id_user = $_SESSION['id']; 


$sql = "SELECT *
        FROM likes 
        JOIN resenha ON likes_resenha_id = resenha_id
        WHERE likes_usuario_id = ?";

$comando = mysqli_prepare($conexao, $sql);
mysqli_stmt_bind_param($comando, "i", $id_user);
mysqli_stmt_execute($comando);
$resultado = mysqli_stmt_get_result($comando);
?>

<h2>Resenhas likes</h2>

<div class="lista_resenhas">
<?php
while ($resenha = mysqli_fetch_assoc($resultado)) {
    echo "<div class='card_resenha'>";
    echo "<h3>" . htmlspecialchars($resenha['resenha_titulo']) . "</h3>";
    echo "<a href='../index.php?url=" . urlencode("resenha/pagina.php?voltar=liked&id=" . $resenha['resenha_id']) . "' target='_top'>Ver resenha completa</a>";
    echo "</div><br>";
}
?>
</div>
