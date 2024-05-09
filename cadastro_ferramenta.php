<?php
    
    if(isset($_POST['nomeFerramenta']) && isset($_FILES['arquivo'])){
        include('conexao.php');
        $arquivo = $_FILES['arquivo'];

        if($arquivo['error']){
            die("Falha ao enviar arquivo");
        }

        if($arquivo['size'] > 5242880){
            die("Arquivo maior que 5MB!!");
        }

        $pasta = "imgs/ux_tools_img/";
        $nomedoArquivo = $arquivo['name'];
        $novoNomedoArquivo = uniqid();
        $extensao = strtolower(pathinfo($nomedoArquivo, PATHINFO_EXTENSION));

        if($extensao != "jpg" && $extensao != "png"){
            die("Tipo de arquivo invalido, use apenas jpg ou png!");
        }

        $caminho = $pasta . $novoNomedoArquivo . "." . $extensao;

        $success = move_uploaded_file($arquivo["tmp_name"], $caminho);


        $nomeferramenta = $_POST['nomeFerramenta'];
        $descricao = $_POST['descFerramenta'];
        $descImg = $_POST['descImg'];
        $descExec = $_POST['descExec'];

        if($success){
            // Inicie a transação
            $conn->begin_transaction();
        
            try {
                $conn->query("INSERT INTO uxtool (Nome, Descricao, Imagem, desc_imagem, Como_executar) VALUES ('$nomeferramenta', '$descricao', '$caminho', '$descImg', '$descExec');") or die($conn->error);
                $idGerado = $conn->insert_id;
        
                for ($i = 0; $i < 6; $i++) {
                    if (isset($_POST['material' . $i])) {
                        $material = $_POST['material' . $i];
                        $conn->query("INSERT INTO uxtool_materiais (fk_Uxtool_ID, fk_Materiais_ID) VALUES ('$idGerado', '$material');") or die($conn->error);
                    }
        
                    if (isset($_POST['bibliografia' . $i])) {
                        $bibliografia = $_POST['bibliografia' . $i];
                        $conn->query("INSERT INTO uxtool_bibliografia (fk_Bibliografia_ID, fk_Uxtool_ID) VALUES ('$bibliografia', '$idGerado');") or die($conn->error);
                    }
                }
        
                // Se todas as consultas foram bem-sucedidas, confirme a transação
                $conn->commit();
                include("atualiza_json.php");
                echo "<script> alert('Ferramenta/método cadastrado com sucesso!');</script>";
            } catch (Exception $e) {
                // Se ocorreu um erro, reverta a transação
                $conn->rollback();
                echo "<script> alert('Ocorreu um erro ao cadastrar a ferramenta/método.');</script>";
            }
        }
        else{
            echo "<script> alert('Deu ruim!');</script>";
        }
    }
?>

<?php
function getMateriais() {
    // Conecte-se ao seu banco de dados
    include("conexao.php");

    // Selecione todos os materiais
    $sql = "SELECT * FROM materiais";
    $result = $conn->query($sql);

    // Crie as opções para o elemento select
    $options = '';
    while($row = $result->fetch_assoc()) {
        $options .= '<option value="' . $row['ID'] . '">' . $row['Nome'] . '</option>';
    }

    $conn->close();

    return $options;
}

function getBibliografia() {
    // Conecte-se ao seu banco de dados
    include("conexao.php");

    // Selecione todos os materiais
    $sql = "SELECT * FROM bibliografia";
    $result = $conn->query($sql);

    // Crie as opções para o elemento select
    $options = '';
    while($row = $result->fetch_assoc()) {
        $options .= '<option value="' . $row['ID'] . '">' . $row['Descricao_autor'] . '</option>';
    }

    $conn->close();

    return $options;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cadastro de Ferramentas UX</title>
</head>
<body>
    <form id="form" method="POST" enctype="multipart/form-data">
        <label for="nomeFerramenta">Nome da Ferramenta:</label><br>
        <input type="text" id="nomeFerramenta" name="nomeFerramenta" required><br>

        <label for="descFerramenta">Descrição:</label><br>
        <textarea type="text" id="descFerramenta" name="descFerramenta" style="width: 100%; max-width: 500px;" required>
        </textarea><br>

        <label for="imagem_material"> Selecione uma imagem de capa:</label><br>
        <input id="imagem_material" name="arquivo" type="file" required><br>

        <label for="descImg">Descrição da imagem:</label><br>
        <input type="text" id="descImg" name="descImg" required><br>

        <label for="descExec">Como executar o método/ferramenta:</label><br>
        <textarea type="text" id="descExec" name="descExec" style="width: 100%; max-width: 500px;" required>
        </textarea><br>

        <label for="materiais">Materiais:</label><br>
        <div id="materiais">
            <!-- Materiais serão adicionados aqui -->
        </div>
        <p>
        <button type="button" id="adicionar">Adicionar</button>
        </p>
        <label for="materiais">Bibliografia:</label><br>
        <div id="bibliografia">
            <!-- Bibliografia serão adicionados aqui -->
        </div>
        <br>
        <button type="button" id="adicionar_b">Adicionar</button>
        <input type="submit" value="Cadastrar">
    </form>

    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>
    <script type="text/javascript">
    //<![CDATA[
    bkLib.onDomLoaded(function() {
        new nicEditor({maxHeight : 500}).panelInstance('descFerramenta');
        new nicEditor({maxHeight : 500}).panelInstance('descExec');
        
    });
    //]]>
    </script>

    <script>
        var contador = 0;
        document.getElementById('adicionar').addEventListener('click', function() {
            if (contador < 6) {
                var div = document.createElement('div');
                div.id = 'material' + contador;

                var select = document.createElement('select');
                select.name = 'material' + contador;
                select.innerHTML = '<?php echo getMateriais(); ?>';

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
        });

        var contador_b = 0;
        document.getElementById('adicionar_b').addEventListener('click', function() {
            if (contador_b < 6) {
                var div = document.createElement('div');
                div.id = 'bibliografia' + contador_b;

                var select = document.createElement('select');
                select.name = 'bibliografia' + contador_b;
                select.innerHTML = '<?php echo getBibliografia(); ?>';

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
        });
    </script>
</body>
</html>
