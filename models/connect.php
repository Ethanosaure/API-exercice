<?php
// require('./config/config.php');


class connect {
        
        private static $bdd;

    public static function connect(){
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=api;charset=UTF8', 'root', '');
            return $bdd;

        }catch(Exception $e){
            die('Erreur: '.$e->getMessage());
        }
    }
}




?>