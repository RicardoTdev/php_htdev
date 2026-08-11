<?php

class Transacao
{
    private $usuario;
    private $tipo;
    private $valor;
    private $saldoAnterior;
    private $saldoAtual;
    private $data;
    private $descricao;


    // Usuário

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }


    // Tipo

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }


    // Valor

    public function getValor()
    {
        return $this->valor;
    }

    public function setValor($valor)
    {
        $this->valor = $valor;
    }


    // Saldo anterior

    public function getSaldoAnterior()
    {
        return $this->saldoAnterior;
    }

    public function setSaldoAnterior($saldoAnterior)
    {
        $this->saldoAnterior = $saldoAnterior;
    }


    // Saldo atual

    public function getSaldoAtual()
    {
        return $this->saldoAtual;
    }

    public function setSaldoAtual($saldoAtual)
    {
        $this->saldoAtual = $saldoAtual;
    }


    // Data

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }


    // Descrição

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }


    // Transformar objeto em array

    public function paraArray()
    {
        return [
            "usuario" => $this->usuario,
            "tipo" => $this->tipo,
            "valor" => $this->valor,
            "saldoAnterior" => $this->saldoAnterior,
            "saldoAtual" => $this->saldoAtual,
            "data" => $this->data,
            "descricao" => $this->descricao
        ];
    }
}