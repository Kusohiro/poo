<?php
    class Pessoa{
        private $pf_id;
        private $pf_cpf;
        private $pf_nome;
        private $pf_dt_nascimento; 
        
        public function __construct($id, $cpf, $nome, $pf_dt_nascimento){ 
            $this->pf_id = $id;
            $this->pf_cpf = $cpf;
            $this->pf_nome = $nome;
            $this->pf_dt_nascimento = $pf_dt_nascimento;
        }

        public function setId($id){$this->pf_id = $id;}
        public function setCpf($cpf){$this->pf_cpf = $cpf;}
        public function setNome($nome){$this->pf_nome = $nome;}
        public function setPfDt($PfDt){$this->pf_dt_nascimento = $PfDt;}

        public function getId(){return $this->pf_id;}
        public function getCpf(){return $this->pf_cpf;}
        public function getNome(){return $this->pf_nome;}
        public function getPf_dt_nascimento(){return $this->pf_dt_nascimento;}

        public function BuscarDados($id){
            require_once("../conf/Conexao.php");

            $conexao = Conexao::getInstance();

            $query = 'SELECT * FROM pessoa_fisica';
            if($id > 0){
                $query .= ' WHERE pf_id = :id';
                $stmt->bindParam(':id', $id);
            }

                $stmt = $conexao->prepare($query);

                if($stmt->execute())
                    return $stmt->fetchAll();
        
                return false;

        }

        public function __toString(){
            $str = "ID da conta: ".$this->pf_id.
            "<br>Cpf da conta: ".$this->pf_cpf.
            "<br>Nome do cliente: ".$this->pf_nome;
            "<br>Data de nascimento do cliente: ".$this->pf_dt_nascimento;
            return $str;
        }

        public function inserir(){
            
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('INSERT INTO pessoa_fisica (pf_cpf, pf_nome, pf_dt_nascimento) VALUES(:pf_cpf, :pf_nome, :pf_dt_nascimento)');
            $stmt->bindParam(':pf_cpf', $this->pf_cpf, PDO::PARAM_STR);
            $stmt->bindParam(':pf_nome', $this->pf_nome, PDO::PARAM_STR);
            $stmt->bindParam(':pf_dt_nascimento', $this->pf_dt_nascimento, PDO::PARAM_STR);
    
            return $stmt->execute();
            
        }

        public function editar(){
            
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('UPDATE pessoa_fisica SET pf_cpf = :pf_cpf, pf_nome = :pf_nome, pf_dt_nascimento = :pf_dt_nascimento WHERE pf_id = :pf_id');
            $stmt->bindParam(':pf_id', $this->pf_id, PDO::PARAM_INT);
            $stmt->bindParam(':pf_cpf', $this->pf_cpf, PDO::PARAM_STR);
            $stmt->bindParam(':pf_nome', $this->pf_nome, PDO::PARAM_STR);
            $stmt->bindParam(':pf_dt_nascimento', $this->pf_dt_nascimento, PDO::PARAM_STR);

                return $stmt->execute();
            
        }


        public function excluir(){

            $pdo = Conexao::getInstance();
            $stmt = $pdo ->prepare('DELETE FROM pessoa_fisica WHERE pf_id = :pf_id');
            $stmt->bindParam(':pf_id', $this->pf_id);
            $stmt->execute();
        }
       
}

?>