<!--INICIO del cont principal-->
<?php require_once "parte_superior.php"?>

<!--INICIO del cont principal-->
    <?php 
        // Conexión a la base de datos
        $conexion = new mysqli("localhost", "root", "", "progresardatos");

        // Comprobar si la conexión fue exitosa
        if ($conexion->connect_error) {
            die("Conexión fallida: " . $conexion->connect_error);
        }

        $user = $_SESSION["s_usuario"];

        // Obtener el nombre del usuario desde la base de datos
        $sql = "SELECT nombres FROM usuarios WHERE usuario = '$user' ";
        $resultado = $conexion->query($sql);

        if ($resultado->num_rows > 0) {
            while($row = $resultado->fetch_assoc()) {
                $usuario = $row['nombres'];
            }
        }

        

        $conexion->close();
    ?>

<br><h1 style="text-align: center;">Listado de clientes</h1><br>
<br><a style="width:15em;margin: 0 auto;" href="registrar_ahorro.php" class="btn btn-primary">Registrar ahorro</a><br>
<table class="table" style="width:80%;margin:0 auto;">
  <thead>
    <tr>
      <th scope="col">Cliente</th>
      <th scope="col">Asesor</th>
      <th scope="col">Cantidad S/</th>
      <th scope="col">Total S/</th> 
      <th scope="col">&nbsp;</th>
    </tr>
  </thead>
  <tbody>
    <?php
    // Conexión a la base de datos
        $conexion = new mysqli("localhost", "root", "", "progresardatos");

        // Comprobar si la conexión fue exitosa
        if ($conexion->connect_error) {
            die("Conexión fallida: " . $conexion->connect_error);
        }

        $user = $_SESSION["s_usuario"]; 
    // Consulta SQL para obtener los clientes asignados al asesor
        $sql = "SELECT * FROM ahorro WHERE asesor = '$usuario' ";
        $resultado = $conexion->query($sql);

        // Verifica si la consulta ha devuelto resultados
        if ($resultado->num_rows > 0) {
            while($fila = $resultado->fetch_assoc()) {     
    ?>
    <tr>
      <th scope="row"><?php echo $fila['cliente'] ?></th>
      <td><?php echo $fila['asesor']; ?></</td>
      <td><?php echo $fila['cantidad']; ?></</td>
      <td><?php echo $fila['total']; ?></</td>
      <td>
        <form method="POST" action="couta_ahorro.php">
            <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
            <button class="btn btn-primary" type="submit">Ver pagos</button>
        </form>
      </td>
    </tr>
    <?php 
    }   
            
        } else {
        ?>
        <style>
            table{
                display: none !important;
            }
        </style>
        <p style="text-align:center;">No hay registros</p>
        <?php 
        }
    ?>
  </tbody>
</table>

<!--FIN del cont principal-->
<?php require_once "parte_inferior.php"?>
