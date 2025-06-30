<?php
require_once ("Login.class.php");
require_once ("Database.class.php");

class Usuario{
    private $idU;
    private $nome;
    private $email; // login
    private $senha;
    private $login;
    private $tipo; // objeto login

    // construtor da classe
    public function __construct($idU,$nome,$email,$senha,$tipo){
        $this->setIdU($idU);
        $this->setNome($nome);
        $this->setEmail($email);
        $this->setSenha($senha);
        $this->setTipo($tipo);

      //  $this->login->setIdSession(1);
    }

    public function setLogin(Login $login){
        $this->login = $login;
    }

    public function setIdU($idU){
        if ($idU < 0)
            throw new Exception('Erro. O ID deve ser maior ou igual a 0');
        else
            $this->idU = $idU;
    }

    public function setNome($nome){
        if ($nome == "")
            throw new Exception('Erro. Informe um nome.');
        else
            $this->nome = $nome;
    }

    public function setEmail($email){
        $padrao = "/^[_a-z0-9-+]+(\.[_a-z0-9-+]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
        if (($email == "") && !preg_match($padrao,strtolower($email)))
            throw new Exception('Erro. Informe um email.');
        else
            $this->email = $email;
    }


    public function setSenha($senha){
        if ($senha == "") // regras para senha
            throw new Exception('Erro. Informe uma senha válida.');
        else
            $this->senha = $senha;
    }
    public function setTipo($tipo){
        if ($tipo == "") // regras para tipo
            throw new Exception('Erro. Informe uma tipo válida.');
        else
            $this->tipo = $tipo;
    }

    public function getIdU(){return $this->idU;}
    public function getNome(){return $this->nome;}
    public function getEmail(){return $this->email;}
    public function getSenha(){return $this->senha;}
    public function getTipo(){return $this->tipo;}


    // método mágico para imprimir uma atividade
    public function __toString():String{  
        $str = "Usuario: $this->getIdU() - $this->getNome() - $this->getEmail()";        
        return $str;
    }

    // insere uma atividade no banco 
    public function inserir():Bool{
        // montar o sql/ query
        $sql = "INSERT INTO usuario 
                    (nome, email, senha, tipo)
                    VALUES(:nome, :email, :senha, :tipo)";
        
        $parametros = array(':nome'=>$this->getNome(),
                            ':email'=>$this->getEmail(),
                            ':senha'=>$this->getSenha(),
                            ':tipo'=>$this->getTipo());
        
        return Database::executar($sql, $parametros) == true;
    }

    public static function listar($tipo=0, $info=''):Array{
        $sql = "SELECT * FROM usuario";
        switch ($tipo){
            case 0: break;
            case 1: $sql .= " WHERE idU = :info ORDER BY idU"; break; // filtro por ID
            case 2: $sql .= " WHERE nome like :info ORDER BY nome"; $info = '%'.$info.'%'; break; // filtro por descrição
        }
        $parametros = array();
        if ($tipo > 0)
            $parametros = [':info'=>$info];

        $comando = Database::executar($sql, $parametros);
        $usuarios = [];
        while ($registro = $comando->fetch()){
            $usuario = new Usuario($registro['idU'],$registro['nome'],$registro['email'],$registro['senha'],$registro['tipo']);
            array_push($usuarios,$usuario);
        }
        return $usuarios;
    }

    public function alterar():Bool{       
       $sql = "UPDATE usuario
                  SET nome = :nome, 
                      email = :email,
                      senha = :senha,
                      tipo = :tipo
                WHERE idU = :idU";
         $parametros = array(':idU'=>$this->getIdU(),
                        ':nome'=>$this->getNome(),
                        ':email'=>$this->getEmail(),
                        ':senha'=>$this->getSenha(),
                        ':tipo'=>$this->getTipo());
        return Database::executar($sql, $parametros) == true;
    }

    public function excluir(): Bool {
    // Verificar se há saves relacionados a este usuário
    $sqlVerifica = "SELECT COUNT(*) as total FROM saves WHERE idU = :idU";
    $parametrosVerifica = [':idU' => $this->getIdU()];
    $comando = Database::executar($sqlVerifica, $parametrosVerifica);
    $resultado = $comando->fetch();

    if ($resultado && $resultado['total'] > 0) {
        throw new Exception("Não é possível excluir o usuário. Existem saves vinculados a ele.");
    }

    // Caso não haja saves vinculados, exclui o usuário
    $sql = "DELETE FROM usuario WHERE idU = :idU";
    $parametros = [':idU' => $this->getIdU()];
    return Database::executar($sql, $parametros) == true;
}

}
?>