<?php 
    require_once "parte_superior.php";

    $conexion = new mysqli("localhost", "root", "", "progresardatos");

    // Check if the connection was successful
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $id2 = $_POST['id2'];
    $titulo2 = $_POST['titulo2'];
    $contenido2 = $_POST['contenido2'];

    $sql2 = "UPDATE notas SET titulo = '$titulo2', contenido = '$contenido2' WHERE id = '$id2'";
    $resultado = $conexion->query($sql2);

    $sql3 = "INSERT INTO notificaciones (id_asesor,title,notification) VALUES ($id2,titulo2,'Se ha modificado una nota')";
    $resultado3 = $conexion->prepare($sql3);

    if ($conexion->query($sql2) === TRUE) {
                    ?>
    <script type="text/javascript">
        window.location.href = "notas.php";
    </script>
    <?php
    } else {
        echo "Error al editar nota: " . $conexion->error;
    }

?>