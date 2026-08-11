<?php

session_start();

$erro = "";


// Verifica se o formulário foi enviado

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $usuario = $_POST["usuario"] ?? "";
    $senha = $_POST["senha"] ?? "";


    // Caminho do arquivo de usuários

    $arquivo = __DIR__ . "/data/usuarios.json";


    // Lê o arquivo JSON

    $dados = file_get_contents($arquivo);


    // Converte JSON para array

    $usuarios = json_decode($dados, true);


    // Procura o usuário

    foreach ($usuarios as $conta) {

        if (
            $conta["usuario"] === $usuario &&
            $conta["senha"] === $senha
        ) {

            // Criamos a sessão do usuário

            $_SESSION["usuario"] = $conta["usuario"];

            $_SESSION["nome"] = $conta["nome"];

            $_SESSION["numConta"] = $conta["numConta"];


            // Envia para a página da conta

            header("Location: conta.php");

            exit;
        }
    }


    // Se chegou aqui, login não foi encontrado

    $erro = "Usuário ou senha incorretos.";
}

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Banco PHP - Login</title>

    <link
        rel="stylesheet"
        href="assets/css/style.css"
    >

</head>

<body>

    <main class="login-container">

        <div class="login-box">

            <h1>🏦 Banco PHP</h1>

            <h2>Login</h2>


            <?php if ($erro !== ""): ?>

                <p class="erro">
                    <?php echo $erro; ?>
                </p>

            <?php endif; ?>


            <form
                action="login.php"
                method="POST"
            >

                <label for="usuario">
                    Usuário
                </label>

                <input
                    type="text"
                    id="usuario"
                    name="usuario"
                    placeholder="Digite seu usuário"
                    required
                >


                <label for="senha">
                    Senha
                </label>

                <input
                    type="password"
                    id="senha"
                    name="senha"
                    placeholder="Digite sua senha"
                    required
                >


                <button type="submit">
                    Entrar
                </button>

            </form>

        </div>

    </main>

</body>

</html>