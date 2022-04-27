<?php

    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    require_once "../class/contatos.class.php";

    // Se foi enviado via GET para acao entra aqui
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $cont_id = isset($_GET['cont_id']) ? $_GET['cont_id'] : 0;
        excluir($cont_id);
    }

    // Se foi enviado via POST para acao entra aqui
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $cont_id = isset($_POST['cont_id']) ? $_POST['cont_id'] : "";
        $cont_tipo = isset($_POST['cont_tipo']) ? $_POST['cont_tipo'] : "";
        $cont_descricao = isset($_POST['cont_descricao']) ? $_POST['cont_descricao'] : "";
        $cont_pf_id = isset($_POST['cont_pf_id']) ? $_POST['cont_pf_id'] : "";
        if ($cont_id == 0)
            inserir($cont_id,$cont_tipo,$cont_descricao, $cont_pf_id);
        else
            editar($cont_id,$cont_tipo,$cont_descricao, $cont_pf_id);
    }

    
   
    function inserir($cont_id,$cont_tipo,$cont_descricao,$cont_pf_id){
        $dados = dadosForm();

        //var_dump($dados);
        
        $contatos = new Contatos($cont_id,$cont_tipo,$cont_descricao,$cont_pf_id);
        $contatos->inserir();
        
        header("location:contatos.php");
        
    }

    function editar($cont_id,$cont_tipo,$cont_descricao,$cont_pf_id){
        $dados = dadosForm($cont_id,$cont_tipo,$cont_descricao,$cont_pf_id);

        $contatos = new Contatos($cont_id,$cont_tipo,$cont_descricao,$cont_pf_id);
        $contatos->editar();


        header("location:contatos.php");
    }

    function excluir($cont_id){   
        
        $contatos = new Contatos($cont_id,"","","");
        $contatos->excluir();
        
        //echo $cont_id;
        header("location:contatos.php");
        //echo "Excluir".$cont_id;

    }
    
    // Busca um item pelo código no BD
    function buscarDados($cont_id){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM contatos WHERE cont_id = $cont_id");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['cont_id'] = $linha['cont_id'];
            $dados['cont_tipo'] = $linha['cont_tipo'];
            $dados['cont_descricao'] = $linha['cont_descricao'];
            $dados['cont_pf_id'] = $linha['cont_pf_id'];
        }
        //var_dump($dados);
        return $dados;
    }
    
    // Busca as informações digitadas no form
    function dadosForm(){
        $dados = array();
        $dados['cont_id'] = $_POST['cont_id'];
        $dados['cont_tipo'] = $_POST['cont_tipo'];
        $dados['cont_descricao'] = $_POST['cont_descricao'];
        $dados['cont_pf_id'] = $_POST['cont_pf_id'];
        return $dados;
    }

?>