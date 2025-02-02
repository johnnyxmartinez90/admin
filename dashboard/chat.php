<?php require_once "parte_superior.php"?>

<style type="text/css">
    img.mx-auto.h-20.w-20.rounded-full.object-cover.md\:h-32.md\:w-32 {
        width: 3em;
        height: 3em;
        border-radius: 50%;
    }
    .content-prof {
    display: flex;
    flex-direction: column; /* Esto organiza los elementos en una columna */
    align-items: center; /* Centra los elementos horizontalmente */
    justify-content: center; /* Centra los elementos verticalmente */
    height: 100vh; /* Esto asegura que el contenido ocupe toda la altura de la pantalla */
}
img.mx-auto {
    margin-bottom: 10px; /* Agrega un pequeño espacio entre la imagen y el nombre */
}
.disld {
    background: white;
    width: 50%;
    padding: 20px 0;
    border-radius: 8px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin: 10px;

}

</style>
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

// Verificar si la variable de sesión 's_usuario' está definida
if (isset($_SESSION["s_usuario"])) {
    // Obtener el nombre de usuario desde la sesión
    $user = $_SESSION["s_usuario"];

    // Obtener el ID del usuario desde la base de datos
    $sql = "SELECT id, nombres FROM usuarios WHERE usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Verificar si el usuario fue encontrado
    if ($resultado->num_rows > 0) {
        // Recuperar los datos del usuario
        while($row = $resultado->fetch_assoc()) {
            // Mostrar el nombre del usuario
            ?>
            <div class='content-prof' style="text-align: center;">              
                <div class="disld">
                    <h1><?php echo $row['nombres']; ?></h1>
                    <?php 
                        // Obtener otros usuarios, excluyendo al actual
                        $sql2 = "SELECT id, nombres FROM usuarios WHERE usuario <> ?";
                        $stmt2 = $conn->prepare($sql2);
                        $stmt2->bind_param("s", $user);
                        $stmt2->execute();
                        $resultado2 = $stmt2->get_result();

                        // Verificar si hay otros usuarios
                        if ($resultado2->num_rows > 0) {
                            // Mostrar los nombres de los demás usuarios
                            while($row2 = $resultado2->fetch_assoc()) {
                                $id = $row2['id']; // Use the correct id from row2
                                ?>
                                <div class="dsd988">
                                <?php
                                // Query to get the image for the user
                                $query = "SELECT contenido, tipo FROM imagenes_asesores WHERE id_asesor = ?";
                                $stmt_img = $conn->prepare($query);
                                $stmt_img->bind_param("i", $id); // Using integer binding for id_asesor
                                $stmt_img->execute();
                                $result_img = $stmt_img->get_result();

                                // Fetch image data
                                $imageData = $result_img->fetch_assoc();

                                // Debugging: check the image data and MIME type
                                if ($imageData) {
                                    
                                    // Check MIME type and render the image accordingly
                                    $imageType = $imageData['tipo']; // Get MIME type from database
                                    if ($imageType == 'image/jpeg' || $imageType == 'image/png') {
                                        // Show the image
                                        echo "<form action = 'chat-show.php' method = 'POST' class = 'fis'>";
                                        echo "<p>";
                                        echo '<img src="data:' . $imageType . ';base64,' . base64_encode($imageData['contenido']) . '" alt="image" class="mx-auto h-20 w-20 rounded-full object-cover md:h-32 md:w-32">';
                                    } else {
                                        echo '<div>Unsupported image type.</div>';
                                    }
                                } else {
                                    echo '<div>No image found for this user.</div>';
                                }

                                // Display the user name
                                echo "<input type='hidden' value='" . $row2['id'] . "' name='id_rec'>";

                                echo "<button type='submit'>" . $row2['nombres'] . "</button>";
                                echo "</p>";
                                echo "</form>";
                            }
                            ?>
                            </div>
                            <?php
                        } else {
                            echo "<p>No hay otros usuarios disponibles.</p>";
                        }
                    ?> 
                </div>
            </div>
            <?php
        }
    } else {
        echo "Usuario no encontrado.";
    }

} else {
    echo "No hay sesión activa.";
}

// Cerrar la conexión
$conn->close();
?>

<?php require_once "parte_inferior.php"?>