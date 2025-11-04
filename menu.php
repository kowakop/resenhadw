<?php
session_start();
if (!isset($_SESSION['id'])) exit;
$tipo = $_SESSION['tipo'];
?>
<div style="padding:10px; background:#f0f4ff; height:100%; box-sizing:border-box;">
    <div style="text-align:center; margin-bottom:15px;">
        <img src="./fotos/logo.png" alt="Logo" style="height:70px;">
        <img src="./fotos/Resenhando.png" alt="Resenhando Mangás" style="height:80px;width:250px;">
    </div>

    <a href="index.php" target="_top" style="display:block; padding:8px; text-decoration:none;">🏠 Home</a>
    <a href="./listar.php?objeto=obra" target="_top" style="display:block; padding:8px;">📚 Obras</a>
    <a href="./listar.php?objeto=resenha" target="_top" style="display:block; padding:8px;">📝 Resenhas</a>
    <a href="./listar.php?objeto=autor" target="_top" style="display:block; padding:8px;">👨‍🎨 Autores</a>
    <a href="./resenhista/listar.php" target="_top" style="display:block; padding:8px;">🧑‍💻 Resenhistas</a>
    <hr>
    <?php if ($tipo == "admin"): ?>
        <strong>🔧 ADMIN</strong><br>
        <a href='./obra/cadastrar.php' target="_top" style="display:block; padding:8px;">Cadastrar Obras</a>
        <a href='./autor/cadastrar.php' target="_top" style="display:block; padding:8px;">Cadastrar Autores</a>
    <?php endif; ?>
    <hr>
    <a href="devs/about.html" target="_top" style="display:block; padding:8px;">Sobre Nós</a>
    <a href="devs/contato.html" target="_top" style="display:block; padding:8px;">Contate-nos</a>
    <a href="devs/termos.html" target="_top" style="display:block; padding:8px;">Termos</a>
    <a href="logout.php" target="_top" style="display:block; padding:8px;">🚪 Sair</a>
</div>
