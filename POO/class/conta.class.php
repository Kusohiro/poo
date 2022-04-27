<?php
    require_once("../conf/Conexao.php");
    class Conta{
        private $cc_numero;
        private $cc_saldo;
        private $cc_pf_id;
        private $cc_dt_ultima_alteracao; 
        
        public function __construct($numero, $saldo, $pfid, $pf_dt){ 
            $this->setId($numero);
            $this->setSaldo($saldo);
            $this->setPfid($pfid);
            $this->setPf_dt_nascimento($pf_dt);
        }

        public function setId($id){$this->cc_numero = $id;
            if ($id >= 0 && $id <> "") {
                $this->cc_numero = $id;
            }
            else 
            throw new Exception("Número de conta inválido ". $id);
        }

        public function getId(){return $this->cc_numero;}

        public function setSaldo($saldo){$this->cc_saldo = $saldo;
            if ($saldo >= 0 && $saldo <> "" ) {
                $this->cc_saldo = $saldo;
            }else
            throw new Exception("Saldo inválido". $saldo);
            
        }
        public function getSaldo(){return $this->cc_saldo;}

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

        public function __toString(){
            $str = "ID da conta: ".$this->cc_numero.
            "<br>Saldo da conta: ".$this->cc_saldo.
            "<br>Id da pessoa física:  ".$this->cc_pf_id;
            "<br>Alteração: ".$this->cc_dt_ultima_alteracao;
            return $str;
        }

        public function buscar($id){
            require_once("../conf/Conexao.php");

            $conexao = Conexao::getInstance();

            $query = 'SELECT * FROM conta_corrent';
            if($id > 0){
                $query .= ' WHERE cc_pf_id = :id';
                $stmt->bindParam(':id', $id);
            }

                $stmt = $conexao->prepare($query);

                if($stmt->execute())
                    return $stmt->fetchAll();
        
                return false;

        }
        
        public function inserir(){
            
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('INSERT INTO conta_corrent (cc_saldo, cc_pf_id, cc_dt_ultima_alteracao) VALUES(:cc_saldo, :cc_pf_id, :cc_dt_ultima_alteracao)');
            $stmt->bindParam(':cc_saldo', $this->cc_saldo, PDO::PARAM_STR);
            $stmt->bindParam(':cc_pf_id', $this->cc_pf_id, PDO::PARAM_STR);
            $stmt->bindParam(':cc_dt_ultima_alteracao', $this->cc_dt_ultima_alteracao, PDO::PARAM_STR);
            
            return $stmt->execute();
            
        }

        public function editar(){
            
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE conta_corrent SET cc_saldo = :cc_saldo, cc_pf_id = :cc_pf_id, cc_dt_ultima_alteracao = :cc_dt_ultima_alteracao WHERE cc_numero = :cc_numero');
        $stmt->bindParam(':cc_numero', $this->cc_numero, PDO::PARAM_INT);
        $stmt->bindParam(':cc_saldo', $this->cc_saldo, PDO::PARAM_STR);
        $stmt->bindParam(':cc_pf_id', $this->cc_pf_id, PDO::PARAM_STR);
        $stmt->bindParam(':cc_dt_ultima_alteracao', $this->cc_dt_ultima_alteracao, PDO::PARAM_STR);

            return $stmt->execute();
            
        }


        public function excluir(){

            $pdo = Conexao::getInstance();
            $stmt = $pdo ->prepare('DELETE FROM conta_corrent WHERE cc_numero = :cc_numero');
            $stmt->bindParam(':cc_numero', $this->cc_numero);
            $stmt->execute();
        }
       
        public function Saque(){
            
        } 

}

?>