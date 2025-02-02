<?php require_once "parte_superior.php"?>
<style type="text/css">
    form{
        width: 80%;
        margin: 0 auto;
    }
</style>
<?php 
// Check if session is already started before calling session_start()
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the session variable is set
if (!isset($_SESSION["s_usuario"])) {
    echo "No user is logged in.";
    exit(); // Stop execution if the session variable is not set
}

// Create database connection
$conn = new mysqli("localhost", "root", "", "progresardatos");

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the username from session
$user = $_SESSION["s_usuario"];

// Query to get the user's name from the database
$sql = "SELECT nombres FROM usuarios WHERE usuario = '$user' ";
$resultado = $conn->query($sql);

// Fetch user name from database and display it
if ($resultado->num_rows > 0) {
    while($row = $resultado->fetch_assoc()) {
        $usuario = $row['nombres'];
    }
}

// Query to get clients associated with the user
$sql = "SELECT * FROM clientes WHERE asesor = '$user' ";
$resultado = $conn->query($sql);

// Start the form HTML
?>
<div>
    <form method="POST">
        <label for="nombre" class="form-label">Nombres</label><br>
        <select name="nombre" class="form-control">
            <?php 
            // Populate the select dropdown with client names
            if ($resultado->num_rows > 0) {
                while($row = $resultado->fetch_assoc()) {
                    echo '<option value="' . $row['nombres'] . '">' . $row['nombres'] . '</option>';
                }
            }
            ?>
        </select><br>
        <input type="hidden" name="asesor" value="<?php echo $usuario; ?>" class="form-control" readonly><br>
        <button type="submit" class="btn btn-primary">Seleccionar</button>
    </form>
</div>
<br>
<?php 
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['nombre'])) {
    // Validate the data from the form
    $asesor = isset($_POST['asesor']) ? $_POST['asesor'] : '';
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    
    // Reopen the connection for client details
    $conexion = new mysqli("localhost", "root", "", "progresardatos");

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $sql = "SELECT * FROM clientes WHERE nombres = '$nombre' ";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        while($row2 = $resultado->fetch_assoc()) {
           ?>
    <form method="POST">
        <!-- Hidden field to pass the asesor value -->
        <input value="<?php echo $asesor; ?>" type="hidden" name="asesor1">

        <label for="nombr" class="form-label">Nombre</label><br>
        <input type="text" name="nombr" value="<?php echo isset($_POST['nombr']) ? $_POST['nombr'] : $row2['nombres']; ?>" class="form-control"><br>

        <label for="email" class="form-label">Correo</label><br>
        <input type="text" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : $row2['correo']; ?>" class="form-control"><br>

        <label for="phone" class="form-label">Telefono</label><br>
        <input type="text" name="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : $row2['telefono']; ?>" class="form-control"><br>

        <label for="ocupacion" class="form-label">Ocupacion</label><br>
        <input type="text" name="ocupacion" value="<?php echo isset($_POST['ocupacion']) ? $_POST['ocupacion'] : $row2['ocupacion']; ?>" class="form-control"><br>

        <label for="address" class="form-label">Direccion</label><br>
        <input type="text" name="address" value="<?php echo isset($_POST['address']) ? $_POST['address'] : $row2['direcvivienda']; ?>" class="form-control"><br><br>

        <input type="submit" value="Guardar" class="btn btn-primary"><br>
    </form>
           <?php
        }
    }
}
    
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['asesor1'])) {
    // Retrieve and validate the POST data
    $asesor = isset($_POST['asesor1']) ? $_POST['asesor1'] : '';
    $nombr = isset($_POST['nombr']) ? $_POST['nombr'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $ocupacion = isset($_POST['ocupacion']) ? $_POST['ocupacion'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    
    // Reopen the connection for data insertion
    $conexion = new mysqli("localhost", "root", "", "progresardatos");

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    // SQL insert statement
    $sql2 = "INSERT INTO contactos (nombre, email, phone, ocupacion, address, asesor) 
             VALUES ('$nombr', '$email', '$phone', '$ocupacion', '$address', '$asesor')";

    // Execute the query
    if ($conexion->query($sql2) === TRUE) {
        // Redirect to index.php if insertion was successful
        echo "<script type='text/javascript'>
                window.location.href = 'index.php';
              </script>";
    } else {
        // If insertion fails, show an error message
        echo "Error: " . $sql2 . "<br>" . $conexion->error;
    }
}
?>

<?php 
// Close the database connection
$conn->close();
?>

<?php require_once "parte_inferior.php"?>
