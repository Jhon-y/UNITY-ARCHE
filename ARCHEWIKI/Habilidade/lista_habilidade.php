<?php
session_start();

require_once('../valida_login.php');
    require_once("../Classes/Habilidade.class.php");
    $busca = isset($_GET['busca'])?$_GET['busca']:0;
    $tipo = isset($_GET['tipo'])?$_GET['tipo']:0;
   
    $lista = Habilidade::listar($tipo, $busca);
    $itens = '';
    foreach($lista as $habilidade){
        $item = file_get_contents('itens_listagem_habilidades.html');
        $item = str_replace('{idH}',$habilidade->getIdH(),$item);
        $item = str_replace('{descH}',$habilidade->getdescH(),$item);
        $item = str_replace('{tipoH}',$habilidade->getTipoH(),$item);
        $item = str_replace('{efeito}',$habilidade->getEfeito(),$item);
        $itens .= $item;
    }
    $listagem = file_get_contents('listagem_habilidade.html');
    $listagem = str_replace('{itens}',$itens,$listagem);
    print($listagem);
     
?>