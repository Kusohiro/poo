<!DOCTYPE html>

<?php
    include_once "acao.php";
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $dados;
    if ($acao == 'editar'){
        $cont_id = isset($_GET['cont_id']) ? $_GET['cont_id'] : "";
    if ($cont_id > 0)
        $dados = buscarDados($cont_id);
}
    $title = "Cadastro de contatos";
    $cont_descricao = isset($_POST['cont_descricao']) ? $_POST['cont_descricao'] : "";
    $cont_pf_id = isset($_POST['cont_pf_id']) ? $_POST['cont_pf_id'] : ""; 
    $cont_tipo = isset($_POST['cont_tipo']) ? $_POST['cont_tipo'] : "";
    
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

        <label>ID dos contatos</label>
                    <input readonly  type="text" name="cont_id" id="cont_id"value="<?php if ($acao == "editar") echo $dados['cont_id']; else echo 0; ?>"><br>
        
        <label>Tipo de contato</label>
                    <input name="cont_tipo" id="cont_tipo" type="text" required="true"value="<?php if ($acao == "editar") echo $dados['cont_tipo']; ?>"><br>
                 
        <label>Descrição do contato</label>
                    <input name="cont_descricao" id="cont_descricao" type="text" required="true"value="<?php if ($acao == "editar") echo $dados['cont_descricao']; ?>"><br>

        

        <label> Nome da pessoa</label>
                    <select name="cont_pf_id" id="cont_pf_id" > 
                        <?php
                            $pdo = Conexao::getInstance(); 
                
                            $consulta = $pdo->query("SELECT * FROM pessoa_fisica");

                            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {   

                                if ($acao == "editar") echo $dados['cont_id']; 
                                                                    
                                ?>

              <option value="<?php echo $linha['pf_id'];?>"> <?php if ($acao == "editar"){ $dados['cont_id'];}?>  <?php echo $linha['pf_nome'];?></option> 
               <?php }
               ?>
    </select>

<br><br>


    <button name="acao" value="salvar" id="acao" type="submit">
                     Salvar
                </button>
                  
           
    </form>
    

</body>
</html>