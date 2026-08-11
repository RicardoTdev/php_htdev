<?php

session_start();

require_once __DIR__ . "/app/classes/ContaBanco.php";
require_once __DIR__ . "/app/classes/Transacao.php";


// Verifica se o usuário está logado
if (!isset($_SESSION["usuario"])) {

    header("Location: index.php");
    exit;
}


// Verifica se a requisição veio através de POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {

    header("Location: conta.php");
    exit;
}


// Pega o valor enviado pelo formulário
$valor = (float) $_POST["valor"];


// Impede depósito com valor inválido
if ($valor <= 0) {

    header("Location: conta.php");
    exit;
}


// Caminho do arquivo de usuários
$arquivo = __DIR__ . "/data/usuarios.json";


// Lê o arquivo JSON
$dados = file_get_contents($arquivo);


// Converte o JSON para array PHP
$usuarios = json_decode($dados, true);


// Usuário atualmente logado
$usuarioLogado = $_SESSION["usuario"];


foreach ($usuarios as &$dadosConta) {

    if ($dadosConta["usuario"] === $usuarioLogado) {

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
        | Atualizamos o saldo do usuário
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
        | Caminho do arquivo de transações
        |-----------------------------------------
        */

        $arquivoTransacoes =
            __DIR__ . "/data/transacoes.json";


        /*
        |-----------------------------------------
        | Lemos transacoes.json
        |-----------------------------------------
        */

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


/*
|-----------------------------------------
| Voltamos para a conta
|-----------------------------------------
*/

header("Location: conta.php");

exit;