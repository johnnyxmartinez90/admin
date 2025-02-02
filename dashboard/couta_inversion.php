

<!--INICIO del cont principal-->
<?php require_once "parte_superior.php"?>
<style type="text/css">
    button.btn.btn-primary {
        display: inline;
    }
</style>
<!--INICIO del cont principal-->
<br>
<form method="POST" action="inversion_pagos.php">
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

        $conexion = new mysqli("localhost", "root", "", "progresardatos");

        // Comprobar si la conexión fue exitosa
        if ($conexion->connect_error) {
            die("Conexión fallida: " . $conexion->connect_error);
        }

        $user = $_SESSION["s_usuario"]; 

        echo $sql = "SELECT * FROM ahorro WHERE asesor = '$usuario' ";
        $resultado = $conexion->query($sql);

        // Verifica si la consulta ha devuelto resultados
        if ($resultado->num_rows > 0) {
            while($fila = $resultado->fetch_assoc()) {
                $fila['id'];         
            
        $conexion->close();
    ?>

    <input type="hidden" name="id1" id="id1" value="<?php echo $fila['id']; ?>">
    <input type="hidden" id="asesor_n" name="asesor_n" value="<?php echo $fila['asesor']; ?>">
    <p style="text-align:center;"><button class="btn btn-primary" type="submit">Agregar pago</button></p>
    
</form><br>

<table class="table" style="width:80%;margin:0 auto;">
  <thead>
    <tr>
        <th scope="col">Fecha</th>
        <th scope="col">Abono S/</th>
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

       $id = $fila['id'];

        // Consulta para obtener el total desde la tabla 'ahorro'
        $sql = "SELECT * FROM ahorro WHERE id = '$id'";
        $resultado2 = $conexion->query($sql);

        // Verifica si la consulta ha devuelto resultados
        if ($resultado2->num_rows > 0) {
            while($fila2 = $resultado2->fetch_assoc()) { 
                $asesor = $fila2['asesor']; // Almacena el total de la fila
            }
        }  

        $sql2 = "SELECT fecha,abono FROM couta_inversion WHERE asesor = '$asesor'";
        $resultado3 = $conexion->query($sql2);


        // Verifica si la consulta ha devuelto resultados
        if ($resultado3->num_rows > 0) {
            while($fila3 = $resultado3->fetch_assoc()) { 
              
    ?>
    <tr>
        <td><?php echo $fila3['fecha']; ?></td>
        <td><?php echo $fila3['abono']; ?></td>
    </tr>
    <?php   
       }
    } 
    ?>
  </tbody>
</table>
<?php 
    }   
            
    } else {
        echo "No se encontraron resultados";
    }

    $sql3 = "SELECT SUM(abono) as abono FROM couta_inversion WHERE asesor = '$asesor'";
    $resultado4 = $conexion->query($sql3);

    if ($resultado4->num_rows > 0) {
        while($fila4 = $resultado4->fetch_assoc()) { 
            $total_abono = $fila4['abono'];
        }
    }

    $sql3 = "SELECT * FROM inversion WHERE asesor = '$asesor'";
    $resultado4 = $conexion->query($sql3);

    if ($resultado4->num_rows > 0) {
        while($fila4 = $resultado4->fetch_assoc()) { 
            $cant = $fila4['cantidad'];
        }
    }
?>
<br>
<p style="text-align: center;">Restante de inversion: <b><?php echo $cant-$total_abono; ?> S/</b></p>
<!--FIN del cont principal-->
<?php require_once "parte_inferior.php"?>
