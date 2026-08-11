<?php

session_start();

require_once "ContaBanco.php";

if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: conta.php");
    exit;
}


$valor = (float) $_POST["valor"];


if ($valor <= 0) {
    header("Location: conta.php");
    exit;
}


$arquivo = "usuarios.json";

$dados = file_get_contents($arquivo);

$usuarios = json_decode($dados, true);


$usuarioLogado = $_SESSION["usuario"];


foreach ($usuarios as &$dadosConta) {

    if ($dadosConta["usuario"] == $usuarioLogado) {


        $contaBanco = new ContaBanco();


        $contaBanco->setNumConta(
            $dadosConta["numConta"]
        );

        $contaBanco->setTipo(
            $dadosConta["tipo"]
        );

        $contaBanco->setDono(
            $dadosConta["nome"]
        );

        $contaBanco->setSaldo(
            $dadosConta["saldo"]
        );

        $contaBanco->setStatus(
            $dadosConta["status"]
        );


        // Verifica se existe saldo suficiente

        if ($contaBanco->getSaldo() >= $valor) {


            // Realiza o saque

            $contaBanco->sacar($valor);


            // Atualiza o saldo

            $dadosConta["saldo"] =
                $contaBanco->getSaldo();


            // -------------------------------
            // SALVAR TRANSAÇÃO
            // -------------------------------

            $arquivoTransacoes = "transacoes.json";


            $dadosTransacoes =
                file_get_contents($arquivoTransacoes);


            $transacoes =
                json_decode($dadosTransacoes, true);


            if (!is_array($transacoes)) {
                $transacoes = [];
            }


            $novaTransacao = [

                "usuario" => $usuarioLogado,

                "tipo" => "saque",

                "valor" => $valor,

                "data" => date("d/m/Y H:i:s")

            ];


            $transacoes[] = $novaTransacao;


            $novoJsonTransacoes =
                json_encode(
                    $transacoes,
                    JSON_PRETTY_PRINT |
                    JSON_UNESCAPED_UNICODE
                );


            file_put_contents(
                $arquivoTransacoes,
                $novoJsonTransacoes
            );
        }


        break;
    }
}


// Salvar novo saldo

$novoJson =
    json_encode(
        $usuarios,
        JSON_PRETTY_PRINT |
        JSON_UNESCAPED_UNICODE
    );


file_put_contents(
    $arquivo,
    $novoJson
);


header("Location: conta.php");

exit;