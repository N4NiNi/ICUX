<?php
include("conexao.php");

$tipo = $_POST['tipo'];


// Conecte-se ao banco de dados e obtenha as opções apropriadas
// ...

    if ($tipo == 'ferramenta') {
        $sql = "SELECT * FROM uxtool";
        $result = $conn->query($sql);

        $ferramenta = $result->fetch_all();

        if (!$result) {
            // Se houver um erro na consulta, mostra uma mensagem de erro e o motivo
            die("Erro na consulta: " . $conn->error);
        }
        if ($result->num_rows < 1){
            die("Não existe perguntas");
        }
        // Supondo que $ferramentas é um array de ferramentas obtidas do banco de dados
        foreach ($ferramenta as $fer) {
            echo "<option value=\"{$fer['0']}\">{$fer['1']}</option>";
        }
    } else if ($tipo == 'pergunta') {
        // Supondo que $perguntas é um array de perguntas obtidas do banco de dados
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

        foreach ($perguntas as $pergunta) {
            echo "<option value=\"{$pergunta['0']}\">{$pergunta['1']}</option>";
        }
    }
?>