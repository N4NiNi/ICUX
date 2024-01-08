<?php
    include("conexao.php");

    if(isset($_FILES['arquivo']) && isset($_POST['material'])){
        $nomeMaterial = $_POST['material'];
        $arquivo = $_FILES['arquivo'];

        if($arquivo['error']){
            die("Falha ao enviar arquivo");
        }

        if($arquivo['size'] > 5242880){
            die("Arquivo maior que 5MB!!");
        }

        $pasta = "imgs/materiais/";
        $nomedoArquivo = $arquivo['name'];
        $novoNomedoArquivo = uniqid();
        $extensao = strtolower(pathinfo($nomedoArquivo, PATHINFO_EXTENSION));

        if($extensao != "jpg" && $extensao != "png"){
            die("Tipo de arquivo invalido, use apenas jpg ou png!");
        }

        $caminho = $pasta . $novoNomedoArquivo . "." . $extensao;

        $success = move_uploaded_file($arquivo["tmp_name"], $caminho);

        if($success){
            $conn->query("INSERT INTO materiais (Nome, Imagem) VALUES ('$nomeMaterial', '$caminho');") or die($conn->error);
            echo "<script> alert('Arquivo enviado com sucesso!');</script>";
        }
        else{
            echo "<script> alert('Deu ruim!');</script>";
        }

    }
        


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Cadastro Materiais</title>
    </head>
    <body>
        <form method="POST" enctype="multipart/form-data" action="cadastro_materiais.php">
            <label for="nome_material"> Nome material:</label>
            <input id="nome_material" name="material" type="text">
            <p>
            <label for="imagem_material"> Selecione uma imagem</label>
            <input id="imagem_material" name="arquivo" type="file">
            </p>
            <button type="submit">Enviar arquivo</button>
            
        </form>
    </body>
</html>