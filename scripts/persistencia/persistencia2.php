<?php
    require_once("../scripts/modelo/cliente.php");
    require_once("../scripts/modelo/livro.php");
    require_once("../scripts/modelo/funcionario.php");
    require_once("../scripts/modelo/clienteAlugaLivro.php");
    
    //require_once("../modelo/cliente.php");
    //require_once("../modelo/livro.php");
    //require_once("../modelo/clienteAlugaLivro.php");
    
    require_once("connection.php");
    
    class persistencia{
        
        public static $instance;
        
        public static function getInstance(){
            if(empty(self::$instance)){
                return self::$instance = new persistencia();
            }
            
            return self::$instance;
        }
        
        public function cadastrarCliente($cliente){
            $query = "INSERT INTO cliente 
            VALUES ('".$cliente->getCpf()."', '".$cliente->getNome()."', '".$cliente->getRg()."', '".$cliente->getDataNascimento()."', '".$cliente->getTelefone()."', '".$cliente->getCidade()."', '".$cliente->getBairro()."', '".$cliente->getRua()."', '".$cliente->getNumeroComplemento()."');";

            mysqli_query(
                connection::getConnection(), 
                $query
            );
        }

        public function cadastrarLivro($livro){
            $query = "INSERT INTO livro 
            VALUES ('".$livro->getCodigo()."', '".$livro->getNome()."', '".$livro->getEstante()."', '".$livro->getPrateleira()."', ".$livro->getQuantidade().", ".$livro->getAno().", '".$livro->getAutor()."', '".$livro->getEditora()."', '".$livro->getGenero()."');";
            
            mysqli_query(
                connection::getConnection(), 
                $query
            );
        }

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
        
        public function cadastrarFuncionario($funcionario){
            $query = "INSERT INTO funcionario 
            VALUES ('".$funcionario->getCpf()."', '".$funcionario->getNome()."', '".$funcionario->getRg()."', '".$funcionario->getDataNascimento()."', '".$funcionario->getTelefone()."', '".$funcionario->getCidade()."', '".$funcionario->getBairro()."', '".$funcionario->getRua()."', '".$funcionario->getNumeroComplemento()."', '".$funcionario->getCargo()."', '".$funcionario->getLogin()."', '".$funcionario->getSenha()."');";
            
            mysqli_query(
                connection::getConnection(), 
                $query
            );
        }

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

        public function getQuantidadeClientes()
        {
            $query = "select count(*) as quant from cliente";

            $quant_clientes = mysqli_query(
                connection::getConnection(), 
                $query
            );
            
            while ($quantidade = mysqli_fetch_assoc($quant_clientes)) {
                //RETORNA QUANTIDADE DE CLIENTES CADASTRADOS
                return $quantidade['quant'];
            }
        }

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

        public function dependenciaLivro($codigo){
            $query = "  SELECT count(*) as quant_pendencias FROM cliente_aluga_livro
                        WHERE status='PENDENTE' AND codigo_livro=$codigo;";

            $quant = mysqli_query(
                connection::getConnection(), 
                $query
            );

            while ($q = mysqli_fetch_assoc($quant)) {
                //RETORNA TODOS OS CLIENTES
                if ($q['quant_pendencias'] > 0)
                    return true;
                
                return false;
            }
        }
        
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
        
        public function existCliente($cpf){
            if($this->getCliente($cpf) == null){
                return false;
            }
            
            return true;
        }

        public function existLivro($codigo_livro){
            if($this->getLivro($codigo_livro) == null){
                return false;
            }
            
            return true;
        }

        public function existEmprestimo($idAluguel){
            $instanceAluguel = $this->getClienteAlugaLivro($idAluguel);

            if($instanceAluguel != null){
                if($instanceAluguel->getStatus() == 'PENDENTE')
                    return true;
            }
            
            return false;
        }

        public function existFuncionario($cpf){
            if($this->getFuncionario($cpf) == null){
                return false;
            }
            
            return true;
        }

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
        
        public function updateQuantidadeEmprestimo($codigo_livro, $quantidade){
            $query = "  UPDATE livro
                        SET quantidade=quantidade + $quantidade
                        WHERE codigo_livro=$codigo_livro;";

            mysqli_query(
                connection::getConnection(), 
                $query
            );
        }

        public function deleteCliente($cpf){
            $query = "delete from cliente where cpf='$cpf';";

            mysqli_query(
                connection::getConnection(), 
                $query
            );
        }
        
        public function deleteLivro($codigo){
            $query = "delete from livro where codigo_livro=$codigo;";
            
            mysqli_query(
                connection::getConnection(), 
                $query
            );
        }

        public function deleteEmprestimo($id){
            $query = "delete from cliente_aluga_livro where id=$id;";

            mysqli_query(
                connection::getConnection(), 
                $query
            );
        }

        public function deleteFuncionario($cpf){
            $query = "delete from funcionario where cpf='$cpf';";
            
            mysqli_query(
                connection::getConnection(), 
                $query
            );
        }

        public function validarLogin($login, $senha){
            $query = "select * from funcionario where login='$login' and senha = '$senha'";

            $funcionario = mysqli_query(
                connection::getConnection(), 
                $query
            );

            while ($dados_funcionario = mysqli_fetch_assoc($funcionario)) {
                //RETORNA UMA INSTANCIA DE FUNCIONARIO CASO TENHA LOGIN E SENHA CORRESPONDENTES
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