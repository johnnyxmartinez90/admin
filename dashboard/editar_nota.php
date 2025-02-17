<?php
    require_once "parte_superior.php";

    $conexion = new mysqli("localhost", "root", "", "progresardatos");

    // Check if the connection was successful
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];

    // Fetch the note data from the database
    $sql = "SELECT * FROM notas WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id); // Bind the ID to the SQL query
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Check if the note exists
    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        $titulo = $row['titulo'];
        $contenido = $row['contenido'];
    } else {
        echo "Nota no encontrada.";
        exit;
    }

?>

<!-- HTML Form to Edit the Note -->
<form method="POST" action="nota_editada.php" style="width:80%;margin:0 auto;">
    <!-- Hidden field for the note ID -->
    <input type="hidden" name="id2" id="id2" value="<?php echo $id; ?>" required>

    <!-- Title field -->
    <div class="mb-3">
        <label for="titulo" class="form-label">Título</label>
        <input class="form-control" type="text" name="titulo2" id="titulo2" value="<?php echo htmlspecialchars($titulo); ?>" required>
    </div>

    <!-- Content field -->
    <div class="mb-3">
        <label for="contenido" class="form-label">Contenido</label>
        <textarea class="form-control" name="contenido2" id="contenido2" required><?php echo htmlspecialchars($contenido); ?></textarea>
    </div>

    <!-- Submit button -->
    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>
<?php require_once "parte_inferior.php" ?>
