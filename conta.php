<?php

session_start();

require_once __DIR__ . "/app/classes/ContaBanco.php";


if (!isset($_SESSION["usuario"])) {

    header("Location: index.php");
    exit;
}


// Caminho do arquivo de usuários

$arquivo = __DIR__ . "/data/usuarios.json";

$dados = file_get_contents($arquivo);

$usuarios = json_decode($dados, true);


$usuarioLogado = $_SESSION["usuario"];

$contaEncontrada = null;


foreach ($usuarios as $conta) {

    if ($conta["usuario"] === $usuarioLogado) {

        $contaEncontrada = $conta;

        break;
    }
}


if ($contaEncontrada === null) {

    session_destroy();

    header("Location: index.php");
    exit;
}


// Criando o objeto da conta

$contaBanco = new ContaBanco();

$contaBanco->setNumConta(
    $contaEncontrada["numConta"]
);

$contaBanco->setTipo(
    $contaEncontrada["tipo"]
);

$contaBanco->setDono(
    $contaEncontrada["nome"]
);

$contaBanco->setSaldo(
    $contaEncontrada["saldo"]
);

$contaBanco->setStatus(
    $contaEncontrada["status"]
);


// -----------------------------------------
// Carregando as transações
// -----------------------------------------

$arquivoTransacoes =
    __DIR__ . "/data/transacoes.json";

$dadosTransacoes =
    file_get_contents($arquivoTransacoes);

$transacoes =
    json_decode($dadosTransacoes, true);


if (!is_array($transacoes)) {

    $transacoes = [];
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

    <title>Minha Conta - Banco PHP</title>

    <link
        rel="stylesheet"
        href="assets/css/style.css"
    >

</head>

<body>

    <main class="conta-container">

        <div class="conta-box">

            <h1>🏦 Banco PHP</h1>

            <h2>
                Olá,
                <?php echo $contaBanco->getDono(); ?>!
            </h2>


            <div class="informacoes">

                <p>

                    <strong>Número da conta:</strong>

                    <?php
                    echo $contaBanco->getNumConta();
                    ?>

                </p>


                <p>

                    <strong>Tipo:</strong>

                    <?php
                    echo $contaBanco->getTipo();
                    ?>

                </p>


                <p>

                    <strong>Saldo:</strong>

                    R$

                    <?php

                    echo number_format(
                        $contaBanco->getSaldo(),
                        2,
                        ",",
                        "."
                    );

                    ?>

                </p>


                <p>

                    <strong>Status:</strong>

                    <?php

                    if ($contaBanco->getStatus()) {

                        echo "Conta ativa";

                    } else {

                        echo "Conta fechada";
                    }

                    ?>

                </p>

            </div>


            <!-- DEPÓSITO -->

            <h3>Depositar</h3>

            <form
                action="depositar.php"
                method="POST"
            >

                <input
                    type="number"
                    name="valor"
                    step="0.01"
                    min="1"
                    placeholder="Valor do depósito"
                    required
                >

                <button type="submit">
                    Depositar
                </button>

            </form>


            <!-- SAQUE -->

            <h3>Sacar</h3>

            <form
                action="sacar.php"
                method="POST"
            >

                <input
                    type="number"
                    name="valor"
                    step="0.01"
                    min="1"
                    placeholder="Valor do saque"
                    required
                >

                <button type="submit">
                    Sacar
                </button>

            </form>


            <!-- EXTRATO -->

            <h3>Últimas transações</h3>

            <div class="extrato">

                <?php

                $quantidade = 0;


                foreach (
                    array_reverse($transacoes)
                    as $transacao
                ) {

                    if (
                        $transacao["usuario"]
                        === $usuarioLogado
                    ) {

                        echo "<p>";


                        if (
                            $transacao["tipo"]
                            === "deposito"
                        ) {

                            echo "🟢 Depósito: ";

                        } elseif (
                            $transacao["tipo"]
                            === "saque"
                        ) {

                            echo "🔴 Saque: ";
                        }


                        echo "R$ ";


                        echo number_format(
                            $transacao["valor"],
                            2,
                            ",",
                            "."
                        );


                        echo " - ";

                        echo $transacao["data"];

                        echo "</p>";


                        $quantidade++;
                    }


                    if ($quantidade >= 5) {

                        break;
                    }
                }


                if ($quantidade === 0) {

                    echo "<p>Nenhuma transação realizada.</p>";
                }

                ?>

            </div>


            <br>


            <a href="logout.php">
                Sair da conta
            </a>

        </div>

    </main>

</body>

</html>