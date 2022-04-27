<?php

    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    require_once "../class/pessoa.class.php";

    // Se foi enviado via GET para acao entra aqui
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $pf_id = isset($_GET['pf_id']) ? $_GET['pf_id'] : 0;
        excluir($pf_id);
    }

    // Se foi enviado via POST para acao entra aqui
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $pf_id = isset($_POST['pf_id']) ? $_POST['pf_id'] : "";
        $pf_cpf = isset($_POST['pf_cpf']) ? $_POST['pf_cpf'] : "";
        $pf_nome = isset($_POST['pf_nome']) ? $_POST['pf_nome'] : "";
        $pf_dt_nascimento = isset($_POST['pf_dt_nascimento']) ? $_POST['pf_dt_nascimento'] : "";
        if ($pf_id == 0)
            inserir($pf_id,$pf_cpf,$pf_nome, $pf_dt_nascimento);
        else
            editar($pf_id,$pf_cpf,$pf_nome, $pf_dt_nascimento);
    }

    
   
    function inserir($pf_id,$pf_cpf,$pf_nome,$pf_dt_nascimento){
        $dados = dadosForm();

        //var_dump($dados);
        
        $pessoa = new Pessoa($pf_id,$pf_cpf,$pf_nome,$pf_dt_nascimento);
        $pessoa->inserir();
        
        header("location:pessoa.php");
        
    }

    function editar($pf_id,$pf_cpf,$pf_nome,$pf_dt_nascimento){
        $dados = dadosForm($pf_id,$pf_cpf,$pf_nome,$pf_dt_nascimento);

        $pessoa = new Pessoa($pf_id,$pf_cpf,$pf_nome,$pf_dt_nascimento);
        $pessoa->editar();


        header("location:pessoa.php");
    }

    function excluir($pf_id){   
        
        $pessoa = new Pessoa($pf_id,"","","");
        $pessoa->excluir();
        
        //echo $pf_id;
        header("location:pessoa.php");
        //echo "Excluir".$id;

    }
    
    // Busca um item pelo código no BD
    function buscarDados($pf_id){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM pessoa_fisica WHERE pf_id = $pf_id");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['pf_id'] = $linha['pf_id'];
            $dados['pf_cpf'] = $linha['pf_cpf'];
            $dados['pf_nome'] = $linha['pf_nome'];
            $dados['pf_dt_nascimento'] = $linha['pf_dt_nascimento'];
        }
        //var_dump($dados);
        return $dados;
    }
    
    // Busca as informações digitadas no form
    function dadosForm(){
        $dados = array();
        $dados['pf_id'] = $_POST['pf_id'];
        $dados['pf_cpf'] = $_POST['pf_cpf'];
        $dados['pf_nome'] = $_POST['pf_nome'];
        $dados['pf_dt_nascimento'] = $_POST['pf_dt_nascimento'];
        return $dados;
    }

    
?>