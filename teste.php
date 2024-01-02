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

// Consulta ao banco de dados para obter os dados desejados
$sql = "SELECT * FROM uxtool";

$result = $conn->query($sql);

$uxtool_data = array(); // Array para armazenar os dados dos uxtools

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

// Fecha a conexão com o banco de dados
$conn->close();

// Converte os dados para o formato JSON para serem enviados ao frontend
//var_dump($uxtool_data);
$uxtool_json = json_encode($uxtool_data);
//var_dump($uxtool_json);

// Envia os dados para o frontend
echo "<script>";
echo "const uxtoolData = $uxtool_json;";
echo "console.log(uxtoolData);"; // Você pode fazer o que quiser com os dados aqui
echo "</script>";
//echo $uxtool_json;

// ... seu código para obter e processar os dados ...

// Converte os dados para o formato JSON
//$uxtool_json = json_encode($uxtool_data);

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

?>
