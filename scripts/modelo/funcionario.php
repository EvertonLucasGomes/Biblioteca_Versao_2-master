<?php
    /**
     * Entidade Funcionario
     * 
     * @copyright 2021, Igor Santos, Gabriel Vasconcelos, Rafaella Weiss, Everton Lima
     */
    class funcionario{

        /** @var string CPF do Funcionario */
        private $cpf;

        /** @var string Nome do Funcionario */
        private $nome;

        /** @var string RG do Funcionario */
        private $rg;

        /** @var string Data de Nascimento do Funcionario */
        private $data_nascimento;

        /** @var string Telefone do Funcionario */
        private $telefone;

        /** @var string Cidade do Funcionario */
        private $cidade;

        /** @var string Bairro do Funcionario */
        private $bairro;

        /** @var string Rua do Funcionario */
        private $rua;

        /** @var string Número ou Complemento do Endereço do Funcionario */
        private $numero_complemento;
        
        /** @var string Cargo do Funcionário*/
        private $cargo;

        /** @var string Login do Funcionário*/
        private $login;

        /** @var string Senha do Funcionário*/
        private $senha;

        /**
         * Construtor da Classe Funcionario
         * @param string $cpf CPF do Funcionario (Atributo Obrigatório para Instancia da Classe)
         * @param string|null $nome Nome do Funcionario
         * @param string|null $rg RG do Funcionario
         * @param string|null $data_nascimento Data de Nascimento do Funcionario
         * @param string|null $telefone Telefone do Funcionario
         * @param string|null $cidade Cidade do Funcionario
         * @param string|null $bairro Bairro do Funcionario
         * @param string|null $rua Rua do Funcionario
         * @param string|null $numero_complemento Número ou Complemento do Endereço do Funcionario
         * @param string|null $cargo Cargo do funcionário
         * @param string|null $login Login do funcionário
         * @param string|null $senha Senha do funcionário
         */
        public function __construct($cpf=null, $nome=null, $rg=null, $data_nascimento=null, $telefone=null, $cidade=null, $bairro=null, $rua=null, $numero_complemento=null, $cargo=null, $login=null, $senha=null)
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
            $this->cargo = $cargo;
            $this->login = $login;
            $this->senha = $senha;
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

        public function getCargo(){
            return $this->cargo;
        }

        public function getLogin(){
            return $this->login;
        }
        
        public function getSenha(){
            return $this->senha;
        }

        public function __toString()
        {
            return "$this->cpf";
        }
    }
?>