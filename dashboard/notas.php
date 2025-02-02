<?php require_once "parte_superior.php" ?>

<?php
$servername = "localhost";
$username = "root";  // Cambia si es necesario
$password = "";  // Cambia si es necesario
$dbname = "progresardatos";  // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el id_asesor del usuario logueado
$user = 'usuario_logueado';  // Asegúrate de obtener el nombre de usuario actual
$consulta = "SELECT * FROM usuarios WHERE usuario = '$user' ";
$result = $conn->query($consulta);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id_asesor = $row["id"];
    }
}

// Agregar una nueva nota (uso de prepared statement)
if (isset($_POST['agregar'])) {
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];

    $sql = "INSERT INTO notas (id_asesor, titulo, contenido) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $id_asesor, $titulo, $contenido);

    if ($stmt->execute()) {
        echo "<script type='text/javascript'>
                    window.location.href = 'index.php';
                  </script>";
    } else {
        echo "Error al agregar la nota: " . $stmt->error;
    }

    $stmt->close();
}

// Borrar una nota
if (isset($_GET['borrar'])) {
    $id = $_GET['borrar'];

    $sql = "DELETE FROM notas WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Nota eliminada exitosamente.";
    } else {
        echo "Error al eliminar la nota: " . $stmt->error;
    }

    $stmt->close();
}

// Obtener todas las notas
$sql = "SELECT * FROM notas WHERE id_asesor = '$id_asesor'";
$result = $conn->query($sql);
?>

<style>
    .nota {
        border: 1px solid #ccc;
        padding: 10px;
        margin: 5px;
        cursor: pointer;
    }
    .nota:hover {
        background-color: #f1f1f1;
    }
    .nota-titulo {
        font-weight: bold;
    }
    .form-note {
        margin: 2% 2%;
        width: 35%;
        background: white;
        padding: 20px;
        border-radius: 8px;
    }
    .notes-content {
        width: 57%;
        margin: 2%;
        background: white;
        padding: 20px;
        border-radius: 8px;
    }
    .cont3 {
        display: flex;
    }
</style>

<!-- INICIO del cont principal -->
<div class="botocof">
<div class="cont3">
    <div class="form-note">
        <!-- Formulario para agregar una nueva nota -->
        <h2>Agregar Nueva Nota</h2>
        <form method="POST">
            <input class="form-control" type="text" name="titulo" placeholder="Título" required><br>
            <input type="hidden" name="id_asesor" value="<?php echo $id_asesor; ?>">
            <textarea class="form-control" name="contenido" placeholder="Contenido" required></textarea><br>
            <button class="btn btn-primary" type="submit" name="agregar">Agregar Nota</button>
        </form>
    </div>

    <!-- Mostrar todas las notas -->
   <div class="notes-content">
     <h2>Notas Guardadas</h2>
     <div>
         <?php while ($row = $result->fetch_assoc()): ?>
             <div class="nota">
                 <div class="nota-titulo"><?php echo $row['titulo']; ?></div>
                 <p><?php echo $row['contenido']; ?></p>
                 <a href="?borrar=<?php echo $row['id']; ?>">Eliminar</a>

                 <!-- Formulario para editar una nota -->
                 <form method="POST" action="editar_nota.php" style="display: inline;">
                     <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                     <input type="hidden" name="titulo" value="<?php echo $row['titulo']; ?>" required>
                     <input type="hidden" name="contenido" value="<?php echo $row['contenido']; ?>" required>
                     <button type="submit" name="editar">Editar</button>
                 </form>
             </div>
         <?php endwhile; ?>
     </div>
 </div>


<!-- Ver una nota -->
<div id="notaDetalle" style="display:none;">
    <h2>Detalle de la Nota</h2>
    <div id="detalleContenido"></div>
    <button onclick="cerrarDetalle()">Cerrar</button>
</div>
</div>
<script>
    function mostrarNota(id) {
        fetch('?ver=' + id)
            .then(response => response.json())
            .then(data => {
                document.getElementById('detalleContenido').innerHTML = `<h3>${data.titulo}</h3><p>${data.contenido}</p>`;
                document.getElementById('notaDetalle').style.display = 'block';
            });
    }

    function cerrarDetalle() {
        document.getElementById('notaDetalle').style.display = 'none';
    }
</script>

<?php
// Ver una nota específica
if (isset($_GET['ver'])) {
    $id = $_GET['ver'];
    $sql = "SELECT * FROM notas WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    }

    $stmt->close();
}

$conn->close();
?>


<?php require_once "parte_inferior.php" ?>