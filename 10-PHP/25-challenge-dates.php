<?php 
    $title = '24- Date & Time';
    $description = 'Many ways to handle dates and times.';

    include 'template/header.php';
    echo "<section>";   
?>

    <div style="padding: 20px; text-align: center;">
        <h2>Calculadora de Edad </h2>
        
        <form method="post" action="">
            <label for="fecha_nacimiento">Tu fecha de nacimiento:</label>
            <input 
                type="date" 
                id="fecha_nacimiento" 
                name="fecha_nacimiento" 
                required 
            >
            <button type="submit" style="margin-top: 15px;">
                Calcular Edad
            </button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $fechaNacimiento = $_POST["fecha_nacimiento"];
            
            if (!empty($fechaNacimiento)) {
                try {
                    $nacimiento = new DateTime($fechaNacimiento);
                    $hoy = new DateTime();
                    
                    if ($nacimiento > $hoy) {
                        echo "<p style='color: red; font-weight: bold;'>¡Error! La fecha no puede ser futura.</p>";
                    } else {
                        $edad = $hoy->diff($nacimiento)->y;
                        echo "<p style='margin-top: 20px;'>Tienes <strong>$edad años</strong>.</p>";
                    }
                } catch (Exception $e) {
                    echo "<p style='color: red; font-weight: bold;'>Error: Ingresa una fecha válida.</p>";
                }
            } else {
                echo "<p style='color: red; font-weight: bold;'>Por favor, ingresa una fecha.</p>";
            }
        }
        ?>
    </div>

<?php 
    echo "</section>"; // Cierra la sección principal
    include 'template/footer.php';
?>