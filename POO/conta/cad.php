<!DOCTYPE html>

<?php
    include_once "acao.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $dados;
    if ($acao == 'editar'){
        $cc_numero = isset($_GET['cc_numero']) ? $_GET['cc_numero'] : "";
    if ($cc_numero > 0)
        $dados = buscarDados($cc_numero);
}
    $title = "Cadastro de contas";
    $cc_saldo = isset($_POST['cc_saldo']) ? $_POST['pf_cpf'] : "";
    
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
                <input hidden  type="text" name="cc_numero" id="cc_numero"value="<?php if ($acao == "editar") echo $dados['cc_numero']; else echo 0; ?>"><br>

        <label>Saldo da conta</label>
                <input name="cc_saldo" id="cc_saldo" type="text" required="true" value="<?php if ($acao == "editar") echo $dados['cc_saldo']; ?>"><br>
                
                <label> Nome da pessoa :</label>

                    <select name="cc_pf_id" id="cc_pf_id" > 

               <?php 
                    require_once("../ultils/operacao.php");
                    echo Listar(0);
               ?>
               
            </select><br>
           
        <label>Data de alteração</label>
        <input type="date" name="cc_dt_ultima_alteracao" id="cc_dt_ultima_alteracao" value="<?php if ($acao == "editar") echo date("Y-m-d",strtotime($dados['cc_dt_ultima_alteracao'])); ?>"><br>            

        <br><br>


    <button name="acao" value="salvar" id="acao" type="submit">Salvar</button>
                  
           
    </form>
    

</body>
</html>