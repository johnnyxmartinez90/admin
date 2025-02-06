<?php
require_once "parte_superior.php";

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

echo $id = $_GET['id'];

$sql = "DELETE FROM clientes WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script type='text/javascript'>
                    window.location.href = 'lista_clientes.php';
                  </script>";
    } else {
        echo "Error al agregar la nota: " . $stmt->error;
    }

    $stmt->close();

?>

<!--FIN del cont principal-->
<?php require_once "parte_inferior.php"; ?>