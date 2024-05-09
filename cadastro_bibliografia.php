<?php
    include("conexao.php");
    if(isset($_POST['bibliografia'])){
        $bibliografia = $_POST['bibliografia'];
        $link = $_POST['link'];
        $conn->query("INSERT INTO bibliografia (Descricao_autor, link) VALUES ('$bibliografia', '$link');") or die($conn->error);
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
                <input id="nome_biblio" name="bibliografia" type="text" required>
            </p>
            <p>
                <label for="link"> Link de acesso:</label>
                <input id="link" name="link" type="text" required>
            </p>
            
            <button type="submit">Cadastrar</button>
            
        </form>
    </body>
</html>