
<?php
    /**
     * Entidade Connextion - 
     * Retorna uma conexão com o MySql
     * 
     * @copyright 2021, Igor Santos, Gabriel Vasconcelos, Rafaella Weiss, Everton Lima
     */
    class connection{
        /**
         * Retorna a conexão com o Mysql
         * @return mysqli|null
         */
        public static function getConnection(){
            return mysqli_connect("127.0.0.1", "root", "", "database");
        }
    }
?>