<?php
require_once "parte_superior.php";
// Start the session to access session variables
// Start the session only if it hasn't been started yet
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Database connection details
$servername = "localhost";
$username = "root";  // Change if necessary
$password = "";  // Change if necessary
$dbname = "progresardatos";  // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the session is started and user is logged in
if (isset($_SESSION["s_usuario"])) {
    $user = $_SESSION["s_usuario"];  // Get the logged-in username
} else {
    die("User not logged in.");
}

// Fetch the user's id_asesor based on the session's username
$consulta = "SELECT * FROM usuarios WHERE usuario = '$user'";
$result = $conn->query($consulta);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id_asesor = $row["id"];
    }
} else {
    die("User not found.");
}

// Add a new note
if (isset($_POST['agregar'])) {
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];

    // Insert the new note into the database
    $sql = "INSERT INTO notas (id_asesor, titulo, contenido) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $id_asesor, $titulo, $contenido);

    // Insert a notification about the new note
    $consulta2 = "INSERT INTO notificaciones (id_asesor, title, notification) VALUES (?, ?, ?)";
    $stmt2 = $conn->prepare($consulta2);
    $titulo_notif = "Nuevo Nota";
    $mensaje_notif = "Se ha agregado nueva nota";
    $stmt2->bind_param("iss", $id_asesor, $titulo_notif, $mensaje_notif);

    // Execute both queries
    if ($stmt->execute() && $stmt2->execute()) {
        echo "<script type='text/javascript'>
                window.location.href = 'notas.php';
              </script>";
    } else {
        echo "Error adding note: " . $stmt->error;
    }

    $stmt->close();
    $stmt2->close();
}

// Delete a note
if (isset($_GET['borrar'])) {
    $id = $_GET['borrar'];

    // Delete the note from the database
    $sql = "DELETE FROM notas WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    // Insert a notification for deleting the note
    $consulta2 = "INSERT INTO notificaciones (id_asesor, title, notification) VALUES (?, ?, ?)";
    $stmt2 = $conn->prepare($consulta2);
    $titulo_notif = "Nota borrada";
    $mensaje_notif = "Se ha borrado una nota";
    $stmt2->bind_param("iss", $id_asesor, $titulo_notif, $mensaje_notif);

    if ($stmt->execute() && $stmt2->execute()) {
        echo "<script type='text/javascript'>
                window.location.href = 'notas.php';
              </script>";
    } else {
        echo "Error deleting note: " . $stmt->error;
    }

    $stmt->close();
    $stmt2->close();
}

// Fetch all notes for the current user
$sql = "SELECT * FROM notas WHERE id_asesor = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_asesor);
$stmt->execute();
$result = $stmt->get_result();

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

<!-- Main content starts -->
<div class="botocof">
    <div class="cont3">
        <div class="form-note">
            <!-- Form to add a new note -->
            <h2>Agregar Nueva Nota</h2>
            <form method="POST">
                <input class="form-control" type="text" name="titulo" placeholder="Título" required><br>
                <input type="hidden" name="id_asesor" value="<?php echo $id_asesor; ?>">
                <textarea class="form-control" name="contenido" placeholder="Contenido" required></textarea><br>
                <button class="btn btn-primary" type="submit" name="agregar">Agregar Nota</button>
            </form>
        </div>

        <!-- Display all saved notes -->
        <div class="notes-content">
            <h2>Notas Guardadas</h2>
            <div>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="nota">
                        <div class="nota-titulo"><?php echo $row['titulo']; ?></div>
                        <p><?php echo $row['contenido']; ?></p>
                        <a href="?borrar=<?php echo $row['id']; ?>">Eliminar</a>

                        <!-- Form to edit a note -->
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
    </div>

    <!-- View a specific note -->
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
// View a specific note
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
