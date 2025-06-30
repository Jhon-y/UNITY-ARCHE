<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once('../Classes/Personagem.class.php');
require_once("../Classes/Save.class.php");
require_once('../valida_login.php');

    $busca = isset($_GET['busca'])?$_GET['busca']:0;
    $tipo = isset($_GET['tipo'])?$_GET['tipo']:0;
   
    $lista = Personagem::listar($tipo, $busca);
    $itens = '';
foreach($lista as $personagem){
    if ($personagem->getIdS() > 0) {
        $saves = Save::listar(1, $personagem->getIdS());
        if (count($saves) > 0) {
            $save = $saves[0];
            // aqui você pode usar $usuario para substituir dados no template
        } else {
            $save = null; // ou outro tratamento
        }
    } else {
        $save = null;
    }

    $item = file_get_contents('itens_listagem_personagens.html');
    $item = str_replace('{idP}',$personagem->getIdP(),$item);
    $item = str_replace('{ascendencia}',$personagem->getAscendencia(),$item);
    $item = str_replace('{tipoP}',$personagem->getTipoP(),$item);
    $item = str_replace('{nomePersonagem}',$personagem->getNomePersonagem(),$item);
    $item = str_replace('{vida}',$personagem->getVida(),$item);


    // Exemplo de substituir nome do usuário, se disponível
    if ($save) {
        $item = str_replace('{idS}', $save->getIdS(), $item);
    } else {
        $item = str_replace('{idS}', 'Usuário não encontrado', $item);
    }

    $itens .= $item;
}

    $listagem = file_get_contents('listagem_personagem.html');
    $listagem = str_replace('{itens}',$itens,$listagem);
    print($listagem);
     
?>