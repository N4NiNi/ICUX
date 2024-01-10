<?php

// Lógica de conexão ao banco de dados
include("conexao.php");

// Array para armazenar os dados dos uxtools
$uxtool_data = array();
$question_data = array();
$ux_answer = array(); 
$ux_bibliografia = array();
$ux_materiais = array();

// Consulta ao banco de dados para obter os dados desejados
$sql = "SELECT * FROM uxtool";

$result = $conn->query($sql);



if (!$result) {
    // Se houver um erro na consulta, mostra uma mensagem de erro e o motivo
    die("Erro na consulta: " . $conn->error);
}

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

        // Estrutura os dados de cada linha da consulta para o formato desejado
        $sql = "SELECT m.ID, m.Nome, m.Imagem FROM uxtool_materiais uxm INNER JOIN materiais m ON uxm.fk_Materiais_ID = m.ID where fk_Uxtool_ID = " . $row['ID'];
        $result_subm = $conn->query($sql);

        $sql = "SELECT b.ID, b.Descricao_autor, b.link FROM uxtool_bibliografia uxb INNER JOIN bibliografia b ON uxb.fk_Bibliografia_ID = b.ID WHERE uxb.fk_Uxtool_ID =" . $row['ID'];
        $result_subb = $conn->query($sql);
        if($result_subm->num_rows > 0){
            while($row_subm = $result_subm->fetch_assoc()){
                    $materiais = array(
                        "nome_material" => $row_subm["Nome"],
                        "image" => $row_subm["Imagem"]
                    );
                    $ux_materiais[] = $materiais;
            }
        }
        if($result_subb->num_rows > 0){
            while($row_subb = $result_subb->fetch_assoc()){
                $bibliografia = array(
                    "Descricao" => $row_subb["Descricao_autor"],
                    "Link" => $row_subb["link"]
                );
                $ux_bibliografia[] = $bibliografia;
            }
        }
        
        // Estrutura os dados de cada linha da consulta para o formato desejado
        $uxtool = array(
            "id" => $row["ID"],
            "name" => $row["Nome"],
            "image" => $row["Imagem"],
            "alt" => $row["desc_imagem"],
            "desc" => $row["Descricao"],
            "text_profissionais" => $ux_bibliografia,
            "materiais" => $ux_materiais,
            "exec" => $row["Como_executar"]
            // ... outros campos que você deseja incluir
        );
        // Adiciona os dados da uxtool ao array
        $uxtool_data[] = $uxtool;
        $ux_materiais = array();
        $ux_bibliografia = array();
    }
} else {
    echo "0 results";
}



// Converte os dados para o formato JSON para serem enviados ao frontend
$uxtool_json = json_encode($uxtool_data);



// Caminho para o arquivo uxtool.js
$js_file = 'scripts\uxtools_array.js';

// Conteúdo a ser escrito no arquivo JavaScript
$js_content = "const uxtool = $uxtool_json;";

// Escreve o conteúdo no arquivo
file_put_contents($js_file, $js_content);

// Verifica se o arquivo foi criado com sucesso
if(file_exists($js_file)) {
    echo "Arquivo uxtool.js criado com sucesso!";
} else {
    echo "Erro ao criar o arquivo uxtool.js";
}

//perguntas arrays
$sql = "SELECT * FROM pergunta";

$result = $conn->query($sql);

if (!$result) {
    // Se houver um erro na consulta, mostra uma mensagem de erro e o motivo
    die("Erro na consulta: " . $conn->error);
}

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        
        // Estrutura os dados de cada linha da consulta para o formato desejado
        $sql = "SELECT * FROM resposta WHERE fk_pergunta_ID = " . $row['ID'];
        $result_sub = $conn->query($sql);
        if($result_sub->num_rows > 0){
            while($row_sub = $result_sub->fetch_assoc()){
                    $answers = array(
                        "answerNumber" => $row_sub["answernumber"],
                        "answerText" => $row_sub["Resposta"],
                        "nextques" => $row_sub["fk_PerguntaDireciona_ID"],
                        "ferramenta" => $row_sub["fk_Uxtool_ID"]
                    );
                    $ux_answer[] = $answers;
            }
        }
        
        $questions = array(
            "questionNumber" => $row["ID"],
            "questionText" => $row["Pergunta"],
            "answers" => $ux_answer
            // ... outros campos que você deseja incluir
        );
        $ux_answer = array();
        
        
        // Adiciona os dados da uxtool ao array
        $question_data[] = $questions;
        
    }
} else {
    echo "0 results";
}

// Converte os dados para o formato JSON para serem enviados ao frontend
$question_json = json_encode($question_data);



// Caminho para o arquivo uxtool.js
$js_file = 'scripts\perguntas_array.js';

// Conteúdo a ser escrito no arquivo JavaScript
$js_content = "const ux_pergunta = $question_json;";

// Escreve o conteúdo no arquivo
file_put_contents($js_file, $js_content);

// Verifica se o arquivo foi criado com sucesso
if(file_exists($js_file)) {
    echo "Arquivo .js criado com sucesso!";
} else {
    echo "Erro ao criar o arquivo uxtool.js";
}

?>
