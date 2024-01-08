<?php




// Lógica de conexão ao banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "euxt";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");
// Verificar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Array para armazenar os dados dos uxtools
$uxtool_data = array();
$question_data = array();
$ux_answer = array(); 

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
        $uxtool = array(
            "id" => $row["ID"],
            "name" => $row["Nome"],
            "desc" => $row["Descricao"],
            "exec" => $row["Como_executar"]
            // ... outros campos que você deseja incluir
        );
        // Adiciona os dados da uxtool ao array
        $uxtool_data[] = $uxtool;
    }
} else {
    echo "0 results";
}



// Converte os dados para o formato JSON para serem enviados ao frontend
$uxtool_json = json_encode($uxtool_data);



// Caminho para o arquivo uxtool.js
$js_file = 'uxtool2.js';

// Conteúdo a ser escrito no arquivo JavaScript
$js_content = "const uxtoolData = $uxtool_json;";

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

var_dump($question_json);



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
echo "<script>";
echo "const uxdata = $question_json;";
echo "console.log(uxdata);";
echo "</script>";


?>
