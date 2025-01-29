<?php require_once "parte_superior.php"?>

<!--INICIO del cont principal-->
<div class="animate__animated p-6" :class="[$store.app.animation]">
    

         <?php include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT * FROM asesores";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);

?>

                   <!-- start main content section -->
                    

                    
                    <!-- end main content section -->

                </div>
<!--FIN del cont principal-->
<?php require_once "parte_inferior.php"?>