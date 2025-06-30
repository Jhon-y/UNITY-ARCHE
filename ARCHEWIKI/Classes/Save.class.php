<?php
require_once ("Database.class.php");
require_once ("Usuario.class.php");

 class Save {
    private $idS;
    private $descS;
    private $progresso;
    private $idU;

    // construtor da classe
    public function __construct($idS,$descS,$progresso, $idU){
        $this->setIdS($idS);
        $this->setDescS($descS);
        $this->setProgresso($progresso);
        $this->setIdU($idU);
    }

    // função / interface para aterar e ler
    public function setDescS($descS){
        if ($descS == "")
            throw new Exception("Erro, a descrição deve ser informada!");
        else
            $this->descS = $descS;
    }
    public function setProgresso($progresso){
        if ($progresso == "")
            throw new Exception("Erro, a descrição deve ser informada!");
        else
            $this->progresso = $progresso;
    }
    // cada atributo tem um método set para alterar seu valor
    public function setIdS($idS){
        if ($idS < 0)
            throw new Exception("Erro, o ID deve ser maior que 0!");
        else
            $this->idS = $idS;
    }

    public function setIdU($idU){
        if ($idU < 0)
            throw new Exception("Erro, o ID da U deve ser maior que 0!");
        else
            $this->idU = $idU;
    }


    public function getIdS(): int{
        return $this->idS;
    }
    public function getDescS(): String{
        return $this->descS;
    }
    public function getProgresso(): string{
        return $this->progresso;
    }
    public function getIdU(): int{
        return isset($this->idU)?$this->idU:0;
    }


    // método mágico para imprimir uma atividade
    public function __toString():String{  
        $str = "Saves: $this->getIdS() - $this->getDescS()
                 - Progresso: $this->getProgresso()
                 - IdU: $this->getIdU()";        
        return $str;
    }

    // insere uma atividade no banco 
    public function inserir(): Bool {
    $sql = "INSERT INTO saves (descS, progresso, idU) 
            VALUES (:descS, :progresso, :idU)";
    
    $parametros = array(
        ':descS' => $this->getDescS(),
        ':progresso' => $this->getProgresso(),
        ':idU' => $this->getIdU()
    );

    return Database::executar($sql, $parametros) == true;
}


    public static function listar($tipo = 0, $info = ''): array {
    $sql = "SELECT * FROM saves";
    switch ($tipo) {
        case 1:
            $sql .= " WHERE idS = :info";
            break;
        case 2:
            $sql .= " WHERE descS LIKE :info";
            $info = "%" . $info . "%";
            break;
    }

    $parametros = [];
    if ($tipo > 0)
        $parametros = [':info' => $info];

    $comando = Database::executar($sql, $parametros);

    $saves = [];
    if ($comando) {
        while ($registro = $comando->fetch()) {
            $save = new Save($registro['idS'], $registro['descS'], $registro['progresso'], $registro['idU']);
            $saves[] = $save;  // <-- aqui
        }
    }

    return $saves;
}



    public function alterar(): Bool {
    $sql = "UPDATE saves SET descS = :descS, progresso = :progresso, idU = :idU 
            WHERE idS = :idS";

    $parametros = array(
        ':descS' => $this->getDescS(),
        ':progresso' => $this->getProgresso(),
        ':idU' => $this->getIdU(),
        ':idS' => $this->getIdS()
    );

    return Database::executar($sql, $parametros) == true;
}


    public function excluir():Bool{
        $sql = "DELETE FROM saves
                      WHERE idS = :idS";
        $parametros = array(':idS'=>$this->getidS());
        return Database::executar($sql, $parametros) == true;
     }
}

?>