<?php
    require_once "../../conf/Conexao.php";

    $idContato = isset($_POST['idContato']) ? $_POST['idContato']: 0;
    $idHobbie = isset($_POST['idHobbie']) ? $_POST['idHobbie']: 0;

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
        // case 'salvar': {
        //     if (findById($idContato,$idHobbie) == NULL)
        //         salvar(); 
        //     else
        //         editar();
        //     break;
        // }
    }

    function excluir(){  
        echo "FUNCTION EXCLUIR";  


        $idContato = isset($_GET['idContato']) ? $_GET['idContato']: 0;
        $idHobbie = isset($_GET['idHobbie']) ? $_GET['idHobbie']: 0;

        $dados = formToArray();
        $conexao = Conexao::getInstance();
        $sql = "DELETE FROM contato_hobbie WHERE idContato = '$idContato' AND idHobbie = '$idHobbie';";

        $conexao = $conexao->query($sql);
        header("location:index.php");
    }

    function editar(){

        var_dump($_POST);

        $idContatoA = isset($_POST['idContato_codigo']) ? $_POST['idContato_codigo']: 0;
        $idHobbieA = isset($_POST['idHobbie_codigo']) ? $_POST['idHobbie_codigo']: 0;

        echo "FUNCTION EDITAR";
        $dados = formToArray();

        $conexao = Conexao::getInstance();
        $sql = "UPDATE `contato_hobbie` SET `idContato` = '".$dados['idContato']."', `idHobbie` = '".$dados['idHobbie']."' WHERE (`idContato` = '$idContatoA') and (`idHobbie` = '$idHobbieA');";
        
        $conexao = $conexao->query($sql);
        header("location:index.php");
    }

    function salvar(){
            echo "FUNCTION SALVAR";
        $dados = formToArray();

        var_dump($dados);

        $conexao = Conexao::getInstance();

        $sql = "INSERT INTO contato_hobbie (idContato, idHobbie) VALUES ('".$dados['idContato']."','".$dados['idHobbie']."')";
        
        $conexao = $conexao->query($sql);
        header("location:index.php");
    }

    function formToArray(){
        $id = isset($_POST['id']) ? $_POST['id']: 0;
        $idContato = isset($_POST['idContato']) ? $_POST['idContato']: 0;
        $idHobbie = isset($_POST['idHobbie']) ? $_POST['idHobbie']: 0;


        $dados = array(
            'id' => $id,
            'idContato' => $idContato,
            'idHobbie' => $idHobbie
        );

        return $dados;

    }

    function findById($idContato,$idHobbie){
        $conexao = Conexao::getInstance();
        $conexao = $conexao->query("SELECT*FROM contato_hobbie WHERE idContato = $idContato AND idHobbie = $idHobbie;");
        $result = $conexao->fetch(PDO::FETCH_ASSOC);
        return $result; 
    }

?>