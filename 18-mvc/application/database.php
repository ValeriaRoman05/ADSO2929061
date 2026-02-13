<?php
    abstract class Database {
        protected static $conn = null;

        public static function connect() {
            if (self::$conn === null) {
            try {
                $host = 'localhost';
                $dbnn = 'pokeadso';
                $user = 'root';
                $pass = '';

                self::$conn = new PDO("mysql:host=$host;dbname=$dbnn", $user, $pass);
                
            } catch (PDOException $e) {
                die('connection Error: ' . $e->getMessage());
            }
            return self::$conn;
        }
    }
}