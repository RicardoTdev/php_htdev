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