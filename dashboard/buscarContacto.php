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

?>
<div class="contact-contain">
    <div class="phocontent">
        <?php 

        // Create database connection
$conn = new mysqli("localhost", "root", "", "progresardatos");

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search = $_POST['search'];

$sql = "SELECT * FROM contactos WHERE nombre LIKE '$search%' ";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    while ($row3 = $resultado->fetch_assoc()) {
        $id = $row3['id']; 

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
        <h2><?php echo $row3['nombre'] ?></h2>
        <p><?php echo $row3['ocupacion'] ?></p>
    </div>
    <div class="colinf8">
        <p>Correo: <strong><?php echo $row3['email'] ?></strong></p>
        <p>Telefono: <strong><?php echo $row3['phone'] ?></strong></p>
        <p>Direccion: <strong><?php echo $row3['address'] ?></strong></p>
    </div>
</div>
<?php 
    }
} else {
    echo "No contacts found.";
}
?>

<?php require_once "parte_inferior.php" ?>
