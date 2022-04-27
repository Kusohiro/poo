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

        <a href="cad.php">Cadastrar</a>

    <form method="post">

                <div>
                    <h3>Procurar Pessoa fisica</h3>

                <input type="text" name="procurar" id="procurar" size="50" value="<?php echo $procurar;?>"><br>

                <button name="acao" id="acao" type="submit" >Procurar</button>

                <br><br>
                
        <p> Pesquisar por:</p><br>

        <form method="post" action="">
                <input type="radio" name="tipo" value="1" <?php if ($tipo == "1") echo "checked" ?>> ID<br>
                <input type="radio" name="tipo" value="2" <?php if ($tipo == "2") echo "checked" ?>> Nome do conta<br>

    </div>

    <br><br>
    </form>
        
    <table border="1">
            <tr><td><b>ID</b></td>
                <td><b>CPF</b></td>
                <td><b>Nome</b></td>
                <td><b>Data de nascimento</b></td>
                <td><b>Editar</b></td>
                <td><b>Excluir</b></td>
            </tr> 

            
    <?php
        $pdo = Conexao::getInstance(); 

        if($tipo == 1){
            $consulta = $pdo->query("SELECT * FROM pessoa_fisica 
                                WHERE pessoa_fisica.pf_id LIKE '$procurar%'
                                ORDER BY  pessoa_fisica.pf_id");}

        else if($tipo == 2){
            $consulta = $pdo->query("SELECT * FROM pessoa_fisica
                                WHERE pessoa_fisica.pf_nome LIKE '$procurar%'
                                ORDER BY pessoa_fisica.pf_nome");}


    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {   
        


        ?>
        <tr><td><?php echo $linha['pf_id'];?></td>
            <td><?php echo $linha['pf_cpf'];?></td>
            <td><?php echo $linha['pf_nome'];?></td>
            <td><?php echo $linha['pf_dt_nascimento'];?></td>
            <td><a href="cad.php?acao=editar&pf_id=<?php echo $linha['pf_id'];?>"><img class="icon" src="../img/edit.png" alt=""></a></td>
            <td><a href="javascript:excluirRegistro('acao.php?acao=excluir&pf_id=<?=$linha['pf_id'];?>')"><img class="icon" src="../img/delete.png" alt=""></a></td>
        
        </tr>
    <?php } ?>       
    </table>
    </form>
    
        </div>
</body>
</html>