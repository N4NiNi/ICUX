<?php
    include("conexao.php");
    if(isset($_POST['pergunta'])){
        $pergunta = $_POST['pergunta'];
        $conn->query("INSERT INTO pergunta (Pergunta) VALUES ('$pergunta');") or die($conn->error);
        echo "<script> alert('Pergunta cadastrada com sucesso!');</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Cadastrar Pergunta</title>
    </head>
    <body>
        <form method="POST" action="">
            <p>
                <label for="nome_pergunta"> Pergunta:</label>
                <input id="nome_pergunta" name="pergunta" type="text">
            </p>
            
            <button type="submit">Cadastrar</button>
            
        </form>
    </body>
</html>