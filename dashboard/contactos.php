<?php require_once "parte_superior.php"?>
<style type="text/css">
    .phocontent {
        background: gray;
        height: 14em;
        padding-top: 3em;
    }
    .contact-contain {
        width: 33%;
        margin: 0 1%;
        background: white;
        border-radius: 9px;
    }
    .cont-info {
        width: 80%;
        border: 1px solid gainsboro;
        margin: -1em 10%;
        background: white;
        text-align: center;
        padding: 10px;
        margin-top: -2.5em;
    }
    .colinf8 {
        margin-top: 2em;
    }
    .disdjio33h-9 {
        width: 9em;
        height: 9em;
        margin: 0 auto;
    }
    .bar8 {
        margin-left: 35%;
        display: ruby-text;
        width: 65%;
    }
    .bar8 form.mt-4 {
        display: -webkit-inline-box;
    }
    .bar8 button {
        margin: 0 8px;
    }
</style>
<div class="tpp9s">
    <div class="title"><h1>Contacto</h1></div>
    <div class="bar8">
        <a href="crearContacto.php" class="btn btn-primary" style="width: 13em;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5"/>
            </svg> Agregar Contacto</a>
            <form action="buscarContacto.php" method="POST" class="mt-4">
                <input type="text" name="search" id="search" placeholder="Buscar" class="form-control">
                <button class="btn btn-primary fkss" type="submit">Buscar</button>
            </form>
    </div>
</div>
<?php

// Check if the session variable is set
if (isset($_SESSION["s_usuario"])) {
    $user = $_SESSION["s_usuario"];
} else {
    echo "User not logged in";
    exit(); // Stop execution if not logged in
}

// Create database connection
$conn = new mysqli("localhost", "root", "", "progresardatos");

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get the user's name from the database
$sql = "SELECT nombres FROM usuarios WHERE usuario = '$user' ";
$resultado = $conn->query($sql);

// Fetch user name from database and display it
if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $usuario = $row['nombres'];
    }
} else {
    echo "User not found in the database.";
    exit(); // Stop execution if user is not found
}

// Query to get the contacts associated with the user
$sql = "SELECT * FROM contactos WHERE asesor = '$usuario' ";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    while ($row2 = $resultado->fetch_assoc()) {
        $id1= $row2['id']; 
?>
<div class="contact-contain">
    <div class="phocontent">
        <?php 
        $id = $row2['id'];

        // Query to get the contacts associated with the user
$sql = "SELECT * FROM clientes WHERE asesor = '$usuario' ";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    while ($row3 = $resultado->fetch_assoc()) {
        $id1 = $row3['id']; 
}
}

        // Query to fetch image content associated with the client
        $query = "SELECT contenido, tipo FROM imagenes_clientes WHERE id_cliente = '$id'";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        // Get the result from the prepared statement
        $result = $stmt->get_result();
        
        // Fetch image data
        $imageData = $result->fetch_assoc();

        // Check if image data is available
        if ($imageData) {
            // Encode image content into base64 format
            $imageContent = base64_encode($imageData['contenido']);
            $imageType = $imageData['tipo'];
        } else {
            // If no image is found, set to default values
            $imageContent = null;
            $imageType = null;
        }
        ?>

        <p style="text-align:center;"><a href="javascript:;" class="group relative" @click="toggle()">
            <span>
                <?php if ($imageContent): ?>
                    <img class="disdjio33" 
                         src="data:<?php echo $imageType; ?>;base64,<?php echo $imageContent; ?>" alt="image">
                <?php else: ?>
                    <img class="disdjio33h-9" 
                         src="img/user.png" alt="default image">
                <?php endif; ?>
            </span>
        </a></p>
    </div>
    <div class="cont-info">
        <h2><?php echo $row2['nombre'] ?></h2>
        <p><?php echo $row2['ocupacion'] ?></p>
    </div>
    <div class="colinf8">
        <p>Correo: <strong><?php echo $row2['email'] ?></strong></p>
        <p>Telefono: <strong><?php echo $row2['phone'] ?></strong></p>
        <p>Direccion: <strong><?php echo $row2['address'] ?></strong></p>
        <form method="POST">
            <input type="hidden" name="id1" value="<?php echo $row2['id']; ?>">
            <button type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
  <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
</svg></button>
        </form>
    </div>
</div>
<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['id1'])){
        $id1 = $_POST['id1'];
            // Reopen the connection for data insertion
    $conexion = new mysqli("localhost", "root", "", "progresardatos");

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    // SQL insert statement
    echo $sql2 = "DELETE FROM contactos WHERE id = '$id1'";

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
    }
} else {
    echo "No contacts found.";
}
?>

<?php require_once "parte_inferior.php" ?>
