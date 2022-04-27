<?php 

    require_once('../class/conta.class.php');
    require_once('../class/pessoa.class.php');

    function exibir($key, $data){
        $str = "<option value=0>Selecione</option>";
        foreach($data as $linha){
            $str .= "<option value='".$linha[$key[0]]."'>".$linha[$key[1]]."</option>";
        }
        return $str;
    }

    function Listar($id){   
        $pessoa = new Pessoa("","","","");
        $lista = $pessoa->BuscarDados($id);
        var_dump($lista);
        return exibir(array('pf_id','pf_nome'),$lista);
    }

    function Lista_contas($id){
        try{
            $conta = new Conta("","","","");
        }catch(Exception $joaquim){
            echo "Erro: ". $joaquim->getMessage();
        }
        $lista = $conta->buscar($id);
        var_dump($lista);
        return exibir(array('cc_numero','cc_numero'),$lista);
    }
?>
        