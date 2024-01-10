<?php
    

    if(!(isset($_GET['id']))){
        header('Location: view_ferramenta.php');
        exit();
    }
    include("conexao.php");

    

    $id = $_GET['id'];

    
    $sql = "SELECT * FROM uxtool where ID = $id";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();

    $sql = "SELECT ux.ID, ux.Nome, m.ID as ID_material, m.Nome FROM uxtool ux INNER JOIN uxtool_materiais uxm ON ux.ID = uxm.fk_Uxtool_ID INNER JOIN materiais m ON uxm.fk_Materiais_ID = m.ID WHERE ux.ID = $id;";
    //
    $result = $conn->query($sql);
    $materiais = [];
    while($row_m = $result->fetch_assoc()) {
        $materiais[] = $row_m['ID_material'];
    }

    $sql = "SELECT ux.ID, ux.Nome, b.ID as ID_bibliografia, b.Descricao_autor FROM uxtool ux INNER JOIN uxtool_bibliografia uxb ON ux.ID = uxb.fk_Uxtool_ID INNER JOIN bibliografia b ON uxb.fk_Bibliografia_ID = b.ID WHERE ux.ID = $id;";

    $result = $conn->query($sql);
    $bibliografia = [];
    while($row_b = $result->fetch_assoc()) {
        $bibliografia[] = $row_b['ID_bibliografia'];
    }
    


    //ao apertar atualizar

    if(isset($_POST['nomeFerramenta'])){
        $caminho = $row['Imagem'];
        $arquivo = $_FILES['arquivo'];
        if($arquivo['error'] != 4){
            if($arquivo['error'])
                die("Falha ao enviar arquivo");
    
            if($arquivo['size'] > 5242880)
                die("Arquivo maior que 5MB!!");

            $success = move_uploaded_file($arquivo["tmp_name"], $caminho);
        }

        $nomeferramenta = $_POST['nomeFerramenta'];
        $descricao = $_POST['descFerramenta'];
        $descImg = $_POST['descImg'];
        $descExec = $_POST['descExec'];

        $conn->begin_transaction();
        try {
            $conn->query("UPDATE uxtool SET Nome = '$nomeferramenta', Descricao = '$descricao', Imagem = '$caminho', desc_imagem = '$descImg', Como_executar = '$descExec' WHERE ID = $id;") or die($conn->error);
            $conn->query("DELETE FROM uxtool_materiais WHERE fk_Uxtool_ID = $id;") or die($conn->error);
            $conn->query("DELETE FROM uxtool_bibliografia WHERE fk_Uxtool_ID = $id;") or die($conn->error);
            for ($i = 0; $i < 6; $i++) {
                if (isset($_POST['material' . $i])) {
                    $material = $_POST['material' . $i];
                    $conn->query("INSERT INTO uxtool_materiais (fk_Uxtool_ID, fk_Materiais_ID) VALUES ('$id', '$material');") or die($conn->error);
                }
    
                if (isset($_POST['bibliografia' . $i])) {
                    $bibliografia = $_POST['bibliografia' . $i];
                    $conn->query("INSERT INTO uxtool_bibliografia (fk_Bibliografia_ID, fk_Uxtool_ID) VALUES ('$bibliografia', '$id');") or die($conn->error);
                }
            }
            $conn->commit();
            $conn->close();
            echo "<script> 
            alert('Ferramenta/método editado com sucesso!');
            window.location.href='view_ferramenta.php';
            </script>";
        

        }catch (Exception $e) {
            $conn->rollback();
            echo "<script> alert('Ocorreu um erro ao editar a ferramenta/método.');</script>";
        }


    }

?>

<?php
function getMateriais($id) {
    // Conecte-se ao seu banco de dados
    include("conexao.php");

    // Selecione todos os materiais
    
    $sql = "SELECT * FROM materiais";
    $result = $conn->query($sql);

    // Crie as opções para o elemento select
    $options = '';
    while($row = $result->fetch_assoc()) {
        if($id == $row['ID']){
            $options .= '<option value="' . $row['ID'] . '" selected="selected">' . $row['Nome'] . '</option>'; 
        }else{
            $options .= '<option value="' . $row['ID'] . '">' . $row['Nome'] . '</option>';
        }
    }

    $conn->close();

    return $options;
}

function getBibliografia($id) {
    // Conecte-se ao seu banco de dados
    include("conexao.php");

    // Selecione todos os materiais
    $sql = "SELECT * FROM bibliografia";
    $result = $conn->query($sql);

    // Crie as opções para o elemento select
    $options = '';
    while($row = $result->fetch_assoc()) {
        if($id == $row['ID']){
            $options .= '<option value="' . $row['ID'] . '" selected="selected">' . $row['Descricao_autor'] . '</option>';
        }else{
            $options .= '<option value="' . $row['ID'] . '">' . $row['Descricao_autor'] . '</option>';
        }
    }

    $conn->close();

    return $options;
}
?>

<?php
    $opcoesMateriais = getMateriais(-1);
    $opcoesBibliografia = getBibliografia(-1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cadastro de Ferramentas UX</title>
</head>
<body>
    <form id="form" method="POST" enctype="multipart/form-data">
        <label for="nomeFerramenta">Nome da Ferramenta:</label><br>
        <input type="text" id="nomeFerramenta" name="nomeFerramenta" value= "<?php echo $row['Nome']; ?>" required><br>

        <label for="descFerramenta">Descrição:</label><br>
        <input type="text" id="descFerramenta" name="descFerramenta" value="<?php echo $row['Descricao']; ?>" required><br>

        <label for="imagem_material"> Selecione uma imagem de capa:</label><br>
        <input id="imagem_material" name="arquivo" type="file"><br>

        <label for="descImg">Descrição da imagem:</label><br>
        <input type="text" id="descImg" name="descImg" value="<?php echo $row['desc_imagem']; ?>" required><br>

        <label for="descExec">Como executar o método/ferramenta:</label><br>
        <input type="text" id="descExec" name="descExec" value="<?php echo $row['Como_executar']; ?>" required><br>

        <label for="materiais">Materiais:</label><br>
        <div id="materiais">
            <?php for ($i = 0; $i < count($materiais); $i++): ?>
                <div id="material<?php echo $i; ?>">
                    <select name="material<?php echo $i; ?>">
                        <?php echo getMateriais($materiais[$i]); ?>
                    </select>
                    <button type="button" onclick="removerMaterial(<?php echo $i; ?>)">Remover</button>
                </div>
            <?php endfor; ?>
        </div>
        <p>
        <button type="button" id="adicionar">Adicionar</button>
        </p>

        <label for="bibliografia">Bibliografia:</label><br>
        <div id="bibliografia">
            <?php for ($i = 0; $i < count($bibliografia); $i++): ?>
                <div id="bibliografia<?php echo $i; ?>">
                    <select name="bibliografia<?php echo $i; ?>">
                        <?php echo getBibliografia($bibliografia[$i]); ?>
                    </select>
                    <button type="button" onclick="removerBibliografia(<?php echo $i; ?>)">Remover</button>
                </div>
            <?php endfor; ?>
        </div>
        <br>
        <button type="button" id="adicionar_b">Adicionar</button>


        <input type="submit" value="Cadastrar">
    </form>

    <script>
        var contador = <?php echo count($materiais); ?>;

        document.getElementById('adicionar').addEventListener('click', function() {
            if (contador < 6) {
                adicionarMaterial();
            }
        });

        function adicionarMaterial() {
            var div = document.createElement('div');
            div.id = 'material' + contador;

            var select = document.createElement('select');
            select.name = 'material' + contador;
            select.innerHTML = '<?php echo getMateriais(-1); ?>';

            var remover = document.createElement('button');
            remover.textContent = 'Remover';
            remover.type = 'button';
            remover.addEventListener('click', function() {
                document.getElementById(div.id).remove();
                contador--;
            });

            div.appendChild(select);
            div.appendChild(remover);

            document.getElementById('materiais').appendChild(div);
            contador++;
        }

        function removerMaterial(i) {
            document.getElementById('material' + i).remove();
            contador--;
        }

        var contador_b = <?php echo count($bibliografia); ?>;

        document.getElementById('adicionar_b').addEventListener('click', function() {
            if (contador < 6) {
                adicionarBibliografia();
            }
        });

        function adicionarBibliografia() {
            var div = document.createElement('div');
            div.id = 'bibliografia' + contador_b;

            var select = document.createElement('select');
            select.name = 'bibliografia' + contador_b;
            select.innerHTML = '<?php echo getBibliografia(-1); ?>';

            var remover = document.createElement('button');
            remover.textContent = 'Remover';
            remover.type = 'button';
            remover.addEventListener('click', function() {
                document.getElementById(div.id).remove();
                contador_b--;
            });

            div.appendChild(select);
            div.appendChild(remover);

            document.getElementById('bibliografia').appendChild(div);
            contador_b++;
        }

        function removerBibliografia(i) {
            document.getElementById('bibliografia' + i).remove();
            contador_b--;
        }
    </script>
</body>
</html>
