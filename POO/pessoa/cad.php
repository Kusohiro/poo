<!DOCTYPE html>

<?php
    include_once "acao.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $dados;
    if ($acao == 'editar'){
        $pf_id = isset($_GET['pf_id']) ? $_GET['pf_id'] : "";
    if ($pf_id > 0)
        $dados = buscarDados($pf_id);
}
    $title = "Cadastro de Estados";
    $pf_cpf = isset($_POST['pf_cpf']) ? $_POST['pf_cpf'] : "";
    
//var_dump($dados);
?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title ?></title>

</head>


<body>
<br>

<h3>Insira os dados</h3><br>

        <form method="post" action="acao.php">
        <label>ID</label>
                <input readonly  type="text" name="pf_id" id="pf_id"value="<?php if ($acao == "editar") echo $dados['pf_id']; else echo 0; ?>"><br>

        <label>CPF</label>
                <input name="pf_cpf" id="pf_cpf" type="text" required="true"value="<?php if ($acao == "editar") echo $dados['pf_cpf']; ?>"><br>
                

        <label>Nome</label>
                <input name="pf_nome" id="pf_nome" type="text" required="true"value="<?php if ($acao == "editar") echo $dados['pf_nome']; ?>"><br>
        
        <label>Data de nascimento</label>
        <input type="date" name="pf_dt_nascimento" id="pf_dt_nascimento" value="<?php if ($acao == "editar") echo date("Y-m-d",strtotime($dados['pf_dt_nascimento'])); ?>"><br>            

        <br><br>


    <button name="acao" value="salvar" id="acao" type="submit">
                     Salvar
                </button>
                  
           
    </form>
    

</body>
</html>