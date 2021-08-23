<?php
    require_once("../scripts/persistencia/persistencia.php");
    require_once("../scripts/util/util.php");
    
    /**
     * Entidade Conexao - 
     * Conexão entre a lógica de negócio e a persistência
     * 
     * @copyright 2021, Igor Santos, Gabriel Vasconcelos, Rafaella Weiss, Everton Lima
     */
    class conexao{

        /** @var conexao Instância da Classe Conexão*/
        public static $instance;
        
        /**
         * @return conexao Retorna uma instância de Conexao
         */
        public static function getInstance(){
            if(empty(self::$instance)){
                return self::$instance = new conexao();
            }

            return self::$instance;
        }
        
        /**
         * Recebe os parametros e envia o objeto Cliente para a persistência para ser cadastrado
         * @param string $cpf CPF do cliente
         * @param string $nome Nome do cliente
         * @param string $rg RG do cliente
         * @param string $data_nascimento Data de Nascimento do cliente
         * @param string $telefone Telefone do cliente
         * @param string $cidade Cidade do cliente
         * @param string $bairro Bairro do cliente
         * @param string $rua Rua do cliente
         * @param string $numero_complemento Número ou Complemento do Endereço do cliente
         * 
         * @return null
         */
        public function salvarCliente($nome, $cpf, $rg, $data_nascimento, $telefone, $cidade, $bairro, $rua, $numero_complemento){
            //ENVIA UM OBJETO DE CLIENTE PARA CADASTRAR NO BANCO DE DADOS
            persistencia::getInstance()->cadastrarCliente(
                new cliente($nome, $cpf, $rg, $data_nascimento, $telefone, $cidade, $bairro, $rua, $numero_complemento)
            );
        }
        
        /**
         * Recebe os parâmetros e envia o objeto Livro para a persistência para ser cadastrado
         * @param int $codigo Código do Livro
         * @param string $nome Nome do Livro
         * @param string $estante Estante do Livro
         * @param string $prateleira Prateleira do Livro
         * @param int $quantidade Quantidade disponível do Livro
         * @param int $ano Ano de Publicação do Livro
         * @param string $autor Autor do Livro
         * @param string $editora Editora que publicou do Livro
         * @param string $genero Gênero do Livro
         * 
         * @return null
         */
        public function salvarLivro($nome, $codigo, $estante, $prateleira, $quantidade, $ano, $autor, $editora, $genero){
            persistencia::getInstance()->cadastrarLivro(
                new livro($nome, $codigo, $estante, $prateleira, $quantidade, $ano, $autor, $editora, $genero)
            );
        }
        
        /**
         * Recebe os parâmetros e envia o objeto ClienteAlugaLivro para a persistência
         * @param string $cpfCliente CPF do Cliente que está alugando o livro
         * @param string $codigoLivro Código do Livro que está sendo alugado
         * @param string $dataAluguel Data que foi efetuada a locação do livro
         * 
         * @return null
         */
        public function salvarClienteAlugaLivro($cpfCliente, $codigoLivro, $dataAluguel){
            
            persistencia::getInstance()->cadastrarAluguel(
                new clienteAlugaLivro(new cliente($cpfCliente), new livro($codigoLivro), $dataAluguel)
            );
        }
        
        /**
         * Recebe os parâmetros e envia uma instância clienteAlugaLivro para a persistência no qual será atualizado para entregue
         * @param string $id
         * @param string $dataDevolucao
         * 
         * @return null
         */
        public function salvarEntregaLivro($id, $dataDevolucao){
            $instanceAluguel = new clienteAlugaLivro(
                new cliente(),
                new livro()
            );
            
            $instanceAluguel->setId($id);
            $instanceAluguel->setDataDevolucao($dataDevolucao);
            $instanceAluguel->setStatus('Entregue');

            persistencia::getInstance()->updateStatusEmprestimo(
                $instanceAluguel
            );
        }

        /**
         * Recebe os parâmetros e envia uma instância Funcionario para a persistência para ser cadastrado
         * @param string $nome
         * @param string $cpf
         * @param string $rg
         * @param string $data_nascimento
         * @param string $telefone
         * @param string $cidade
         * @param string $bairro
         * @param string $rua
         * @param string $numero_complemento
         * @param string $cargo
         * @param string $login
         * @param string $senha
         * 
         * @return null
         */
        public function salvarFuncionario($nome, $cpf, $rg, $data_nascimento, $telefone, $cidade, $bairro, $rua, $numero_complemento, $cargo, $login, $senha){
            persistencia::getInstance()->cadastrarFuncionario(
                new funcionario($nome, $cpf, $rg, $data_nascimento, $telefone, $cidade, $bairro, $rua, $numero_complemento, $cargo, $login, $senha)
            );
        }
        
        /**
         * Recebe os parâmetros e envia uma instância Livro para a persistência para ser atualizado
         * @param string $nome
         * @param int $codigo
         * @param string $estante
         * @param string $prateleira
         * @param int $quantidade
         * @param int $ano
         * @param string $autor
         * @param string $editora
         * @param string $genero
         * 
         * @return null
         */
        public function atualizarLivro($nome, $codigo, $estante, $prateleira, $quantidade, $ano, $autor, $editora, $genero){
            persistencia::getInstance()->updateLivro(
                new livro($nome, $codigo, $estante, $prateleira, $quantidade, $ano, $autor, $editora, $genero)
            );
        }

        /**
         * Recebe os parâmetros e envia uma instância Cliente para a persistência para ser atualizado
         * @param string $nome
         * @param string $cpf
         * @param string $rg
         * @param string $data_nascimento
         * @param string $telefone
         * @param string $cidade
         * @param string $bairro
         * @param string $rua
         * @param string $numero_complemento
         * 
         * @return null
         */
        public function atualizarCliente($nome, $cpf, $rg, $data_nascimento, $telefone, $cidade, $bairro, $rua, $numero_complemento){
            persistencia::getInstance()->updateCliente(
                new cliente($nome, $cpf, $rg, $data_nascimento, $telefone, $cidade, $bairro, $rua, $numero_complemento)
            );
        }

        /**
         * Recebe os parâmetros e envia uma instância Funcionario para a persistência para ser atualizado
         * @param string $nome
         * @param string $cpf
         * @param string $rg
         * @param string $data_nascimento
         * @param string $telefone
         * @param string $cidade
         * @param string $bairro
         * @param string $rua
         * @param string $numero_complemento
         * @param string $cargo
         * @param string $login
         * @param string $senha
         * 
         * @return null
         */
        public function atualizarFuncionario($nome, $cpf, $rg, $data_nascimento, $telefone, $cidade, $bairro, $rua, $numero_complemento, $cargo, $login, $senha){
            persistencia::getInstance()->updateFuncionario(
                new funcionario($nome, $cpf, $rg, $data_nascimento, $telefone, $cidade, $bairro, $rua, $numero_complemento, $cargo, $login, $senha)
            );
        }
    }
?>