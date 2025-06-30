<?php
session_start();

require_once('../valida_login.php');

if ($_SESSION['tipo'] != 'adm') {
    echo "Acesso negado.";
    exit;
}

require_once("../Classes/Habilidade.class.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $idH = isset($_POST['idH'])?$_POST['idH']:0;
    $descH = isset($_POST['descH'])?$_POST['descH']:"";
    $tipoH = isset($_POST['tipoH'])?$_POST['tipoH']:"";
    $efeito = isset($_POST['efeito'])?$_POST['efeito']:"";
    $acao = isset($_POST['acao'])?$_POST['acao']:"";

    $habilidade = new Habilidade($idH,$descH,$tipoH,$efeito);
    if ($acao == 'salvar')
        if ($idH > 0)
            $resultado = $habilidade->alterar();
        else
            $resultado = $habilidade->inserir();
    elseif ($acao == 'excluir')
        $resultado = $habilidade->excluir();

    if ($resultado)
        header("Location: lista_habilidade.php");
    else
        echo "Erro ao salvar dados: ". $habilidade;
}elseif ($_SERVER['REQUEST_METHOD'] == 'GET'){
    $formulario = file_get_contents('form_cad_habilidade.html');

    $idH = isset($_GET['idH'])?$_GET['idH']:0;
    $resultado = Habilidade::listar(1,$idH);
    if ($resultado){
        $habilidade = $resultado[0];
        $formulario = str_replace('{idH}',$habilidade->getIdH(),$formulario);
        $formulario = str_replace('{descH}',$habilidade->getDescH(),$formulario);
        $formulario = str_replace('{tipoH}',$habilidade->getTipoH(),$formulario);
        $formulario = str_replace('{efeito}',$habilidade->getEfeito(),$formulario);
    }else{
        $formulario = str_replace('{idH}',0,$formulario);
        $formulario = str_replace('{descH}','',$formulario);
        $formulario = str_replace('{tipoH}','',$formulario);
        $formulario = str_replace('{efeito}','',$formulario);
    }
    print($formulario); 
}
?>