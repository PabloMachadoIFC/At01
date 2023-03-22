<?php
    require_once "../../conf/Conexao.php";

    // var_dump($_POST);
    //     echo"<br>";
    // var_dump($_GET);
    $acao = "";
    switch($_SERVER['REQUEST_METHOD']) {
        case 'GET':  $acao = isset($_GET['acao']) ? $_GET['acao'] : ""; break;
        case 'POST': $acao = isset($_POST['acao']) ? $_POST['acao'] : ""; break;
    }

    switch($acao){
        case 'excluir': excluir(); break;
        case 'salvar': {
            $id = isset($_POST['id']) ? $_POST['id'] : 0;
            if ($id == 0)
                salvar(); 
            else
                editar();
            break;
        }
    }

    function excluir(){    
        $id = isset($_GET['id']) ? $_GET['id']:0;
        $conexao = Conexao::getInstance();
        $stmt = $conexao->prepare("DELETE FROM proposta WHERE id = :id");
        $stmt->bindParam('id', $id, PDO::PARAM_INT);  
        $stmt->execute();
        header("location:index.php");
    }

    function editar(){
        echo "FUNCTION EDITAR";
        $dados = formToArray();

        $conexao = Conexao::getInstance();

        $sql = "UPDATE proposta SET nome = '".$dados['nome']."', email = '".$dados['email']."', observacoes = '".$dados['observacoes']."', salario = '".$dados['salario']."' WHERE id = '".$dados['id']."';";

        $conexao = $conexao->query($sql);
        header("location:index.php");
    }

    function salvar(){
            echo "FUNCTION SALVAR";
        $dados = formToArray();

        var_dump($dados);

        $conexao = Conexao::getInstance();

        $sql = "INSERT INTO proposta (id, nome, email,observacoes,salario) VALUES ('".$dados['id']."','".$dados['nome']."','".$dados['email']."','".$dados['observacoes']."','".$dados['salario']."')";
        
        $conexao = $conexao->query($sql);

        $loc = isset($_POST['loc']) ? $_POST['loc'] : 'painel';

        if($loc == 'painel'){
            header("location:index.php");
        }else{
            header("location: ../../index.php?aviso=sucesso");
        }
        
    }

    function formToArray(){
        $id = isset($_POST['id']) ? $_POST['id']: 0;
        $nome = isset($_POST['nome']) ? $_POST['nome']: '';
        $email = isset($_POST['email']) ? $_POST['email']: '';
        $observacoes = isset($_POST['observacoes']) ? $_POST['observacoes']: '';
        $salario = isset($_POST['salario']) ? $_POST['salario']: '';


        $dados = array(
            'id' => $id,
            'nome' => $nome,
            'email' => $email,
            'observacoes' => $observacoes,
            'salario' => $salario
        );

        return $dados;

    }

    function findById($id){
        $conexao = Conexao::getInstance();
        $conexao = $conexao->query("SELECT*FROM proposta WHERE id = $id;");
        $result = $conexao->fetch(PDO::FETCH_ASSOC);
        return $result; 
    }

?>