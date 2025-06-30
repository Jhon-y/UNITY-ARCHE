    <?php
    session_start();

    require_once('../valida_login.php');
    if ($_SESSION['tipo'] != 'adm') {
    echo "Acesso negado.";
    exit;
}
    require_once("../Classes/Save.class.php");
    require_once("../Classes/personagem.class.php");
    require_once("../Classes/FormP.class.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $idP = isset($_POST['idP']) ? $_POST['idP'] : 0;
        $idS = isset($_POST['idS']) ? $_POST['idS'] : 0;
        $ascendencia = isset($_POST['ascendencia']) ? $_POST['ascendencia'] : "";
        $tipoP = isset($_POST['tipoP']) ? $_POST['tipoP'] : "";
        $nomePersonagem = isset($_POST['nomePersonagem']) ? $_POST['nomePersonagem'] : "";
        $vida = isset($_POST['vida']) ? $_POST['vida'] : 0;
        $acao = isset($_POST['acao']) ? $_POST['acao'] : "";

    $personagem = new Personagem($idP, $ascendencia, $tipoP, $nomePersonagem, $vida, $idS);

        if ($acao == 'salvar') {
    if ($idP > 0)
        $resultado = $personagem->alterar();
    else
        $resultado = $personagem->inserir();
} elseif ($acao == 'excluir') {
    $resultado = $personagem->excluir();
}


        if ($resultado)
            header("Location: lista_personagem.php");
        else
            echo "Erro ao salvar dados: " . $save;
    }

    elseif ($_SERVER['REQUEST_METHOD'] == 'GET'){
    $formulario = file_get_contents('form_cad_personagem.html');

    $idP = isset($_GET['idP']) ? $_GET['idP'] : 0;
    $resultado = Personagem::listar(1, $idP);

    if ($resultado){
        $personagem = $resultado[0];
$saves = FormP::montaSelect(Save::listar(), 'idS', "", $personagem->getIdS());

$formulario = str_replace('{idP}', $personagem->getIdP(), $formulario);
$formulario = str_replace('{idS}', $saves, $formulario);
$formulario = str_replace('{ascendencia}', $personagem->getAscendencia(), $formulario);
$formulario = str_replace('{tipoP}', $personagem->getTipoP(), $formulario);
$formulario = str_replace('{nomePersonagem}', $personagem->getNomePersonagem(), $formulario);
$formulario = str_replace('{vida}', $personagem->getVida(), $formulario);

    }
    else {
        // Novo registro, idP sempre zero
        $saves = FormP::montaSelect(Save::listar(), 'idS', "", 0);

        $formulario = str_replace('{idS}', $saves, $formulario);
        $formulario = str_replace('{idP}', 0, $formulario);
        $formulario = str_replace('{ascendencia}', '', $formulario);
        $formulario = str_replace('{tipoP}', '', $formulario);
        $formulario = str_replace('{nomePersonagem}', '', $formulario);
        $formulario = str_replace('{vida}', 0, $formulario);
        
    }
    print($formulario);
}

    ?>