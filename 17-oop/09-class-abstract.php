<?php
$title = '09 - Class Abstract';
$description = 'A class that cannot be instantiated, only extended from.';

include_once 'template/header.php';
echo '<section>';

abstract class Pokeadso {
    
    private $DB_HOST ;
    private $DB_NAME ;
    private $DB_USER ;
    private $DB_PASS ;

    protected $conexion;

    public function __construct($DB_HOST='localhost', $DB_NAME = 'pokeadso',$DB_USER = 'root',$DB_PASS = '')
    {
        $this->DB_HOST = $DB_HOST;
        $this->DB_NAME = $DB_NAME;
        $this->DB_USER = $DB_USER;
        $this->DB_PASS = $DB_PASS;

        $this->conectar();
    }

    protected function conectar() {
        $dsn = 'mysql:host=' . $this->DB_HOST . ';dbname=' . $this->DB_NAME . ';charset=utf8mb4';
        try {
            $this->conexion = new PDO($dsn, $this->DB_USER, $this->DB_PASS);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("❌ Error de conexión: " . $e->getMessage());
        }
    }

    protected function desconectar(){
        $this->conexion = null;
    }

    public function lisar(){

    }
}

class Pokemone extends Pokeadso{

    public function listarPokemones() {
        $this->conectar();
        
        try {
            $sql = "SELECT id, name, type FROM pokemons ORDER BY id";
            $stmt = $this->conexion->query($sql);
            $pokemones = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $salida="<table>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                        </tr>";

            foreach ($pokemones as $pk){
                $salida.="<tr>
                            <td>{$pk['id']}</td>
                            <td>{$pk['name']}</td>
                            <td>{$pk['type']}</td>
                        </tr>";
            }

            $salida.='</table>';

            return $salida;
        } catch (PDOException $e) {
            return '';
        } finally {
            $this->desconectar();
        }
    }
}

$pokemones= new Pokemone();
echo $pokemones->listarPokemones();



include_once 'template/footer.php';