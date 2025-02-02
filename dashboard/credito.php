<?php
// Start the session
session_start();

// Check if the session variable is set
if (!isset($_SESSION["s_usuario"])) {
    // If the session variable is not set, handle it with an error message
    die("Sesión no iniciada o usuario no autenticado.");
}

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "progresardatos");

// Comprobar si la conexión fue exitosa
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Getting the username from the session
$user = $_SESSION["s_usuario"];

// Obtener el nombre del usuario desde la base de datos
$sql = "SELECT nombres FROM usuarios WHERE usuario = '$user'";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    $row = $resultado->fetch_assoc();
    $usuario = $row['nombres']; // Assign the username to $usuario
} else {
    // If no matching user, handle it with an error message
    die("Usuario no encontrado.");
}

// Closing the first connection
$conexion->close();
?>

<!-- INICIO del cont principal -->
<?php require_once "parte_superior.php" ?>

<br><h1 style="text-align: center;">Listado de clientes</h1><br>
<br><a style="width:15em;margin: 0 auto;" href="registrar_credito.php" class="btn btn-primary">Registrar credito</a><br>

<!-- Client table -->
<table class="table" style="width:80%;margin:0 auto;">
  <thead>
    <tr>
      <th scope="col">Cliente</th>
      <th scope="col">Asesor</th>
      <th scope="col">Cantidad S/</th>
      <th scope="col">Total ahorros S/</th>
    </tr>
  </thead>
  <tbody>
    <?php
    // Reconnect to the database to query for the clients assigned to the advisor (logged-in user)
    $conexion = new mysqli("localhost", "root", "", "progresardatos");

    // Verifica si la conexión fue exitosa
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    // Consulta SQL para obtener los clientes asignados al asesor
    $sql = "SELECT cliente, asesor, SUM(cantidad) as cantidad, SUM(total) AS total 
            FROM credito WHERE asesor = '$usuario' GROUP BY cliente, asesor";
    $resultado = $conexion->query($sql);

    // Verifica si la consulta ha devuelto resultados
    if ($resultado->num_rows > 0) {
        while($fila = $resultado->fetch_assoc()) {
    ?>
    <tr>
      <th scope="row"><?php echo $fila['cliente'] ?></th>
      <td><?php echo $fila['asesor']; ?></td>
      <td><?php echo $fila['cantidad']; ?></td>
      <td><?php echo $fila['total']; ?></td>
    </tr>
    <?php 
        }   
    } else {
        // If no results, hide the table and display a message
        ?>
        <style>
            table {
                display: none !important;
            }
        </style>
        <p style="text-align:center;">No hay registros</p>
    <?php 
    }

    // Close the second connection
    $conexion->close();
    ?>
  </tbody>
</table>

<!-- FIN del cont principal -->
<?php require_once "parte_inferior.php" ?>