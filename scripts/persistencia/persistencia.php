<?php
    require_once("../scripts/modelo/cliente.php");
    require_once("../scripts/modelo/livro.php");
    require_once("../scripts/modelo/funcionario.php");
    require_once("../scripts/modelo/clienteAlugaLivro.php");
    
    require_once("connection.php");
    
    /**
     * Entidade Persistencia - 
     * Conexão e execução da persistência no banco de dados
     * 
     * @copyright 2021, Igor Santos, Gabriel Vasconcelos, Rafaella Weiss, Everton Lima
     */
    class persistencia{
        
        /**
         * @var persistencia $instance
         */
        public static $instance;
        
        /** Cria se não existe e retorna uma instância de Persistencia
         * @return persistencia
         */
        public static function getInstance(){
            if(empty(self::$instance)){
                return self::$instance = new persistencia();
            }
            
            return self::$instance;
        }
        
        /**
         * Cadastra um Cliente no banco de dados
         * @param cliente $cliente
         * 
         * @return null
         */
        public function cadastrarCliente($cliente){
            $query = "INSERT INTO cliente 
            VALUES ('".$cliente->getCpf()."', '".$cliente->getNome()."', '".$cliente->getRg()."', '".$cliente->getDataNascimento()."', '".$cliente->getTelefone()."', '".$cliente->getCidade()."', '".$cliente->getBairro()."', '".$cliente->getRua()."', '".$cliente->getNumeroComplemento()."');";

            mysqli_query(
                connection::getConnection(), 
                $query
            );
        }

        /**
         * Cadastra um Livro no banco de dados
         * @param livro $livro
         * 
         * @return null
         */
        public function cadastrarLivro($livro){
            $query = "INSERT INTO livro 
            VALUES ('".$livro->getCodigo()."', '".$livro->getNome()."', '".$livro->getEstante()."', '".$livro->getPrateleira()."', ".$livro->getQuantidade().", ".$livro->getAno().", '".$livro->getAutor()."', '".$livro->getEditora()."', '".$livro->getGenero()."');";
            
            mysqli_query(
                connection::getConnection(), 
                $query
            );
        }

        /**
         * Cadastra um Aluguel no banco de dados e remove o livro do stock
         * @param aluguel $aluguel
         * 
         * @return null
         */
        public function cadastrarAluguel($aluguel){

            $query = "INSERT INTO cliente_aluga_livro(cpf_cliente, codigo_livro, data_aluguel, status, data_devolucao)
            VALUES ('".$aluguel->getClienteAluguel()->getCpf()."', ".$aluguel->getLivroAluguel()->getCodigo().", '".$aluguel->getDataAluguel()."', '".$aluguel->getStatus()."', Null);";

            mysqli_query(
                connection::getConnection(), 
                $query
            );
            
            //TIRAR LIVRO DO STOCK
            $this->updateQuantidadeEmprestimo(
                $aluguel->getLivroAluguel(),
                -1
            );
        }
        
        /**
         * Cadastra um Funcionario no banco de dados
         * @param funcionario $funcionario
         * 
         * @return null
         */
        public function cadastrarFuncionario($funcionario){
            $query = "INSERT INTO funcionario 
            VALUES ('".$funcionario->getCpf()."', '".$funcionario->getNome()."', '".$funcionario->getRg()."', '".$funcionario->getDataNascimento()."', '".$funcionario->getTelefone()."', '".$funcionario->getCidade()."', '".$funcionario->getBairro()."', '".$funcionario->getRua()."', '".$funcionario->getNumeroComplemento()."', '".$funcionario->getCargo()."', '".$funcionario->getLogin()."', '".$funcionario->getSenha()."');";
            
            mysqli_query(
                connection::getConnection(), 
                $query
            );
        }


        /**
         * Retorna um instância de Cliente com correspondência do CPF
         * @param string $cpf
         * 
         * @return cliente|null
         */
        public function getCliente($cpf){

            $query = "select * from cliente where cpf='$cpf'";

            $cliente = mysqli_query(
                connection::getConnection(), 
                $query
            );
            
            while ($dados_cliente = mysqli_fetch_assoc($cliente)) {
                //RETORNA UMA INSTANCIA DE CLIENTE
                return new cliente(
                    $dados_cliente['cpf'],
                    $dados_cliente['nome'],
                    $dados_cliente['rg'],
                    $dados_cliente['data_nascimento'],
                    $dados_cliente['telefone'],
                    $dados_cliente['cidade'],
                    $dados_cliente['bairro'],
                    $dados_cliente['rua'],
                    $dados_cliente['numero_complemento']
                );
            }
        }
        
        /**
         * Retorna um instância de Cliente com correspondência do Código
         * @param mixed $codigo
         * 
         * @return livro|null
         */
        public function getLivro($codigo){

            $query = "select * from livro where codigo_livro=$codigo;";

            $livro = mysqli_query(
                connection::getConnection(), 
                $query
            );
            
            while ($dados_livro = mysqli_fetch_assoc($livro)) {
                //RETORNA UMA INSTANCIA DE LIVRO
                return new livro(
                    $dados_livro['codigo_livro'],
                    $dados_livro['nome_livro'],
                    $dados_livro['estante'],
                    $dados_livro['prateleira'],
                    $dados_livro['quantidade'],
                    $dados_livro['ano'],
                    $dados_livro['autor'],
                    $dados_livro['editora'],
                    $dados_livro['genero'],
                );
            }
        }

        /**
         * Retorna um instância do Funcionário com correspondência do CPF
         * @param string $cpf
         * 
         * @return funcionario|null
         */
        public function getFuncionario($cpf){

            $query = "select * from funcionario where cpf='$cpf'";

            $funcionario = mysqli_query(
                connection::getConnection(), 
                $query
            );
            
            while ($dados_funcionario = mysqli_fetch_assoc($funcionario)) {
                //RETORNA UMA INSTANCIA DE FUNCIONARIO
                return new funcionario(
                    $dados_funcionario['cpf'],
                    $dados_funcionario['nome'],
                    $dados_funcionario['rg'],
                    $dados_funcionario['data_nascimento'],
                    $dados_funcionario['telefone'],
                    $dados_funcionario['cidade'],
                    $dados_funcionario['bairro'],
                    $dados_funcionario['rua'],
                    $dados_funcionario['numero_complemento'],
                    $dados_funcionario['cargo'],
                    $dados_funcionario['login'],
                    $dados_funcionario['senha']
                );
            }
        }

        /**
         * Retorna uma lista de instâncias de Livro que contenham a string $nome_livro
         * @param string $nome_livro
         * 
         * @return livro[]|null 
         */
        public function getLivroNome($nome_livro){
            $arrayLivros = array();

            $query = "select * from livro where nome_livro LIKE '%$nome_livro%';";
            
            $livros = mysqli_query(
                connection::getConnection(), 
                $query
            );
            
            while ($dados_livro = mysqli_fetch_assoc($livros)) {
                //RETORNA TODOS OS CLIENTES
                $arrayLivros[] = new livro(
                    $dados_livro['codigo_livro'],
                    $dados_livro['nome_livro'],
                    $dados_livro['estante'],
                    $dados_livro['prateleira'],
                    $dados_livro['quantidade'],
                    $dados_livro['ano'],
                    $dados_livro['autor'],
                    $dados_livro['editora'],
                    $dados_livro['genero'],
                );
            }
            
            return $arrayLivros;
        }

        /**
         * Retorna uma instância de clienteAlugaLivro com correspondência
         * @param string $id
         * 
         * @return clienteAlugaLivro|null
         */
        public function getClienteAlugaLivro($id){

            $query = "SELECT cal.id, c.cpf, c.nome, l.codigo_livro, l.nome_livro, cal.data_aluguel, cal.status, cal.data_devolucao 
            FROM livro l, cliente c, cliente_aluga_livro cal 
            WHERE l.codigo_livro=cal.codigo_livro and c.cpf=cal.cpf_cliente and cal.id=$id;";

            $aluguel = mysqli_query(
                connection::getConnection(), 
                $query
            );
            
            while ($dados_aluguel = mysqli_fetch_assoc($aluguel)) {
                
                $instanceAluguel = new clienteAlugaLivro(
                    new cliente(
                        $dados_aluguel['cpf'],
                        $dados_aluguel['nome']
                    ),
                    new livro(
                        $dados_aluguel['codigo_livro'],
                        $dados_aluguel['nome_livro']
                    ),
                    $dados_aluguel['data_aluguel']
                );
                
                $instanceAluguel->setId(
                    $dados_aluguel['id']
                );
                
                $instanceAluguel->setStatus(
                    $dados_aluguel['status']
                );
                
                $instanceAluguel->setDataDevolucao(
                    $dados_aluguel['data_devolucao']
                );
                
                //RETORNA UMA INSTANCIA DE CLIENTE ALUGA LIVRO
                return $instanceAluguel;
            }
        }
        
        /**
         * Retorna uma lista de instâncias de clienteAlugaLivro com correspondência de $cpf
         * @param string $cpf
         * 
         * @return clienteAlugaLivro[]|array
         */
        public function getEmprestimoCliente($cpf){

            $arrayEmprestimos = array();

            $query = "  SELECT cal.id, c.cpf, c.nome, l.codigo_livro, l.nome_livro, cal.data_aluguel, cal.status, cal.data_devolucao 
                        FROM livro l, cliente c, cliente_aluga_livro cal 
                        WHERE l.codigo_livro=cal.codigo_livro and c.cpf=cal.cpf_cliente and c.cpf='$cpf'
                        ORDER BY cal.id DESC;";
            
            $alugueis = mysqli_query(
                connection::getConnection(), 
                $query
            );
            
            while ($dados_aluguel = mysqli_fetch_assoc($alugueis)) {
                
                $instanceAluguel = new clienteAlugaLivro(
                    new cliente(
                        $dados_aluguel['cpf'],
                        $dados_aluguel['nome']
                    ),
                    new livro(
                        $dados_aluguel['codigo_livro'],
                        $dados_aluguel['nome_livro']
                    ),
                    $dados_aluguel['data_aluguel']
                );
                
                $instanceAluguel->setId(
                    $dados_aluguel['id']
                );
                
                $instanceAluguel->setStatus(
                    $dados_aluguel['status']
                );
                
                $instanceAluguel->setDataDevolucao(
                    $dados_aluguel['data_devolucao']
                );

                $arrayEmprestimos[] = $instanceAluguel;
            }

            return $arrayEmprestimos;
        }

        /**
         * Retorna a quantidade de Clientes cadastrados
         * 
         * @return int
         */
        public function getQuantidadeClientes()
        {
            $query = "select count(*) as quant from cliente";

            $quant_clientes = mysqli_query(
                connection::getConnection(), 
                $query
            );
            
            while ($quantidade = mysqli_fetch_assoc($quant_clientes)) {
                //
                return $quantidade['quant'];
            }
        }
        
        /**
         * Retorna a quantidade de Livros cadastrados
         * 
         * @return int
         */
        public function getQuantidadeLivros()
        {
            $query = "select count(*) as quant from livro";

            $quant_livros = mysqli_query(
                connection::getConnection(), 
                $query
            );
            
            while ($quantidade = mysqli_fetch_assoc($quant_livros)) {
                //RETORNA QUANTIDADE DE LIVROS CADASTRADOS
                return $quantidade['quant'];
            }
        }

        /**
         * Retorna quantidade de Emprestimos que estão com status=pendente
         * 
         * @return int
         */
        public function getQuantidadeEmprestimos()
        {
            $query = "select count(*) as quant from cliente_aluga_livro where status='PENDENTE'";

            $quant_livros = mysqli_query(
                connection::getConnection(), 
                $query
            );
            
            while ($quantidade = mysqli_fetch_assoc($quant_livros)) {
                //RETORNA QUANTIDADE DE LIVROS CADASTRADOS
                return $quantidade['quant'];
            }
        }
        
        /**
         * Retorna a quantidade disponível do Livro
         * @param int $codigo_livro
         * 
         * @return int|null
         */
        public function getQuantidadeLivro($codigo_livro){
            $query = "SELECT quantidade FROM livro WHERE codigo_livro=$codigo_livro";
            
            $stock = mysqli_query(
                connection::getConnection(), 
                $query
            );
            
            while ($livro = mysqli_fetch_assoc($stock)) {
                //RETORNA QUANTIDADE DE LIVROS NO STOCK
                return $livro['quantidade'];
            }
        }

        /**
         * Verifica o status do Livro, retorna True se existir um livro com status=PENDENTE
         * @param int $codigo
         * 
         * @return boolean
         */
        public function dependenciaLivro($codigo){
            $query = "  SELECT count(*) as quant_pendencias FROM cliente_aluga_livro
                        WHERE status='PENDENTE' AND codigo_livro=$codigo;";

            $quant = mysqli_query(
                connection::getConnection(), 
                $query
            );

            while ($q = mysqli_fetch_assoc($quant)) {
                if ($q['quant_pendencias'] > 0)
                    return true;
                
                return false;
            }
        }
        
        /**
         * Retorna uma lista de instâncias de Cliente
         * 
         * @return cliente[]|array
         */
        public function getTodosClientes(){
            $arrayClientes = array();

            $query = "SELECT * FROM cliente;";
            
            $clientes = mysqli_query(
                connection::getConnection(), 
                $query
            );
            
            while ($cliente = mysqli_fetch_assoc($clientes)) {
                //RETORNA TODOS OS CLIENTES
                $arrayClientes[] = new cliente(
                    $cliente['cpf'],
                    $cliente['nome'],
                    $cliente['rg'],
                    $cliente['data_nascimento'],
                    $cliente['telefone'],
                    $cliente['cidade'],
                    $cliente['bairro'],
                    $cliente['rua'],
                    $cliente['numero_complemento']
                );
            }
            
            return $arrayClientes;
        }

        /**
         * Retorna uma lista de instâncias de Livro
         * 
         * @return livro[]|array
         */
        public function getTodosLivros(){
            $arrayLivros = array();

            $query = "SELECT * FROM livro;";
            
            $livros = mysqli_query(
                connection::getConnection(), 
                $query
            );
            
            while ($dados_livro = mysqli_fetch_assoc($livros)) {
                //RETORNA TODOS OS CLIENTES
                $arrayLivros[] = new livro(
                    $dados_livro['codigo_livro'],
                    $dados_livro['nome_livro'],
                    $dados_livro['estante'],
                    $dados_livro['prateleira'],
                    $dados_livro['quantidade'],
                    $dados_livro['ano'],
                    $dados_livro['autor'],
                    $dados_livro['editora'],
                    $dados_livro['genero'],
                );
            }
            
            return $arrayLivros;
        }

        /**
         * Retorna uma lista de instâncias de clienteAlugaLivro
         * 
         * @return clienteAlugaLivro[]|array
         */
        public function getTodosEmprestimos(){

            $arrayEmprestimos = array();

            $query = "  SELECT cal.id, c.cpf, c.nome, l.codigo_livro, l.nome_livro, cal.data_aluguel, cal.status, cal.data_devolucao 
                        FROM livro l, cliente c, cliente_aluga_livro cal 
                        WHERE l.codigo_livro=cal.codigo_livro and c.cpf=cal.cpf_cliente
                        ORDER BY cal.id DESC;";
            
            $alugueis = mysqli_query(
                connection::getConnection(), 
                $query
            );
            
            while ($dados_aluguel = mysqli_fetch_assoc($alugueis)) {
                
                $instanceAluguel = new clienteAlugaLivro(
                    new cliente(
                        $dados_aluguel['cpf'],
                        $dados_aluguel['nome']
                    ),
                    new livro(
                        $dados_aluguel['codigo_livro'],
                        $dados_aluguel['nome_livro']
                    ),
                    $dados_aluguel['data_aluguel']
                );
                
                $instanceAluguel->setId(
                    $dados_aluguel['id']
                );
                
                $instanceAluguel->setStatus(
                    $dados_aluguel['status']
                );
                
                $instanceAluguel->setDataDevolucao(
                    $dados_aluguel['data_devolucao']
                );

                $arrayEmprestimos[] = $instanceAluguel;
            }

            return $arrayEmprestimos;
        }
        
        /**
         * Verifica se o cliente está cadastrado
         * @param string $cpf
         * 
         * @return boolean
         */
        public function existCliente($cpf){
            if($this->getCliente($cpf) == null){
                return false;
            }
            
            return true;
        }

        /**
         * Verifica se o livro está cadastrado
         * @param int $codigo_livro
         * 
         * @return boolean
         */
        public function existLivro($codigo_livro){
            if($this->getLivro($codigo_livro) == null){
                return false;
            }
            
            return true;
        }

        /**
         * Verifica se o aluguel está cadastrado e status=PENDENTE
         * @param int $codigo_livro
         * 
         * @return boolean
         */
        public function existEmprestimo($idAluguel){
            $instanceAluguel = $this->getClienteAlugaLivro($idAluguel);

            if($instanceAluguel != null){
                if($instanceAluguel->getStatus() == 'PENDENTE')
                    return true;
            }
            
            return false;
        }

        /**
         * Verifica se o funcionario está cadastrado
         * @param string $cpf
         * 
         * @return boolean
         */
        public function existFuncionario($cpf){
            if($this->getFuncionario($cpf) == null){
                return false;
            }
            
            return true;
        }

        /**
         * Atualizar o Cliente no banco de dados
         * @param cliente $cliente
         * 
         * @return null
         */
        public function updateCliente($cliente){
            $query = "  UPDATE cliente 
                        SET nome='".$cliente->getNome()."',
                        rg='".$cliente->getRg()."',
                        data_nascimento='".$cliente->getDataNascimento()."',
                        telefone='".$cliente->getTelefone()."',
                        cidade='".$cliente->getCidade()."',
                        bairro='".$cliente->getBairro()."',
                        rua='".$cliente->getRua()."',
                        numero_complemento='".$cliente->getNumeroComplemento()."'
                        WHERE cpf='".$cliente->getCpf()."';
                    ";

            mysqli_query(
                connection::getConnection(), 
                $query
            );
        }

        /**
         * Atualizar o Livro no banco de dados
         * @param livro $livro
         * 
         * @return null
         */
        public function updateLivro($livro){
            $query = "  UPDATE livro 
                        SET nome_livro='".$livro->getNome()."',
                        estante='".$livro->getEstante()."',
                        prateleira='".$livro->getPrateleira()."',
                        quantidade=".$livro->getQuantidade().",
                        ano=".$livro->getAno().",
                        autor='".$livro->getAutor()."',
                        editora='".$livro->getEditora()."',
                        genero='".$livro->getGenero()."'
                        WHERE codigo_livro=".$livro->getCodigo().";
                    ";

            mysqli_query(
                connection::getConnection(), 
                $query
            );
        }
        
        /**
         * Atualizar o Funcionario no banco de dados
         * @param funcionario $funcionario
         * 
         * @return null
         */
        public function updateFuncionario($funcionario){

            $query = "  UPDATE funcionario 
                        SET nome='".$funcionario->getNome()."',
                        rg='".$funcionario->getRg()."',
                        data_nascimento='".$funcionario->getDataNascimento()."',
                        telefone='".$funcionario->getTelefone()."',
                        cidade='".$funcionario->getCidade()."',
                        bairro='".$funcionario->getBairro()."',
                        rua='".$funcionario->getRua()."',
                        numero_complemento='".$funcionario->getNumeroComplemento()."',
                        cargo='".$funcionario->getCargo()."',
                        login='".$funcionario->getLogin()."'
                        WHERE cpf='".$funcionario->getCpf()."';
                        ";

            if($funcionario->getSenha() != ''){
                $query = "  UPDATE funcionario 
                            SET nome='".$funcionario->getNome()."',
                            rg='".$funcionario->getRg()."',
                            data_nascimento='".$funcionario->getDataNascimento()."',
                            telefone='".$funcionario->getTelefone()."',
                            cidade='".$funcionario->getCidade()."',
                            bairro='".$funcionario->getBairro()."',
                            rua='".$funcionario->getRua()."',
                            numero_complemento='".$funcionario->getNumeroComplemento()."',
                            cargo='".$funcionario->getCargo()."',
                            login='".$funcionario->getLogin()."',
                            senha=md5('".$funcionario->getSenha()."')
                            WHERE cpf='".$funcionario->getCpf()."';
                        ";
            }
            
            mysqli_query(
                connection::getConnection(), 
                $query
            );
        }


        /**
         * Atualiza emprestimo no banco de dados
         * @param clienteAlugaLivro $aluguel
         * 
         * @return null
         */
        public function updateStatusEmprestimo($aluguel){
            $query = "UPDATE cliente_aluga_livro SET status='ENTREGUE', data_devolucao='".$aluguel->getDataDevolucao()."' WHERE id=".$aluguel->getId()."";
            
            mysqli_query(
                connection::getConnection(), 
                $query
            );
            
            //PEGA O ALUGUEL COM TODOS OS DADOS
            $aluguelCompleto = $this->getClienteAlugaLivro(
                $aluguel->getId()
            );
            
            //REPOR O LIVRO NO STOCK
            $this->updateQuantidadeEmprestimo(
                $aluguelCompleto->getLivroAluguel()->getCodigo(),
                1
            );
        }
        
        /**
         * Atualiza o stock do Livro no banco de dados
         * @param int $codigo_livro
         * @param int $quantidade
         * 
         * @return null
         */
        public function updateQuantidadeEmprestimo($codigo_livro, $quantidade){
            $query = "  UPDATE livro
                        SET quantidade=quantidade + $quantidade
                        WHERE codigo_livro=$codigo_livro;";

            mysqli_query(
                connection::getConnection(), 
                $query
            );
        }

        /**
         * Apaga o Cliente do banco de dados
         * @param string $cpf
         * 
         * @return null
         */
        public function deleteCliente($cpf){
            $query = "delete from cliente where cpf='$cpf';";

            mysqli_query(
                connection::getConnection(), 
                $query
            );
        }
        
        /**
         * Apaga o Livro do banco de dados
         * @param string $codigo
         * 
         * @return null
         */
        public function deleteLivro($codigo){
            $query = "delete from livro where codigo_livro=$codigo;";
            
            mysqli_query(
                connection::getConnection(), 
                $query
            );
        }

        /**
         * Apaga o Emprestimo do banco de dados
         * @param string $id
         * 
         * @return null
         */
        public function deleteEmprestimo($id){
            $query = "delete from cliente_aluga_livro where id=$id;";

            mysqli_query(
                connection::getConnection(), 
                $query
            );
        }

        /**
         * Apaga o Funcionario do banco de dados
         * @param string $cpf
         * 
         * @return null
         */
        public function deleteFuncionario($cpf){
            $query = "delete from funcionario where cpf='$cpf';";
            
            mysqli_query(
                connection::getConnection(), 
                $query
            );
        }

        /**
         * Valida se os $login e $senha tem correspondência no banco de dados
         * @param string $login
         * @param string $senha
         * 
         * @return funcionario|boolean
         */
        public function validarLogin($login, $senha){
            $query = "select * from funcionario where login='$login' and senha='$senha'";
            
            $funcionario = mysqli_query(
                connection::getConnection(), 
                $query
            );
            
            while ($dados_funcionario = mysqli_fetch_assoc($funcionario)) {
                return new funcionario(
                    $dados_funcionario['cpf'],
                    $dados_funcionario['nome'],
                    $dados_funcionario['rg'],
                    $dados_funcionario['data_nascimento'],
                    $dados_funcionario['telefone'],
                    $dados_funcionario['cidade'],
                    $dados_funcionario['bairro'],
                    $dados_funcionario['rua'],
                    $dados_funcionario['numero_complemento'],
                    $dados_funcionario['cargo'],
                    $dados_funcionario['login'],
                    $dados_funcionario['senha']
                );
            }

            return false;
        }   
        
    }
?>