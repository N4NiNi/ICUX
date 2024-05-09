<?php
    include("../conexao.php");

    $sessionid =  $_POST['session_id'];
    $respostaid = $_POST['answer_id'];
    $uxtoolid = $_POST['ux_tool_id'];

    echo "<script> console.log('teste'); </script>";

    $conn->query("INSERT INTO caminho (ID_SESSION, fk_Resposta_ID, fk_Uxtool_ID) VALUES ('$sessionid', '$respostaid', $uxtoolid);") or die($conn->error);



?>