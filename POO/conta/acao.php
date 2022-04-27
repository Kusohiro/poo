<?php

    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    require_once "../class/conta.class.php";
    require_once "../class/pessoa.class.php";

    // Se foi enviado via GET para acao entra aqui
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $cc_numero = isset($_GET['cc_numero']) ? $_GET['cc_numero'] : 0;
        excluir($cc_numero);
    }

    // Se foi enviado via POST para acao entra aqui
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $cc_numero = isset($_POST['cc_numero']) ? $_POST['cc_numero'] : "";
        $cc_saldo = isset($_POST['cc_saldo']) ? $_POST['cc_saldo'] : "";
        $cc_pf_id = isset($_POST['cc_pf_id']) ? $_POST['cc_pf_id'] : "";
        $cc_dt_ultima_alteracao = isset($_POST['cc_dt_ultima_alteracao']) ? $_POST['cc_dt_ultima_alteracao'] : "";

        try{

        if ($cc_numero == 0)
            inserir($cc_numero,$cc_saldo,$cc_pf_id, $cc_dt_ultima_alteracao);
        else
            editar($cc_numero,$cc_saldo,$cc_pf_id, $cc_dt_ultima_alteracao);
        }catch(Exception $erro){
            echo "<h1> Erro ao cadastrar conta.</h1> <br>
            Erro: ". $erro->getMessage();


        }
    }

    if($acao == "op"){
        $cc_numero = isset($_POST['cc_numero']) ? $_POST['cc_numero'] : "";
        $cc_saldo = isset($_POST['cc_saldo']) ? $_POST['cc_saldo'] : "";
        $pf_id = isset($_POST['pf_id']) ? $_POST['pf_id'] : "";
        $valor = isset($_POST['valor']) ? $_POST['valor'] : "";
        
    }
    
   
    function inserir($cc_numero,$cc_saldo,$cc_pf_id,$cc_dt_ultima_alteracao){
        $dados = dadosForm();

        //var_dump($dados);
        
        $conta = new Conta($cc_numero,$cc_saldo,$cc_pf_id,$cc_dt_ultima_alteracao);
        $conta->inserir();
        
        header("location:conta.php");
        
    }

    function editar($cc_numero,$cc_saldo,$cc_pf_id,$cc_dt_ultima_alteracao){
        $dados = dadosForm($cc_numero,$cc_saldo,$cc_pf_id,$cc_dt_ultima_alteracao);

        $conta = new Conta($cc_numero,$cc_saldo,$cc_pf_id,$cc_dt_ultima_alteracao);
        $conta->editar();


        header("location:conta.php");
    }

    function excluir($cc_numero){   
        
        $conta = new Conta($cc_numero,"nul","mi.","mi");
        $conta->excluir();
        
        //echo $cc_numero;
        header("location:conta.php");
        //echo "Excluir".$id;

    }
    
    // Busca um item pelo código no BD
    function buscarDados($cc_numero){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM conta_corrent WHERE cc_numero = $cc_numero");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['cc_numero'] = $linha['cc_numero'];
            $dados['cc_saldo'] = $linha['cc_saldo'];
            $dados['cc_pf_id'] = $linha['cc_pf_id'];
            $dados['cc_dt_ultima_alteracao'] = $linha['cc_dt_ultima_alteracao'];
        }
        //var_dump($dados);
        return $dados;
    }
    
    // Busca as informações digitadas no form
    function dadosForm(){
        $dados = array();
        $dados['cc_numero'] = $_POST['cc_numero'];
        $dados['cc_saldo'] = $_POST['cc_saldo'];
        $dados['cc_pf_id'] = $_POST['cc_pf_id'];
        $dados['cc_dt_ultima_alteracao'] = $_POST['cc_dt_ultima_alteracao'];
        return $dados;
    }

?>