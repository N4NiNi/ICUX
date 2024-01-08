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
                <input id ="nome_resposta" name="resposta" type="text">
            </p>
            <input type="radio" id="ferramenta" name="tipo" value="ferramenta">
            <label for="ferramenta">Ferramenta</label>
            <input type="radio" id="pergunta" name="tipo" value="pergunta">
            <label for="pergunta">Pergunta</label>
            <select id="selecao" name="selecao" style="display: none;">
                <!-- As opções serão preenchidas pelo JavaScript -->
            </select>
            
        <button type="submit">Cadastrar</button>
            
        </form>

        <script>
            $(document).ready(function() {
                $('input[type=radio][name=tipo]').change(function() {
                    var tipo = this.value;
                    $.ajax({
                        url: 'get_opcoes.php',
                        type: 'post',
                        data: {tipo: tipo},
                        success: function(response) {
                            $('#selecao').html(response);
                            $('#selecao').show();
                        }
                    });
                });

                $('input[type=radio][name=tipo]').click(function() {
                    if (!$('input[type=radio][name=tipo]:checked').val()) {
                        $('#selecao').hide();
                    }
                });
            });
        </script>
    </body>
</html>