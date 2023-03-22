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
        <center><h1>Cadastro de Contatos</h1></center>
        
        <div class='row teste'>
            <div class='col-12 '>
                <form action="acao.php" method="post">
                    <div class='row'>
                        <div class='col-4'>
                            <label for="id">ID:</label>
                        
                            <input type="text" class="form-control" id='id' name='id' value="<?php if ($acao == 'editar') echo $dados['id']; else echo '0'; ?>" readonly>
                        </div>
                    
                        <div class='col-4'>
                            <label for="nome">Nome:</label>
                        
                            <input type="text" class="form-control" id='nome' name='nome' value="<?php if ($acao == 'editar') echo $dados['nome'];?>">
                        </div>
                    
                        <div class='col-4'>
                            <label for="sobrenome">Sobrenome:</label>
                        
                            <input type="text" class="form-control" id='sobrenome' name='sobrenome' value="<?php if ($acao == 'editar') echo $dados['sobrenome'];?>">
                        </div>
                    </div> 
                    <div class='row'>
                        <div class='col-4'>
                            <label for="email">Email:</label>
                        
                            <input type="text" class="form-control" id='email' name='email' value="<?php if ($acao == 'editar') echo $dados['email'];?>" >
                        </div>
                    
                        <div class='col-4'>
                            <label for="dataNascimento">Data de Nascimento:</label>
                            <input type="date" class="form-control" value="<?php if ($acao == 'editar') echo $dados['dataNascimento'];?>" name="dataNascimento" id="dataNascimento">
                        </div>
                    
                        <div class='col-4'>
                            <label for="telefone">Telefone:</label>
                            
                            <input type="text" class="form-control" id='telefone' name='telefone' value="<?php if ($acao == 'editar') echo $dados['telefone'];?>">
                        </div>
                    </div>  
                    <div class='row'>
                        <div class='col-4'>
                            <label for="estado">Cidade:</label>
                            
                            <!-- <input type="text" class="form-control" estado='estado' name='estado' value="<?php //if ($acao == 'editar') echo $dados['estado'];?>"> -->
                            <select class="form-select" name="idCidade" id="idCidade">
                                <?php
                                    $conexao = Conexao::getInstance();
                                    $consulta=$conexao->query("SELECT*FROM cep;");
                                    while($linha=$consulta->fetch(PDO::FETCH_ASSOC)){
                                        if ($linha['id'] == $dados['idCidade']) {
                                            echo "<option value='".$linha['id']."' selected>".$linha['nome']."</option>";
                                        }else{
                                            echo "<option value='".$linha['id']."'>".$linha['nome']."</option>";
                                        }
                                    }

                                ?>
                            </select> 
                        </div>
                    
                        <div class='col-4'>
                            <label for="observacoes">Observações:</label>
                            <textarea name="observacoes" class="form-control" id="observacoes" cols="30" rows="10"><?php if ($acao == 'editar') echo $dados['observacoes'];?></textarea>
                        </div>
                    
                        <div class='col-4'>
                            <label for="vivo">Vivo:</label>
                                <?php
                                    $vivo = isset($dados['vivo']) ? $dados['vivo'] : "";
                                    if ($vivo == "on") {
                                        echo "<input type='checkbox' checked id='vivo' name='vivo'>";
                                    }else{
                                        echo "<input type='checkbox' id='vivo' name='vivo'>";
                                    }
                                ?>
                        </div>
                    </div>  
                        <br>
                    <div class='row'>
                        <div class='col-12'>
                            <center><button type='submit' class="btn btn-success" name='acao' id='acao' value='salvar'>Salvar</button></center>
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
                            <th>Telefone</th>
                            <th>Destalhes</th>
                            <th>Editar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <?php
                                $conexao = Conexao::getInstance();
                                $consulta=$conexao->query("SELECT *FROM contatos;");
                                while($linha=$consulta->fetch(PDO::FETCH_ASSOC)){
                                    echo "
                                        <td>{$linha['id']}</td>
                                        <td>{$linha['nome']} {$linha['sobrenome']}</td>
                                        <td>{$linha['telefone']}</td>
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