<!DOCTYPE html>
<html lang="PT-BR">
<head>
<?php 
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    require "../class/conta.class.php";
    require_once("../ultils/operacao.php");
    require_once("acao.php");

    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : 1;
    $title = "Saque";
?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
</head>
<body>
    <fieldset>
    <form action="operacao.php" method="post">
    <label> Nome da pessoa: </label>

        <select name="pf-id" id="pf-id" > 

                <?php 
                    echo Listar(0);
                ?>

            </select><br>

                <label> Conta corrente: </label>
                    <select name="cc-id" id="cc-id" > 
                        <?php
                            $pessoa = isset($_POST['pf-id'])?$_POST['pf-id'] : 0 ;
                            echo Lista_contas($pessoa);
                        ?>
                    </select><br>

                <label>Operação: </label>
                <input type="radio" name="op" id="saque" <?php if ($tipo == "1") echo "checked" ?>><label for="">Saque</label>
                <input type="radio" name="op" id="deposito" <?php if ($tipo == "2") echo "checked" ?>><label for="">Deposito</label>

                <br>

                <Label>Valor: </Label><input type="text" name="valor" id="valor"><br>

                <button name="acao" value="op" id="acao" type="submit">Salvar</button>
        </form>
    </fieldset>
</body>
</html>