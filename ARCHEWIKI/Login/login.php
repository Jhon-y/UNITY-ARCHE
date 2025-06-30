<?php
session_start();
require_once("../Classes/Login.class.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $login = isset($_POST['login'])?$_POST['login']:"";
    $senha = isset($_POST['senha'])?$_POST['senha']:"";
    try{
        $usuario = Login::efetuarLogin($login,$senha);
        if($usuario){
            $_SESSION['idU'] = $usuario->getIdU();
            $_SESSION['nome'] = $usuario->getNome();
            $_SESSION['tipo'] = $usuario->getTipo();
            header("Location: ../index.php");

        }else{
            header("Location: index.html?auth_erro=Usuário ou senha incorretos.");
        }
    }catch (Exception $e){
        header("Location: index.html?auth_erro=".$e->getMessage());

    }
}