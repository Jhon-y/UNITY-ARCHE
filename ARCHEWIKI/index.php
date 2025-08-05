<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/styleindex.css">
    <title>arche</title>
</head>
<body>
    <form action="Login/logout.php" method="post">
        <input type="submit" value="Sair">
    </form>
    <div class="grup">
        <div class="tab">
            <a href="Save/">Save</a> --
            <a href="Save/lista_save.php">Lista Save</a>
        </div>

        <div class="tab">
            <a href="Usuario/">Usuário</a> --
            <a href="Usuario/lista_usuario.php">Lista Usuários</a>
        </div>

        <div class="tab">
            <a href="Habilidade/">Habilidade</a> --
            <a href="Habilidade/lista_habilidade.php">Lista Habilidades</a>
        </div>

        <div class="tab">
            <a href="Personagem/">Personagem</a> --
            <a href="Personagem/lista_personagem.php">Lista Personagens</a>
        </div>
    </div>
</body>
</html>