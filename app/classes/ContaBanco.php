<?php

class ContaBanco
{
    // Atributos

    public $numConta;
    protected $tipo;
    private $dono;
    private $saldo;
    private $status;


    // Métodos

    public function abrirConta($t)
    {
        $this->setTipo($t);
        $this->setStatus(true);

        if ($t == "CC") {

            $this->setSaldo(150);

        } elseif ($t == "CP") {

            $this->setSaldo(150);
        }
    }


    public function fecharConta()
    {
        if ($this->getSaldo() > 0) {

            echo "<p>Conta ainda tem dinheiro, não posso fechá-la!</p>";

        } elseif ($this->getSaldo() < 0) {

            echo "<p>Conta está em débito. Impossível encerrar!</p>";

        } else {

            $this->setStatus(false);
        }
    }


    public function depositar($v)
    {
        if ($this->getStatus()) {

            $this->setSaldo(
                $this->getSaldo() + $v
            );

        } else {

            echo "<p>Impossível depositar em uma conta fechada!</p>";
        }
    }


    public function sacar($v)
    {
        if ($this->getStatus()) {

            if ($this->getSaldo() >= $v) {

                $this->setSaldo(
                    $this->getSaldo() - $v
                );

            } else {

                echo "<p>Saldo insuficiente para saque.</p>";
            }

        } else {

            echo "<p>Não posso sacar de uma conta fechada!</p>";
        }
    }


    public function pagarMensal()
    {
        $v = 0;

        if ($this->getTipo() == "CC") {

            $v = 12;

        } elseif ($this->getTipo() == "CP") {

            $v = 20;
        }


        if ($this->getStatus()) {

            $this->setSaldo(
                $this->getSaldo() - $v
            );

        } else {

            echo "<p>Problemas com a conta. Não posso cobrar!</p>";
        }
    }


    // Método construtor

    public function __construct()
    {
        $this->setSaldo(0);
        $this->setStatus(false);
    }


    // Getters e Setters

    public function getNumConta()
    {
        return $this->numConta;
    }

    public function setNumConta($n)
    {
        $this->numConta = $n;
    }


    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($t)
    {
        $this->tipo = $t;
    }


    public function getDono()
    {
        return $this->dono;
    }

    public function setDono($d)
    {
        $this->dono = $d;
    }


    public function getSaldo()
    {
        return $this->saldo;
    }

    public function setSaldo($s)
    {
        $this->saldo = $s;
    }


    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($s)
    {
        $this->status = $s;
    }
}