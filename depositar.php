<?php

session_start();

require_once "ContaBanco.php";
require_once "Transacao.php";


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


        /*
        |-----------------------------------------
        | Criamos o objeto ContaBanco
        |-----------------------------------------
        */

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


        /*
        |-----------------------------------------
        | Guardamos o saldo anterior
        |-----------------------------------------
        */

        $saldoAnterior = $contaBanco->getSaldo();


        /*
        |-----------------------------------------
        | Realizamos o depósito
        |-----------------------------------------
        */

        $contaBanco->depositar($valor);


        /*
        |-----------------------------------------
        | Pegamos o novo saldo
        |-----------------------------------------
        */

        $saldoAtual = $contaBanco->getSaldo();


        /*
        |-----------------------------------------
        | Atualizamos usuarios.json
        |-----------------------------------------
        */

        $dadosConta["saldo"] = $saldoAtual;


        /*
        |-----------------------------------------
        | Criamos a transação
        |-----------------------------------------
        */

        $transacao = new Transacao();


        $transacao->setUsuario(
            $usuarioLogado
        );

        $transacao->setTipo(
            "deposito"
        );

        $transacao->setValor(
            $valor
        );

        $transacao->setSaldoAnterior(
            $saldoAnterior
        );

        $transacao->setSaldoAtual(
            $saldoAtual
        );

        $transacao->setData(
            date("d/m/Y H:i:s")
        );

        $transacao->setDescricao(
            "Depósito realizado"
        );


        /*
        |-----------------------------------------
        | Lemos transacoes.json
        |-----------------------------------------
        */

        $arquivoTransacoes = "transacoes.json";

        $dadosTransacoes =
            file_get_contents($arquivoTransacoes);

        $transacoes =
            json_decode($dadosTransacoes, true);


        if (!is_array($transacoes)) {

            $transacoes = [];

        }


        /*
        |-----------------------------------------
        | Adicionamos a nova transação
        |-----------------------------------------
        */

        $transacoes[] =
            $transacao->paraArray();


        /*
        |-----------------------------------------
        | Salvamos transacoes.json
        |-----------------------------------------
        */

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


        break;
    }
}


/*
|-----------------------------------------
| Salvamos usuarios.json
|-----------------------------------------
*/

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