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
        $stmt = $conexao->prepare("DELETE FROM cep WHERE id = :id");
        $stmt->bindParam('id', $id, PDO::PARAM_INT);  
        $stmt->execute();
        header("location:index.php");
    }

    function editar(){
        echo "FUNCTION EDITAR";
        $dados = formToArray();

        $conexao = Conexao::getInstance();

        $sql = "UPDATE cep SET nome = '".$dados['nome']."', estado = '".$dados['estado']."' WHERE id = '".$dados['id']."';";

        $conexao = $conexao->query($sql);
        header("location:index.php");
    }

    function salvar(){
            echo "FUNCTION SALVAR";
        $dados = formToArray();

        var_dump($dados);

        $conexao = Conexao::getInstance();

        $sql = "INSERT INTO cep (id, nome, estado) VALUES ('".$dados['id']."','".$dados['nome']."','".$dados['estado']."')";
        
        $conexao = $conexao->query($sql);
        header("location:index.php");
    }

    function formToArray(){
        $id = isset($_POST['id']) ? $_POST['id']: 0;
        $nome = isset($_POST['nome']) ? $_POST['nome']: '';
        $estado = isset($_POST['estado']) ? $_POST['estado']: '';


        $dados = array(
            'id' => $id,
            'nome' => $nome,
            'estado' => $estado
        );

        return $dados;

    }

    function findById($id){
        $conexao = Conexao::getInstance();
        $conexao = $conexao->query("SELECT*FROM cep WHERE id = $id;");
        $result = $conexao->fetch(PDO::FETCH_ASSOC);
        return $result; 
    }

?>