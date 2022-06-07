<?php

    include_once '../global.php';
    include_once 'BD.php';

    class Pessoa extends BD {

        public static $tabela = 'tb_pessoas';

        public static function all($orderby="") {
            return parent::select(self::$tabela, $orderby);
        }

        public static function find($cpf) {
            return parent::selectFind(self::$tabela, "cpf = '$cpf'");
        }

        public static function create($dados) {
            return parent::insert(self::$tabela, $dados);
        }

        public static function update($cpf, $dados) {
            return parent::edit(self::$tabela, $dados, "cpf = '$cpf'");
        }

        public static function destroy($cpf) {
            return parent::delete(self::$tabela, "cpf = '$cpf'");
        }
    }
