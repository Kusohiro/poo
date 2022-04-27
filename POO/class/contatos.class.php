<?php
    class Contatos{
        private $cont_id;
        private $cont_tipo;
        private $cont_descricao;
        private $cont_pf_id; 
        
        public function __construct($id, $tipo, $desc, $pf_id){ 
            $this->cont_id = $id;
            $this->cont_tipo = $tipo;
            $this->cont_descricao = $desc;
            $this->cont_pf_id = $pf_id;
        }

        public function __toString(){
            $str = "ID do contato: ".$this->cont_id.
            "<br>Tipo do contato: ".$this->cont_tipo.
            "<br>Descrição do contato:  ".$this->cont_descricao;
            "<br>ID da pessoa fÍsica: ".$this->cont_pf_id;
            return $str;
        }

        public function setId($id){$this->cont_id = $id;
            if ($id >= 0 && $id <> "") {
                $this->cont_id = $id;
            }
            else 
            throw new Exception("Número de conta inválido ". $id);
        }
        public function getId(){return $this->cont_id;}

        public function setTipo($tipo){$this->cont_tipo = $tipo;
            if ($tipo >= 0 && $tipo <> "" ) {
                $this->cont_tipo = $tipo;
            }else
            throw new Exception("tipo inválido". $tipo);
            
        }
        public function gettipo(){return $this->cont_tipo;}

        public function setPfId($pessoa){$this->cc_pf_id = $pessoa;
            if($pessoa > 0 && $pessoa <> ""){
                $this->cc_pf_id = $pessoa;
            }else
            throw new Exception("Pessoa inválida ". $pessoa);
        }
        public function getPfId(){return $this->cc_pf_id;}

        public function setPf_dt_nascimento($last_alt){$this->cc_dt_ultima_alteracao = $last_alt;
            //$hoje = date('Y/m/d');
            if ($last_alt > 0 && $last_alt <> "") {
                $this->cc_dt_ultima_alteracao = $last_alt;
            }else 
                throw new Exception("Data inválida ". $last_alt);
        }
        public function getPf_dt_nascimento(){return $this->cc_dt_ultima_alteracao;}

        public function inserir(){
            
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('INSERT INTO contatos (cont_tipo, cont_descricao, cont_pf_id) VALUES(:cont_tipo, :cont_descricao, :cont_pf_id)');
            $stmt->bindParam(':cont_tipo', $this->cont_tipo, PDO::PARAM_STR);
            $stmt->bindParam(':cont_descricao', $this->cont_descricao, PDO::PARAM_STR);
            $stmt->bindParam(':cont_pf_id', $this->cont_pf_id, PDO::PARAM_STR);
    
            return $stmt->execute();
            
        }

        public function editar(){
            
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE contatos SET cont_tipo = :cont_tipo, cont_descricao = :cont_descricao, cont_pf_id = :cont_pf_id WHERE cont_id = :cont_id');
        $stmt->bindParam(':cont_id', $this->cont_id, PDO::PARAM_INT);
        $stmt->bindParam(':cont_tipo', $this->cont_tipo, PDO::PARAM_STR);
        $stmt->bindParam(':cont_descricao', $this->cont_descricao, PDO::PARAM_STR);
        $stmt->bindParam(':cont_pf_id', $this->cont_pf_id, PDO::PARAM_STR);

            return $stmt->execute();
            
        }


        public function excluir(){

            $pdo = Conexao::getInstance();
            $stmt = $pdo ->prepare('DELETE FROM contatos WHERE cont_id = :cont_id');
            $stmt->bindParam(':cont_id', $this->cont_id);
            $stmt->execute();
        }
       
}

?>