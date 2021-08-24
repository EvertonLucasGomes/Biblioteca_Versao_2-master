<?php

use PHPUnit\Framework\TestCase;
include("../../tests/classes/persistencia.php");

//comente o bloco require da classe persistencia para executar os testes

class persistenciaTest extends TestCase{

    public function testCadastrarCliente(){
        $this->assertNull(
            persistencia::getInstance()->cadastrarCliente(
                new cliente('313.749.770-12', 'igor', '5390350', '1999-10-25', '(81) 982333074', 'Belo Jardim', 'Água Fria', 'Trav. João Costa Ribeiro', '9')
            )
        );
    }

    public function testSucess(){
        $cliente = new cliente('313.749.770-12', 'igor', '5390350', '1999-10-25', '(81) 982333074', 'Belo Jardim', 'Água Fria', 'Trav. João Costa Ribeiro', '9');
        $livro = new livro(963, 'CDC', '5', 'Meio', 5, 2021, 'Defensoria Publica', 'Federal', 'Direito');
        $aluguel = new clienteAlugaLivro($cliente, $livro, '2021-08-23');

        //Teste de Instância
        $this->assertInstanceOf(
            persistencia::class,
            persistencia::getInstance()
        );

        //Teste de Cadastro
        $this->assertNull(
            persistencia::getInstance()->cadastrarCliente(
                $cliente
            )
        );

        $this->assertNull(
            persistencia::getInstance()->cadastrarLivro(
                $livro
            )
        );

        $this->assertNull(
            persistencia::getInstance()->cadastrarAluguel(
                $aluguel
            )
        );

        //Tests de Consulta
        $this->assertFalse(
            persistencia::getInstance()->existCliente(
                '0100101'
            )
        );

    }

}