<?php
    include("conexao.php");
    if(isset($_POST['bibliografia'])){
        $bibliografia = $_POST['bibliografia'];
        $conn->query("INSERT INTO bibliografia (Descricao_autor) VALUES ('$bibliografia');") or die($conn->error);
        echo "<script> alert('Pergunta cadastrada com sucesso!');</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Cadastrar Bibliografia</title>
    </head>
    <body>
        <form method="POST" action="">
            <p>
                <label for="nome_biblio"> Bibliografia/Autor:</label>
                <input id="nome_biblio" name="bibliografia" type="text">
            </p>
            
            <button type="submit">Cadastrar</button>
            
        </form>
    </body>
</html>