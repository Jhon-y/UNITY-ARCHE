<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once('../Classes/Save.class.php');
require_once('../valida_login.php');

    $busca = isset($_GET['busca'])?$_GET['busca']:0;
    $tipo = isset($_GET['tipo'])?$_GET['tipo']:0;
   
    $lista = Save::listar($tipo, $busca);
    $itens = '';
foreach($lista as $save){
    if ($save->getIdU() > 0) {
        $usuarios = Usuario::listar(1, $save->getIdU());
        if (count($usuarios) > 0) {
            $usuario = $usuarios[0];
            // aqui você pode usar $usuario para substituir dados no template
        } else {
            $usuario = null; // ou outro tratamento
        }
    } else {
        $usuario = null;
    }

    $item = file_get_contents('itens_listagem_saves.html');
    $item = str_replace('{idS}',$save->getIdS(),$item);
    $item = str_replace('{descS}',$save->getDescS(),$item);
    $item = str_replace('{progresso}',$save->getProgresso(),$item);

    // Exemplo de substituir nome do usuário, se disponível
    if ($usuario) {
        $item = str_replace('{nomeUsuario}', $usuario->getNome(), $item);
    } else {
        $item = str_replace('{nomeUsuario}', 'Usuário não encontrado', $item);
    }

    $itens .= $item;
}

    $listagem = file_get_contents('listagem_save.html');
    $listagem = str_replace('{itens}',$itens,$listagem);
    print($listagem);
     
?>