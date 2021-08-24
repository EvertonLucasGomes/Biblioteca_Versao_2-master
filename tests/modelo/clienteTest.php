<?php

include("../../scripts/modelo/cliente.php");
use PHPUnit\Framework\TestCase;

class clienteTest extends TestCase{
    public function testGetNome(){
        $cliente = new cliente('123', 'igor', '5390350', '1999-10-25', '(81) 982333074', 'Belo Jardim', 'Água Fria', 'Trav. João Costa Ribeiro', '9');
        $this->assertEquals(
            'igor',
            $cliente->getNome()
        );
    }

    public function testGetCpf(){
        $cliente = new cliente('123', 'igor', '5390350', '1999-10-25', '(81) 982333074', 'Belo Jardim', 'Água Fria', 'Trav. João Costa Ribeiro', '9');
        $this->assertEquals(
            '123',
            $cliente->getCpf()
        );

    }

    public function testGetRg(){
        $cliente = new cliente('123', 'igor', '5390350', '1999-10-25', '(81) 982333074', 'Belo Jardim', 'Água Fria', 'Trav. João Costa Ribeiro', '9');
        $this->assertEquals(
            '5390350',
            $cliente->getRg()
        );
    }
    
    public function testGetDataNascimento(){
        $cliente = new cliente('123', 'igor', '5390350', '1999-10-25', '(81) 982333074', 'Belo Jardim', 'Água Fria', 'Trav. João Costa Ribeiro', '9');
        $this->assertEquals(
            '1999-10-25',
            $cliente->getDataNascimento()
        );
    }

    public function testGetTelefone(){
        $cliente = new cliente('123', 'igor', '5390350', '1999-10-25', '(81) 982333074', 'Belo Jardim', 'Água Fria', 'Trav. João Costa Ribeiro', '9');
        $this->assertEquals(
            '(81) 982333074',
            $cliente->getTelefone()
        );
    }

    public function testGetCidade(){
        $cliente = new cliente('123', 'igor', '5390350', '1999-10-25', '(81) 982333074', 'Belo Jardim', 'Água Fria', 'Trav. João Costa Ribeiro', '9');
        $this->assertEquals(
            'Belo Jardim',
            $cliente->getCidade()
        );
    }

    public function testGetBairro(){
        $cliente = new cliente('123', 'igor', '5390350', '1999-10-25', '(81) 982333074', 'Belo Jardim', 'Água Fria', 'Trav. João Costa Ribeiro', '9');
        $this->assertEquals(
            'Água Fria',
            $cliente->getBairro()
        );
    }

    public function testGetRua(){
        $cliente = new cliente('123', 'igor', '5390350', '1999-10-25', '(81) 982333074', 'Belo Jardim', 'Água Fria', 'Trav. João Costa Ribeiro', '9');
        $this->assertEquals(
            'Trav. João Costa Ribeiro',
            $cliente->getRua()
        );
    }

    public function testGetNumeroComplemento(){
        $cliente = new cliente('123', 'igor', '5390350', '1999-10-25', '(81) 982333074', 'Belo Jardim', 'Água Fria', 'Trav. João Costa Ribeiro', '9');
        $this->assertEquals(
            '9',
            $cliente->getNumeroComplemento()
        );
    }

    public function testInstancia(){
        $cliente = new cliente('123', 'igor', '5390350', '1999-10-25', '(81) 982333074', 'Belo Jardim', 'Água Fria', 'Trav. João Costa Ribeiro', '9');
        $this->assertInstanceOf(
            cliente::class,
            $cliente
        );
    }

}