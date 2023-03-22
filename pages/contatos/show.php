<?php 
    require_once "../../conf/Conexao.php";
?> 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <br>
    <center>
        <div class="panel panel-default">
            <div class="panel-heading"><i class="fa fa-info-circle fa-fw"></i><b>Detalhes do Contato</b></div>
            <div class="panel-body">
                <div class="container-fluid">
                    <div class="card" style="width: 18rem;">
                        <?php
                            $id = isset($_GET['id']) ? $_GET['id']:0;

                            $conexao = Conexao::getInstance();
                            $consulta=$conexao->query("SELECT *, cep.id as idCidade, cep.nome as nomeCidade FROM contatos LEFT JOIN cep ON contatos.idCidade = cep.id WHERE contatos.id = $id;");
                            
                            while($linha=$consulta->fetch(PDO::FETCH_ASSOC)){
                                echo "<div class='card-body'>";
                                echo "<div class='card-header'><b>ID:</b> ".$linha["id"]."</div>";
                                echo "<h5 class='card-title'><b>Nome:</b> ".$linha["nome"]." ".$linha["sobrenome"]."</h5>";
                                echo "<p class='card-text'><b>Email:</b> ".$linha["email"]."</p>";
                                echo "<p class='card-text'><b>Telefone:</b> ".$linha["telefone"]."</p>";
                                echo "<p class='card-text'><b>Data Nascimento:</b> ".$linha["dataNascimento"]."</p>";
                                echo "<p class='card-text'><b>Cidade:</b> ".$linha["nomeCidade"]."({$linha["idCidade"]}) - ".$linha["estado"]."</p>";
                                echo "<p class='card-text'><b>Observações:</b> ".$linha["observacoes"]."</p>";
                                echo 
                                "<a class='btn btn-danger' onClick='return excluir();' href='acao.php?acao=excluir&id=".$linha['id']."'.>Excluir</a>"."&nbsp;&nbsp;".
                                "<a class='btn btn-warning' href='index.php?acao=editar&id=".$linha['id']."'.>Editar</a>"."&nbsp;&nbsp;".
                                "<a class='btn btn-primary' href='index.php'.>Voltar</a>";
                            }
                        ?> 
                        
                    </div>
                </div>
            </div>
        </div>
    </center>