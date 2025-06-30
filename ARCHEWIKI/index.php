<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>arche</title>
</head>
<body>
    <ul>
        <li><a href="Save/">Save</a></li>
        <li><a href="Save/lista_save.php">Lista Save</a></li>

        <li><a href="Usuario/">Usuário</a></li>
        <li><a href="Usuario/lista_usuario.php">Lista Usuários</a></li>

        <li><a href="Habilidade/">Habilidade</a></li>
        <li><a href="Habilidade/lista_habilidade.php">Lista Habilidades</a></li>

        <li><a href="Personagem/">Personagem</a></li>
        <li><a href="Personagem/lista_personagem.php">Lista Personagens</a></li>

    </ul>
  
    <form action="Login/logout.php" method="post">
        <input type="submit" value="Sair">
    </form>
</body>
</html>