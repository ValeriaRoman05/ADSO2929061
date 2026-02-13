<?php 
class Model extends Database {
    protected $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function listPokemons() {
        $stmt = $this->db->prepare("SELECT * FROM pokemons");
        $stmt->execute(); // ← FALTABA ESTO
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}