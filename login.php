<?php

$email = $_POST["email"];
$senha = $_POST["senha"];

$servername = "127.0.0.1:3312";
$username = "root";
$password = "";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=restaurante_bd", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Conexão realizada com sucesso!";
        $stmt = $conn->prepare("SELECT codigo FROM usuario WHERE email=:email AND senha=md5(:senha)");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
        $stmt->execute();

        // set the resulting array to associative
        $result = $stmt->fetchAll();
        $qtd_usuarios = count($result);
        if($qtd_usuarios == 1){
            echo 'Usuário encontrado';
        }
        else if ($qtd_usuarios == 0) {
            echo 'Nenhum usuário localizado';
        }

    }
    catch(PDOException $e) {
        echo "Falha na conexão: " . $e->getMessage();
    }

$conn = null;

include("index.html");