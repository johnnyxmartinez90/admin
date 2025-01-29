<?php require_once "parte_superior.php"?>
<?php 
    // Verifica si se ha enviado 'asesor_n' por POST
    if (isset($_POST['asesor_n'])) {
        $asesor_n = $_POST['asesor_n'];
    } else {
        echo "No se ha definido el asesor.";
        exit; // Salir si el valor no está disponible
    }
?>

<!--INICIO del cont principal-->
<form method="POST" style="width: 85%; margin: auto;">
    <input type="hidden" name="asesor_n" id="asesor_n" value="<?php echo $asesor_n; ?>">
    
    <div class="mb-3">
        <label for="date" class="form-label">Fecha</label>
        <input class="form-control" type="date" name="date" id="date" required> 
    </div>
    <div class="mb-3">
        <label for="abono" class="form-label">Abono</label>
        <input class="form-control" type="text" name="abono" id="abono" required> 
    </div>
    <div class="mb-3">
        <!-- Botón de tipo submit -->
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>

<?php
    // Verifica si el formulario ha sido enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Verifica si 'date' y 'abono' están definidos en $_POST
        if (isset($_POST['date'], $_POST['abono'])) {
            $asesor_n = $_POST['asesor_n']; // Usar asesor_n de $_POST
            $date = $_POST['date'];
            $abono = $_POST['abono'];

            // Comprobar si 'abono' y 'date' no están vacíos
            if (empty($abono) || empty($date)) {
                echo "Por favor, complete todos los campos.";
                exit; // Detener la ejecución si faltan campos
            }

            // Conexión a la base de datos
            $conexion = new mysqli("localhost", "root", "", "progresardatos");

            // Comprobar si la conexión fue exitosa
            if ($conexion->connect_error) {
                die("Conexión fallida: " . $conexion->connect_error);
            }

            // Verificar si existe un valor en la columna 'total' de la tabla 'ahorro' para ese ID
            $sql = "SELECT total FROM ahorro WHERE asesor = '$asesor_n' LIMIT 1";  // Asumí que el campo 'asesor' puede ser utilizado
            $resultado = $conexion->query($sql);

            // Si la consulta devuelve un resultado
            if ($resultado->num_rows > 0) {
                // Si existe un registro, obtener el total
                while($fila = $resultado->fetch_assoc()) { 
                    $total = $fila['total']; // Almacena el total de la fila
                }

                // Calcular el restante después del abono
                $restante = $total - $abono;

                // Consulta para insertar el pago en la tabla 'couta_ahorro'
                echo$sql2 = "INSERT INTO couta_inversion (asesor, fecha, abono) 
                         VALUES ('$asesor_n', '$date', '$abono')";

                // Ejecutar la inserción
                if ($conexion->query($sql2) === TRUE) {
                    ?>
            <script type="text/javascript">
                window.location.href = "index.php";
            </script>
            <?php
                } else {
                    echo "Error al registrar el pago: " . $conexion->error;
                }

            } else {
                // Si no se encontró el registro de ahorro para ese asesor
                echo "No se encontró el registro de ahorro con ese asesor.";
            }

            // Cerrar la conexión
            $conexion->close();

        } else {
        }
    }
?>
<!--FIN del cont principal-->
<?php require_once "parte_inferior.php"?>