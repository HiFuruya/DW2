<?php

    $DB_NOME = "dwii";
    $DB_USUARIO = "root";
    $DB_SENHA = "*******";
    $DB_CHARSET = "utf8";

    $str_conn = "mysql:host=localhost;dbname=".$DB_NOME;

    $conn = new PDO($str_conn, $DB_USUARIO, $DB_SENHA,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES ".$DB_CHARSET));
        
    $sql = "DELETE FROM tb_cursos WHERE id=6";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    echo "REMOVIDO COM SUCESSO!";
?>
