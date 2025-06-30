    <?php
    session_start();

    require_once('../valida_login.php');
    if ($_SESSION['tipo'] != 'adm') {
    echo "Acesso negado.";
    exit;
}

    require_once("../Classes/Save.class.php");
    require_once("../Classes/Form.class.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $idS = isset($_POST['idS']) ? $_POST['idS'] : 0;
        $descS = isset($_POST['descS']) ? $_POST['descS'] : "";
        $progresso = isset($_POST['progresso']) ? $_POST['progresso'] : "";
        $idU = isset($_POST['idU']) ? $_POST['idU'] : 0;
        $acao = isset($_POST['acao']) ? $_POST['acao'] : "";

        $save = new Save($idS, $descS, $progresso, $idU); // ← ADICIONE ESTA LINHA

        if ($acao == 'salvar') {
            if ($idS > 0)
                $resultado = $save->alterar();
            else
                $resultado = $save->inserir();
        } elseif ($acao == 'excluir') {
            $resultado = $save->excluir();
        }

        if ($resultado)
            header("Location: lista_save.php");
        else
            echo "Erro ao salvar dados: " . $save;
    }

    elseif ($_SERVER['REQUEST_METHOD'] == 'GET'){
    $formulario = file_get_contents('form_cad_save.html');

    $idS = isset($_GET['idS']) ? $_GET['idS'] : 0;
    $resultado = Save::listar(1, $idS);

    if ($resultado){
        $save = $resultado[0];
        $usuarios = Form::montaSelect(Usuario::listar(), 'idU', "", $save->getIdU());

        $formulario = str_replace('{idS}', $save->getIdS(), $formulario);
        $formulario = str_replace('{descS}', $save->getDescS(), $formulario);
        $formulario = str_replace('{progresso}', $save->getProgresso(), $formulario);
        $formulario = str_replace('{usuario}', $usuarios, $formulario);
    }
    else {
        // Novo registro, idS sempre zero
        $usuarios = Form::montaSelect(Usuario::listar(), 'idU', "", 0);

        $formulario = str_replace('{idS}', 0, $formulario);
        $formulario = str_replace('{descS}', '', $formulario);
        $formulario = str_replace('{progresso}', '', $formulario);
        $formulario = str_replace('{usuario}', $usuarios, $formulario);
    }
    print($formulario);
}

    ?>