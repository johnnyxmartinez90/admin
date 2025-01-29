<?php require_once "parte_superior.php"?>

<!--INICIO del cont principal-->
<form method="POST" style="width: 85%; margin: auto;">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Cliente</label>
    <?php 
        // Conexión a la base de datos
        $conexion = new mysqli("localhost", "root", "", "progresardatos");

        // Comprobar si la conexión fue exitosa
        if ($conexion->connect_error) {
            die("Conexión fallida: " . $conexion->connect_error);
        }

        $user = $_SESSION["s_usuario"];

        // Obtener el nombre del usuario desde la base de datos
        $sql = "SELECT nombres FROM usuarios WHERE usuario = '$user' ";
        $resultado = $conexion->query($sql);

        if ($resultado->num_rows > 0) {
            while($row = $resultado->fetch_assoc()) {
                $usuario = $row['nombres'];
            }
        }

        // Consulta SQL para obtener los clientes asignados al asesor
        $sql = "SELECT nombres FROM clientes WHERE asesor = '$usuario' ";
        $resultado = $conexion->query($sql);

        // Verifica si la consulta ha devuelto resultados
        if ($resultado->num_rows > 0) {
            echo "<select class='form-select' name='cliente'>";
            // Genera las opciones del <select>
            while($fila = $resultado->fetch_assoc()) {
                echo "<option value='" . $fila['nombres'] . "'>" . $fila['nombres'] . "</option>";
            }   
            echo "</select>";
        } else {
            echo "No se encontraron resultados";
        }

        $conexion->close();
    ?>
  </div>
    <input class="form-control" type="hidden" name="asesor" id="asesor" value="<?php echo $usuario; ?>"> 
  <div class="mb-3">
    <label for="cantidad" class="form-label">Cantidad</label>
    <input class="form-control" type="text" name="cantidad" id="cantidad"> 
  </div>
  <div class="mb-3">
    <label for="cantidad" class="form-label">Tiempo (años)</label>
    <input class="form-control" type="text" name="tiempo" id="tiempo"> 
  </div>
  <div class="mb-3">
    <!-- Botón de tipo submit -->
    <button type="submit" class="btn btn-primary form-control">Guardar</button>
  </div>
</form>
<!-- end main content section -->

<?php 
// Verifica si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Obtener y validar los datos
    $cliente = $_POST['cliente'];
    $asesor = $_POST['asesor'];
    $cantidad = $_POST['cantidad'];
    $tiempo = $_POST['tiempo'];
        
        // Reabrir la conexión para la inserción de datos
        $conexion = new mysqli("localhost", "root", "", "progresardatos");

        if ($conexion->connect_error) {
            die("Conexión fallida: " . $conexion->connect_error);
        }
        
        $sql = "INSERT INTO inversion (cliente, asesor, cantidad,tiempo) VALUES ('$cliente', '$asesor', '$cantidad','$tiempo')";

        // Ejecutar la consulta
        if ($conexion->query($sql) === TRUE) {
            // Redirigir a index.php si la inserción fue exitosa
            echo "<script type='text/javascript'>
                    window.location.href = 'index.php';
                  </script>";
        } else {
            // Si la inserción falla, muestra un mensaje de error
            echo "Error: " . $sql . "<br>" . $conexion->error;
        }

        // Cerrar la conexión
        $conexion->close();
    } else {
    }
?>

<!--FIN del cont principal-->
<?php require_once "parte_inferior.php"?>
