<?php
    
    /**
     * Entidade Cliente
     * 
     * @copyright 2021, Igor Santos, Gabriel Vasconcelos, Rafaella Weiss, Everton Lima
     */
    class cliente{

        /** @var string CPF do cliente */
        private $cpf;

        /** @var string Nome do cliente */
        private $nome;

        /** @var string RG do cliente */
        private $rg;

        /** @var string Data de Nascimento do cliente */
        private $data_nascimento;

        /** @var string Telefone do cliente */
        private $telefone;

        /** @var string Cidade do cliente */
        private $cidade;

        /** @var string Bairro do cliente */
        private $bairro;

        /** @var string Rua do cliente */
        private $rua;

        /** @var string Número ou Complemento do Endereço do cliente */
        private $numero_complemento;
        
        /**
         * Construtor da Classe Cliente
         * @param string $cpf CPF do Cliente (Atributo Obrigatório para Instancia da Classe)
         * @param string|null $nome Nome do Cliente
         * @param string|null $rg RG do Cliente
         * @param string|null $data_nascimento Data de Nascimento do Cliente
         * @param string|null $telefone Telefone do Cliente
         * @param string|null $cidade Cidade do Cliente
         * @param string|null $bairro Bairro do Cliente
         * @param string|null $rua Rua do Cliente
         * @param string|null $numero_complemento Número ou Complemento do Endereço do cliente
         */
        public function __construct($cpf=null, $nome=null, $rg=null, $data_nascimento=null, $telefone=null, $cidade=null, $bairro=null, $rua=null, $numero_complemento=null)
        {
            $this->cpf = $cpf;
            $this->nome = $nome;
            $this->rg = $rg;
            $this->data_nascimento = $data_nascimento;
            $this->telefone = $telefone;
            $this->cidade = $cidade;
            $this->bairro = $bairro;
            $this->rua = $rua;
            $this->numero_complemento = $numero_complemento;
        }

        public function getNome(){
            return $this->nome;
        }
        
        public function getCpf(){
            return $this->cpf;
        }

        public function getRg(){
            return $this->rg;
        }
        
        public function getDataNascimento(){
            return $this->data_nascimento;
        }

        public function getTelefone(){
            return $this->telefone;
        }

        public function getCidade(){
            return $this->cidade;
        }

        public function getBairro(){
            return $this->bairro;
        }

        public function getRua(){
            return $this->rua;
        }

        public function getNumeroComplemento(){
            return $this->numero_complemento;
        }

        public function __toString()
        {
            return "$this->cpf";
        }
    }
?>