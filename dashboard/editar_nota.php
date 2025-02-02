<?php require_once "parte_superior.php" ?>

<?php 
    $id = $_POST['id']; // Usar asesor_n de $_POST
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];
?>

<form method="POST" style="width:80%;margin:0 auto;">
    <!-- Campo oculto para el ID -->
    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" required >

    <!-- Campo de Título -->
    <div class="mb-3">
        <label for="titulo" class="form-label">Título</label>
        <input class="form-control" type="text" name="titulo" id="titulo" value="<?php echo $titulo; ?>" required>
    </div>

    <!-- Campo de Contenido -->
    <div class="mb-3">
        <label for="contenido" class="form-label">Contenido</label>
        <!-- Aquí es donde se debe colocar el contenido dentro de las etiquetas <textarea> -->
        <textarea class="form-control" name="contenido" id="contenido" required><?php echo $contenido; ?></textarea>
    </div>

    <!-- Botón para enviar el formulario -->
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>
<?php 
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $id = $_POST['id']; // Usar asesor_n de $_POST
        $titulo = $_POST['titulo'];
        $contenido = $_POST['contenido'];

        // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "progresardatos");

    // Comprobar si la conexión fue exitosa
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

        $sql = "UPDATE notas SET titulo = '$titulo', contenido = '$contenido' WHERE id = '$id' ";


        if ($conexion->query($sql)) {
                    ?>
            <a class="btn btn-primary" href="notas.php" style="width:8em;margin: 0 auto;">Salir</a>
            <?php
                } else {
                    //echo "Error al registrar el pago: " . $conexion->error;
                }

            } else {
                // Si no se encontró el registro de ahorro para ese asesor
    }
?>
<?php require_once "parte_inferior.php" ?>
