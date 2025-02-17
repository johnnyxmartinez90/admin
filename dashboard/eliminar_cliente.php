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

$id = $_GET['id'];

?>
<style type="text/css">
    .form-eli {
        text-align: center;
        margin: 7px auto;
        width: 17.5%;
        display: -webkit-box;
    }
    .form-eli .btn.btn-primary {
        width: 6em !important;
        margin: 0 5px;
    }
</style>
<br>
<h1 style="text-align:center;font-size: 1.5em;">¿Estas seguro de eliminar?</h1>
<div class="form-eli">
    <a class="btn btn-primary" href="lista_clientes.php">No</a>
    <form action="cliente_eliminado.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <button type="submit" class="btn btn-primary">Si</button>
    </form>
</div>
<!--FIN del cont principal-->
<?php require_once "parte_inferior.php"; ?>