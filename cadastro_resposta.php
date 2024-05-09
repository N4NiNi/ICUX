<?php
    include("conexao.php");

    $sql = "SELECT * FROM pergunta";
    $result = $conn->query($sql);

    $perguntas = $result->fetch_all();

    if (!$result) {
        // Se houver um erro na consulta, mostra uma mensagem de erro e o motivo
        die("Erro na consulta: " . $conn->error);
    }
    if ($result->num_rows < 1){
        die("Não existe perguntas");
    }
    if(isset($_POST['resposta'])){
        $pergunta_origem = $_POST['pergunta'];
        $resposta = $_POST['resposta'];
        $tipo = $_POST['tipo'];
        $selecao = $_POST['selecao'];

        //echo $pergunta_origem;
        //echo $resposta;
        //echo $tipo;
        //echo $selecao;

        if($tipo == "ferramenta")
            $tipo = "fk_Uxtool_ID";
        else
            $tipo = "fk_PerguntaDireciona_ID";

        $sql = "SELECT count(*) as count FROM resposta WHERE fk_pergunta_ID = $pergunta_origem;";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            $answer = $result->fetch_assoc();
            $answer_number = $answer['count'] + 1;
        } else {
            $answer_number = 1;
        }
        $conn->query("INSERT INTO resposta (answernumber, Resposta, fk_Pergunta_ID, $tipo) VALUES ('$answer_number', '$resposta', '$pergunta_origem', '$selecao');") or die($conn->error);
        include("atualiza_json.php");

    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Cadastrar Pergunta</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
        <form method="POST" action="">
            <p>
                <label for="nome_pergunta"> Selecione a pergunta:</label>
                <select id ="nome_pergunta" name="pergunta">
                    <?php foreach($perguntas as $pgt) : ?>
                        <option value="<?= $pgt['0'] ?>"><?= $pgt['1'] ?></option>
                        <?php endforeach; ?>
                </select>
            </p>
            <p>
                <label for="nome_resposta"> Resposta: </label>
                <input id ="nome_resposta" name="resposta" type="text" required>
            </p>
            <input type="radio" id="ferramenta" name="tipo" value="ferramenta" required>
            <label for="ferramenta">Ferramenta</label>
            <input type="radio" id="pergunta" name="tipo" value="pergunta" required>
            <label for="pergunta">Pergunta</label>
            <select id="selecao" name="selecao" style="display: none;">
                <!-- As opções serão preenchidas pelo JavaScript -->
            </select>
            
        <button type="submit">Cadastrar</button>
            
        </form>

        <script>
            $(document).ready(function() {
                $('input[type=radio][name=tipo], #nome_pergunta').change(function() {
                    var tipo = $('input[type=radio][name=tipo]:checked').val();
                    var pergunta_selecionada = $('#nome_pergunta').val();
                    if (tipo) {
                        $.ajax({
                            url: 'get_opcoes.php',
                            type: 'post',
                            data: {
                                tipo: tipo,
                                pergunta_selecionada: pergunta_selecionada
                            },
                            success: function(response) {
                                $('#selecao').html(response);
                                $('#selecao').show();
                            }
                        });
                    } else {
                        $('#selecao').hide();
                    }
                });
            });
        </script>
    </body>
</html>