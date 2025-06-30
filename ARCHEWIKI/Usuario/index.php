<?php
session_start();

require_once('../valida_login.php');
if ($_SESSION['tipo'] != 'adm') {
    echo "Acesso negado.";
    exit;
}
require_once("../Classes/Usuario.class.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idU = isset($_POST['idU']) ? $_POST['idU'] : 0;
    $nome = isset($_POST['nome']) ? $_POST['nome'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $senha = isset($_POST['senha']) ? $_POST['senha'] : "";
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : "";
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";

    $usuario = new Usuario($idU, $nome, $email, $senha, $tipo);

    if ($acao == 'salvar') {
        if ($idU > 0)
            $resultado = $usuario->alterar();
        else
            $resultado = $usuario->inserir();
    } elseif ($acao == 'excluir') {
        try {
            $resultado = $usuario->excluir();
        } catch (Exception $e) {
            echo "Erro ao excluir: " . $e->getMessage();
            exit;
        }
    }

    if (isset($resultado) && $resultado)
        header("Location: lista_usuario.php");
    else
        echo "Erro ao salvar dados: " . $usuario;
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $formulario = file_get_contents('form_cad_usuario.html');

    $idU = isset($_GET['idU']) ? $_GET['idU'] : 0;
    $resultado = Usuario::listar(1, $idU);

    if ($resultado) {
        $usuario = $resultado[0];
        $formulario = str_replace('{id}', $usuario->getIdU(), $formulario);
        $formulario = str_replace('{nome}', $usuario->getNome(), $formulario);
        $formulario = str_replace('{email}', $usuario->getEmail(), $formulario);
        $formulario = str_replace('{senha}', $usuario->getSenha(), $formulario);
    } else {
        $formulario = str_replace('{id}', 0, $formulario);
        $formulario = str_replace('{nome}', '', $formulario);
        $formulario = str_replace('{email}', '', $formulario);
        $formulario = str_replace('{senha}', '', $formulario);
    }

    print($formulario);
}
?>
