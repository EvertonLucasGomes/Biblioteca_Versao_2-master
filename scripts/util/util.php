<?php
    /**
     * Entidade Util
     * 
     * @copyright 2021, Igor Santos, Gabriel Vasconcelos, Rafaella Weiss, Everton Lima
     */
    class util{
        /**
         * Retorna se existe números na string
         * @param string $string
         * 
         * @return boolean
         */
        public static function existNumero($string){
            return (filter_var($string, FILTER_SANITIZE_NUMBER_INT) === '' ? false : true);
        }

        /**
         * Retorna de o CPF informado é válido
         * @param string $cpf
         * 
         * @return boolean
         */
        public static function validaCPF($cpf) {
 
            // Extrai somente os números
            $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
             
            // Verifica se foi informado todos os digitos corretamente
            if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
                return false;
            }
        
            // Faz o calculo para validar o CPF
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf[$c] * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf[$c] != $d) {
                    return false;
                }
            }
            return true;
            
        }
        /**
         * Adiciona um evento a pilha de log do sistema
         * @param string $string
         * 
         * @return null
         */
        public static function generateLog($string){
            date_default_timezone_set('America/Sao_Paulo');

            $dataHoraAtual = date('d/m/Y à\s H:i:s');
            $usuario = $_SESSION['user'];

            $log = fopen('../scripts/log/log.txt', 'a+');
            fwrite($log, "[$dataHoraAtual] [$usuario] : $string\n");

            fclose($log);
        }

        public static function generateLogLogout($string){
            date_default_timezone_set('America/Sao_Paulo');

            $dataHoraAtual = date('d/m/Y à\s H:i:s');
            $usuario = $_SESSION['user'];

            $log = fopen('../log/log.txt', 'a+');
            fwrite($log, "[$dataHoraAtual] [$usuario] : $string\n\n");

            fclose($log);
        }
    }
?>