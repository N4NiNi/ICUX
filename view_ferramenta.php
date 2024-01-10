<?php
    include("conexao.php");
    $sql = "SELECT * FROM uxtool";
    $result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cadastro Materiais</title>
    </head>
    <body>
        <h2>Ferramentas/Métodos:</h2>
        <?php 

            while($row = $result->fetch_assoc()) {
                echo "<h4>" . $row['Nome'] . "</h4>";
                echo "<a href='editar_ferramenta.php?id=" . $row['ID'] . "'>Editar</a>";
                echo "<a href='editar_ferramenta.php?id=" . $row['ID'] . "'>Deletar</a>"; 
            }
        ?>



    </body>
</html>