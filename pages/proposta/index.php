<?php
    require_once "../../conf/Conexao.php";

    include 'acao.php';

    $acao = isset($_GET['acao']) ? $_GET['acao'] : '';
    $dados = array();
    if ($acao == 'editar'){
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $dados = findById($id);
        //var_dump($dados);
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro de Cidade</title>
        <link rel="stylesheet" href="estilo.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Abel&family=Red+Hat+Display:wght@300&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <style>
            .teste{
                margin: 1vh;
            }
        </style>
    </head>
    <body>
        <a href="../../index.php">Voltar</a>
        <center><h1>Cadastro de Propostas</h1></center>
        
        <div class='row teste'>
            <div class='col-12 '>
                <form action="acao.php" method="post">
                    <div class='row'>
                        <div class='col-0'>
                            <!-- <label for="id">ID:</label> -->
                            <input type="hidden" name="loc" value="painel">
                        
                            <input type="hidden" class="form-control" id='id' name='id' value="<?php if ($acao == 'editar') echo $dados['id']; else echo '0'; ?>" readonly>
                        </div>
                    
                        <div class='col-6'>
                            <label for="nome">Nome:</label>
                        
                            <input type="text" class="form-control" id='nome' name='nome' value="<?php if ($acao == 'editar') echo $dados['nome'];?>">
                        </div>
                    
                        <div class='col-6'>
                            <label for="email">Email:</label>
                        
                            <input type="text" class="form-control" id='email' name='email' value="<?php if ($acao == 'editar') echo $dados['email'];?>">
                        </div>
                        
                    </div> 
                    <div class='row'>
                        <div class='col-6'>
                            <label for="salario">Salario:</label>
                        
                            <input type="number" class="form-control" id='salario' name='salario' value="<?php if ($acao == 'editar') echo $dados['salario'];?>">
                        </div>
                    
                        <div class='col-6'>
                            <label for="observacoes">Observações:</label>
                            <textarea class="form-control" id='observacoes' name='observacoes' cols="30" rows="10"><?php if ($acao == 'editar') echo $dados['observacoes'];?></textarea>
                        </div>
                        
                    </div>  
                        <br>
                    <div class='row'>
                        <div class='col-12'>
                            <center><button type='submit' name='acao' class="btn btn-success" id='acao' value='salvar'>Salvar</button></center>
                        </div>
                    </div>       
                </form>
            </div>
        </div> 
        <div class='row'>
            <?php

            ?>
            <div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Salario</th>
                            <th>Email</th>
                            <th>Destalhes</th>
                            <th>Editar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <?php
                                $conexao = Conexao::getInstance();
                                $consulta=$conexao->query("SELECT *FROM proposta;");
                                while($linha=$consulta->fetch(PDO::FETCH_ASSOC)){
                                    echo "
                                        <td>{$linha['id']}</td>
                                        <td>{$linha['nome']}</td>
                                        <td>{$linha['salario']}</td>
                                        <td>{$linha['email']}</td>
                                        <td><a class='btn btn-info' href='show.php?id={$linha['id']}'>Detalhes</a></td>
                                        <td><a class='btn btn-warning' href='index.php?acao=editar&id={$linha['id']}'>Editar</a></td>
                                        <td><a class='btn btn-danger' onClick = 'return excluir();' href='acao.php?acao=excluir&id={$linha['id']}'.>Excluir</a></td>
                                        </tr>\n
                                    ";
                                
                                }
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>