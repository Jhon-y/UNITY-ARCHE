<?php
require_once ("Database.class.php");

class Habilidade{
    private $idH;
    private $descH;
    private $tipoH;
    private $efeito;

    // construtor da classe
    public function __construct($idH,$descH,$tipoH,$efeito){
        $this->setIdH($idH);
        $this->setDescH($descH);
        $this->setTipoH($tipoH);
        $this->setEfeito($efeito);
    }

    public function setIdH($idH){
        if ($idH < 0)
            throw new Exception('Erro. O ID deve ser maior ou igual a 0');
        else
            $this->idH = $idH;
    }

    public function setDescH($descH){
        if ($descH == "")
            throw new Exception('Erro. Informe uma descrição.');
        else
            $this->descH = $descH;
    }

    public function setTipoH($tipoH){
        if ($tipoH == "")
            throw new Exception('Erro. Informe uma descrição.');
        else
            $this->tipoH = $tipoH;
    }


    public function setEfeito($efeito){
        if ($efeito == "") // regras para efeito
            throw new Exception('Erro. Informe um efeito válido.');
        else
            $this->efeito = $efeito;
    }

    public function getIdH(){return $this->idH;}
    public function getDescH(){return $this->descH;}
    public function getTipoH(){return $this->tipoH;}
    public function getEfeito(){return $this->efeito;}

    // método mágico para imprimir uma atividade
    public function __toString():String{  
        $str = "Habilidade: $this->getIdH() - $this->getDescH() - $this->getTipoH() - $this->getEfeito() ";        
        return $str;
    }

    // insere uma atividade no banco 
    public function inserir(): Bool {
    $sql = "INSERT INTO habilidade 
                (descH, tipoH, efeito)
            VALUES(:descH, :tipoH, :efeito)";
    
    $parametros = array(
        ':descH' => $this->getDescH(),
        ':tipoH' => $this->getTipoH(),     // Correto agora
        ':efeito' => $this->getEfeito()    // Corrigido: E maiúsculo
    );
    
    return Database::executar($sql, $parametros) == true;
}


    public static function listar($tipo=0, $info=''):Array{
        $sql = "SELECT * FROM habilidade";
        switch ($tipo){
            case 0: break;
            case 1: $sql .= " WHERE idH = :info ORDER BY idH"; break; // filtro por ID
            case 2: $sql .= " WHERE descH like :info ORDER BY descH"; $info = '%'.$info.'%'; break; // filtro por descrição
            case 3: $sql .= " WHERE tipoH like :info ORDER BY tipoH"; $info = '%'.$info.'%'; break; // filtro por descrição
            case 4: $sql .= " WHERE efeito like :info ORDER BY efeito"; $info = '%'.$info.'%'; break; // filtro por descrição
        }
        $parametros = array();
        if ($tipo > 0)
            $parametros = [':info'=>$info];

        $comando = Database::executar($sql, $parametros);
        $habilidades = [];
        while ($registro = $comando->fetch()){
            $habilidade = new Habilidade($registro['idH'],$registro['descH'],$registro['tipoH'],$registro['efeito']);
            array_push($habilidades,$habilidade);
        }
        return $habilidades;
    }

    public function alterar():Bool{       
       $sql = "UPDATE habilidade
                  SET descH = :descH, 
                      tipoH = :tipoH,
                      efeito = :efeito
                WHERE idH = :idH";
         $parametros = array(':idH'=>$this->getIdH(),
                        ':descH'=>$this->getDescH(),
                        ':tipoH'=>$this->getTipoH(),
                        ':efeito'=>$this->getEfeito());
        return Database::executar($sql, $parametros) == true;
    }

    public function excluir():Bool{
        $sql = "DELETE FROM habilidade
                      WHERE idH = :idH";
        $parametros = array(':idH'=>$this->getIdH());
        return Database::executar($sql, $parametros) == true;
     }
}
?>