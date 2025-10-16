<?php
require_once "../verificar_user.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2>Nova resenha</h2>
    <form action="criar_post.php" method="post" enctype="multipart/form-data">
      <textarea name="conteudo" placeholder="Escreva algo... (emojis vão ser suportados, não sei como)" required></textarea>
      <input type="file" name="imagem" accept="image/*" id="imput-img">
      <button type="submit">Publicar</button>
    </form>
</body>
</html>