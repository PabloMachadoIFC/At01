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
        $stmt = $conexao->prepare("DELETE FROM contatos WHERE id = :id");
        $stmt->bindParam('id', $id, PDO::PARAM_INT);  
        $stmt->execute();
        header("location:index.php");
    }

    function editar(){
        echo "FUNCTION EDITAR";
        $dados = formToArray();

        $conexao = Conexao::getInstance();

        $sql = "UPDATE contatos SET nome = '".$dados['nome']."', sobrenome = '".$dados['sobrenome']."', email = '".$dados['email']."', observacoes = '".$dados['observacoes']."', telefone = '".$dados['telefone']."', dataNascimento = '".$dados['dataNascimento']."', idCidade = '".$dados['idCidade']."', vivo = '".$dados['vivo']."' WHERE id = '".$dados['id']."';";

        $conexao = $conexao->query($sql);
        header("location:index.php");
    }

    function salvar(){
            echo "FUNCTION SALVAR";
        $dados = formToArray();

        var_dump($dados);

        $conexao = Conexao::getInstance();

        $sql = "INSERT INTO `contatos` (`id`, `nome`, `sobrenome`, `email`, `observacoes`, `telefone`, `dataNascimento`, `idCidade`, `vivo`) VALUES ('".$dados['id']."', '".$dados['nome']."', '".$dados['sobrenome']."', '".$dados['email']."', '".$dados['observacoes']."', '".$dados['telefone']."', '".$dados['dataNascimento']."', '".$dados['idCidade']."', '".$dados['vivo']."');";
        

        
        $conexao = $conexao->query($sql);
        header("location:index.php");
    }

    function formToArray(){
        $id = isset($_POST['id']) ? $_POST['id']: 0;
        $nome = isset($_POST['nome']) ? $_POST['nome']: '';
        $sobrenome = isset($_POST['sobrenome']) ? $_POST['sobrenome']: '';
        $email = isset($_POST['email']) ? $_POST['email']: 0;
        $telefone = isset($_POST['telefone']) ? $_POST['telefone']: '';
        $observacoes = isset($_POST['observacoes']) ? $_POST['observacoes']: '';
        $dataNascimento = isset($_POST['dataNascimento']) ? $_POST['dataNascimento']: 0;
        $vivo = isset($_POST['vivo']) ? $_POST['vivo']: '';
        $idCidade = isset($_POST['idCidade']) ? $_POST['idCidade']: '';


        $dados = array(
            'id' => $id,
            'nome' => $nome,
            'sobrenome' => $sobrenome,
            'email' => $email,
            'telefone' => $telefone,
            'observacoes' => $observacoes,
            'dataNascimento' => $dataNascimento,
            'vivo' => $vivo,
            'idCidade' => $idCidade,
        );

        return $dados;

    }

    function findById($id){
        $conexao = Conexao::getInstance();
        $conexao = $conexao->query("SELECT*FROM contatos WHERE id = $id;");
        $result = $conexao->fetch(PDO::FETCH_ASSOC);
        return $result; 
    }

?>