<?php 
    /**
     * Entidade Livro
     * 
     * @copyright 2021, Igor Santos, Gabriel Vasconcelos, Rafaella Weiss, Everton Lima
     */
    class livro{
        
        /** @var int Código do Livro*/
        private $codigo;
        
        /** @var string Nome do Livro */
        private $nome;

        /** @var string Estante que se encontra o Livro */
        private $estante;

        /** @var string Prateleira que se encontra o Livro */
        private $prateleira;

        /** @var int Quantidade disponível do Livro */
        private $quantidade;

        /** @var int Ano de Publicação do Livro */
        private $ano;

        /** @var string Autor do Livro */
        private $autor;

        /** @var string Editora que publicou do Livro */
        private $editora;

        /** @var string Gênero do Livro */
        private $genero;
        
        /**
         * Construtor da Classe Livro
         * @param int $codigo Código do Livro (Atributo Obrigatório para Instancia da Classe)
         * @param string|null $nome Nome do Livro
         * @param string|null $estante Estante do Livro
         * @param string|null $prateleira Prateleira do Livro
         * @param int|null $quantidade Quantidade disponível do Livro
         * @param int|null $ano Ano de Publicação do Livro
         * @param string|null $autor Autor do Livro
         * @param string|null $editora Editora que publicou do Livro
         * @param string|null $genero Gênero do Livro
         */
        public function __construct($codigo=null, $nome=null, $estante=null, $prateleira=null, $quantidade=null, $ano=null, $autor=null, $editora=null, $genero=null)
        {
            $this->codigo = $codigo;
            $this->nome = $nome;
            $this->estante = $estante;
            $this->prateleira = $prateleira;
            $this->quantidade = $quantidade;
            $this->ano = $ano;
            $this->autor = $autor;
            $this->editora = $editora;
            $this->genero = $genero;
        }

        public function getNome(){
            return $this->nome;
        }

        public function getCodigo(){
            return $this->codigo;
        }

        public function getEstante(){
            return $this->estante;
        }

        public function getPrateleira(){
            return $this->prateleira;
        }
        
        public function getQuantidade(){
            return $this->quantidade;
        }

        public function getAno(){
            return $this->ano;
        }

        public function getAutor(){
            return $this->autor;
        }

        public function getEditora(){
            return $this->editora;
        }

        public function getGenero(){
            return $this->genero;
        }

        public function __toString()
        {
            return $this->codigo;
        }
    }
?>