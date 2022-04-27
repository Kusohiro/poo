<!DOCTYPE html>
<?php 
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    require "../class/conta.class.php";
    $title = "POO - Contas";
    $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : ""; 
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : 1;
?>


<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>
    
    <script>
        function excluirRegistro(url){
            if (confirm("Confirma Exclusão?"))
                location.href = url;
        }
    </script>

    
</head>
<body>

<?php include '../menu/menu.php'; ?>

<table>
    <tr>
        <td><a href="operacao.php"><h3>Operação</h3></a></td>
    </tr>
    </table>

    <a href="cad.php">Cadastrar</a>

    <form method="post">

                <div>
                    <h3>Procurar Conta corrente</h3>

                <input type="text" name="procurar" id="procurar" size="50" value="<?php echo $procurar;?>"><br>

                <button name="acao" id="acao" type="submit" >Procurar</button>

                <br><br>
                
        <p> Pesquisar por:</p><br>

        <form method="post" action="">
                <input type="radio" name="tipo" value="1" <?php if ($tipo == "1") echo "checked" ?>>Número da conta<br>
                <input type="radio" name="tipo" value="2" <?php if ($tipo == "2") echo "checked" ?>>Saldo da conta<br>

    </div>

    <br><br>
    </form>
        
    <table border="1">
            <tr><td><b>Número da conta</b></td>
                <td><b>Saldo da conta</b></td>
                <td><b>Pessoa física</b></td>
                <td><b>Data de alteração</b></td>
                <td><b>Editar</b></td>
                <td><b>Excluir</b></td>
            </tr> 

            
    <?php
        $pdo = Conexao::getInstance(); 

        if($tipo == 1){
            $consulta = $pdo->query("SELECT * FROM pessoa_fisica, conta_corrent 
                                WHERE conta_corrent.cc_numero LIKE '$procurar%'
                                AND conta_corrent.cc_pf_id = pessoa_fisica.pf_id
                                ORDER BY  conta_corrent.cc_numero");}

        else if($tipo == 2){
            $consulta = $pdo->query("SELECT * FROM conta_corrent
                                WHERE conta_corrent.pf_nome LIKE '$procurar%'
                                ORDER BY conta_corrent.pf_nome");}


    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        


        ?>
        <tr><td><?php echo $linha['cc_numero'];?></td>
            <td><?php echo $linha['cc_saldo'];?></td>
            <td><?php echo $linha['pf_nome'];?></td>
            <td><?php echo  date("d/m/Y",strtotime($linha['cc_dt_ultima_alteracao']));?></td>
            <td><a href="cad.php?acao=editar&cc_numero=<?php echo $linha['cc_numero'];?>"><img class="icon" src="../img/edit.png" alt=""></a></td>
            <td><a href="javascript:excluirRegistro('acao.php?acao=excluir&cc_numero=<?=$linha['cc_numero'];?>')"><img class="icon" src="../img/delete.png" alt=""></a></td>
        
        </tr>
    <?php } ?>       
    </table>
    </form>
    
        </div>
</body>
</html>