<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];

    $arquivo = "usuarios.json";

    $dados = file_get_contents($arquivo);

    $usuarios = json_decode($dados, true);

    foreach ($usuarios as $conta) {

        if ($conta["usuario"] == $usuario && $conta["senha"] == $senha) {

            $_SESSION["usuario"] = $conta["usuario"];
            $_SESSION["nome"] = $conta["nome"];
            $_SESSION["numConta"] = $conta["numConta"];

            header("Location: conta.php");
            exit;
        }
    }

    echo "<p>Usuário ou senha incorretos.</p>";

} else {

    header("Location: index.php");
    exit;
}