<?php
require_once("Database.class.php");

class Personagem {
    private $idP;
    private $ascendencia;
    private $tipoP;
    private $nomePersonagem;
    private $vida;
    private $idS;

    public function __construct($idP, $ascendencia, $tipoP, $nomePersonagem, $vida, $idS) {
        $this->setIdP($idP);
        $this->setAscendencia($ascendencia);
        $this->setTipoP($tipoP);
        $this->setNomePersonagem($nomePersonagem);
        $this->setVida($vida);
        $this->setIdS($idS);
    }

    // SETTERS
    public function setIdP($idP) {
        $this->idP = $idP;
    }

    public function setAscendencia($ascendencia) {
        $this->ascendencia = $ascendencia;
    }

    public function setTipoP($tipoP) {
        $this->tipoP = $tipoP;
    }

    public function setNomePersonagem($nomePersonagem) {
        $this->nomePersonagem = $nomePersonagem;
    }

    public function setVida($vida) {
        $this->vida = $vida;
    }

    public function setIdS($idS) {
        $this->idS = $idS;
    }

    // GETTERS
    public function getIdP() {
        return $this->idP;
    }

    public function getAscendencia() {
        return $this->ascendencia;
    }

    public function getTipoP(): string {
        return $this->tipoP;
    }

    public function getNomePersonagem(): string {
        return $this->nomePersonagem;
    }

    public function getVida(): string {
        return $this->vida;
    }

    public function getIdS(): int {
        return $this->idS;
    }

    // INSERIR
    public function inserir(): bool {
        $sql = "INSERT INTO personagem (nomePersonagem, tipoP, ascendencia, vida, idS) 
                VALUES (:nomePersonagem, :tipoP, :ascendencia, :vida, :idS)";
        
        $parametros = array(
            ':nomePersonagem' => $this->getNomePersonagem(),
            ':tipoP' => $this->getTipoP(),
            ':ascendencia' => $this->getAscendencia(),
            ':vida' => $this->getVida(),
            ':idS' => $this->getIdS()
        );

        return Database::executar($sql, $parametros) == true;
    }

    // ALTERAR
    public function alterar(): bool {
        $sql = "UPDATE personagem 
                   SET nomePersonagem = :nomePersonagem, 
                       tipoP = :tipoP, 
                       ascendencia = :ascendencia, 
                       vida = :vida, 
                       idS = :idS
                 WHERE idP = :idP";

        $parametros = array(
            ':nomePersonagem' => $this->getNomePersonagem(),
            ':tipoP' => $this->getTipoP(),
            ':ascendencia' => $this->getAscendencia(),
            ':vida' => $this->getVida(),
            ':idS' => $this->getIdS(),
            ':idP' => $this->getIdP()
        );

        return Database::executar($sql, $parametros) == true;
    }

    // EXCLUIR
    public function excluir(): bool {
        $sql = "DELETE FROM personagem WHERE idP = :idP";
        $parametros = array(':idP' => $this->getIdP());
        return Database::executar($sql, $parametros) == true;
    }

    // LISTAR
    public static function listar($tipo = 0, $info = ''): array {
        $sql = "SELECT * FROM personagem";
        switch ($tipo) {
            case 0: break;
            case 1: $sql .= " WHERE idS = :info ORDER BY idS"; break; // filtro por ID
            case 2: $sql .= " WHERE idP like :info ORDER BY idP"; $info = '%'.$info.'%'; break; // filtro por descrição
            case 3: $sql .= " WHERE ascendencia like :info ORDER BY ascendencia"; $info = '%'.$info.'%'; break; // filtro por descrição
            case 4: $sql .= " WHERE tipoP like :info ORDER BY tipoP"; $info = '%'.$info.'%'; break; // filtro por descrição        
            case 5: $sql .= " WHERE nomePersonagem like :info ORDER BY nomePersonagem"; $info = '%'.$info.'%'; break; // filtro por descrição
            case 6: $sql .= " WHERE vida like :info ORDER BY vida"; $info = '%'.$info.'%'; break;
        }

        $parametros = [];
        if ($tipo > 0)
            $parametros = [':info' => $info];

        $comando = Database::executar($sql, $parametros);

        $personagens = [];
        if ($comando) {
            while ($registro = $comando->fetch()) {
                $personagem = new Personagem(
                    $registro['idP'],
                    $registro['ascendencia'],
                    $registro['tipoP'],
                    $registro['nomePersonagem'],
                    $registro['vida'],
                    $registro['idS']
                );
                $personagens[] = $personagem;
            }
        }

        return $personagens;
    }

    public function __toString(): string {
        return "ID: {$this->getIdP()} | Nome: {$this->getNomePersonagem()} | Tipo: {$this->getTipoP()}";
    }
}
?>
