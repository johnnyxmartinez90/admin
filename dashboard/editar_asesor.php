<?php require_once "parte_superior.php"?>

<!--INICIO del cont principal-->
<?php
include_once 'bd/conexion.php';

$user = $_SESSION["s_usuario"];

$consulta = "SELECT * FROM usuarios WHERE usuario = '$user' ";

$resultado = $conexion->prepare($consulta);
$resultado->bindParam(':user', $user, PDO::PARAM_STR);
$resultado->execute();

$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>
    <div class="animate__animated p-6" :class="[$store.app.animation]">
        
        <form method="POST" action="" class="mb-5 rounded-md border border-[#ebedf2] bg-white p-4 dark:border-[#191e3a] dark:bg-[#0e1726]" enctype="multipart/form-data">
            <h6 class="mb-5 text-lg font-bold">General Information</h6>
            <div class="flex flex-col sm:flex-row">
                <div class="mb-5 w-full sm:w-2/12 ltr:sm:mr-4 rtl:sm:ml-4">
                    <?php 
                    foreach ($data as $row) {
                        $id_asesor = $row['id'];
                    }
                    $id = $id_asesor;

                    $query = "SELECT contenido, tipo FROM imagenes_asesores WHERE id_asesor = :id";
                    $stmt = $conexion->prepare($query);
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt->execute();

                    // Obtener la imagen
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Función para mostrar la imagen
                    function mostrar_imagen($row) {
                        if ($row) {
                            // Establecer los encabezados para el tipo de imagen
                            header("Content-Type: " . $row['tipo']);
                            echo $row['contenido'];  // Mostrar el contenido binario de la imagen
                        } else {
                            echo "Imagen no encontrada.";
                        }
                    }
                    ?>
                    <div>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($row['contenido']); ?>" alt="image" class="mx-auto h-20 w-20 rounded-full object-cover md:h-32 md:w-32">
                    </div>
                    <input type="file" name="imagen" id="imagen">
                </div>
                <?php foreach ($data as $row) { ?>
                <div class="grid flex-1 grid-cols-1 gap-5 sm:grid-cols-2">
                    <div>
                        <label for="name">Nombres</label>
                        <input id="nombres" name="nombres" type="text" value="<?php echo $row['nombres'] ;?>" class="form-input">
                        <input id="id" name="id" type="hidden" value="<?php echo $row['id'] ;?>" class="form-input">
                    </div>
                    <div>
                        <label for="profession">DNI</label>
                        <input id="dni" name="dni" value="<?php echo $row['dni'] ;?>" type="text" class="form-input">
                    </div>
                    <div>
                        <label for="profession">Cargo</label>
                        <select id="cargo" name="cargo"type="text" class="form-select">
                            <option>Ahorros</option>
                            <option>Créditos</option>
                        </select>
                    </div>
                    <div>
                        <label for="profession">Sexo</label>
                        <input id="sexo" name="sexo" value="<?php echo $row['sexo'] ;?>" type="text" class="form-input">
                    </div>
                    <div>
                        <label for="address">F. de Incorporación</label>
                        <input id="incorporacion" name="incorporacion" value="<?php echo $row['incorporacion'] ;?>" type="text" class="form-input">
                    </div>
                    <div>
                        <label for="location">F. de Nacimiento</label>
                        <input id="nacimiento" name="nacimiento" type="text" value="<?php echo $row['nacimiento'] ;?>" class="form-input">
                    </div>
                    <div>
                        <label for="country">Agencia</label>
                        <select id="agencia" name="agencia" value="<?php echo $row['agencia'] ;?>"  class="form-select text-white-dark">
                            <option>Bambamarca</option>
                            <option>Chota</option>
                            <option>Cajamarca</option>>
                        </select>
                    </div>
                    <div>
                        <label for="phone">Telefono</label>
                        <input id="telefono" name="telefono" value="<?php echo $row['telefono'] ;?>" type="text" class="form-input">
                    </div>
                    <div>
                        <label for="email">Correo</label>
                        <input id="correo" name="correo" value="<?php echo $row['correo'] ;?>" class="form-input">
                    </div>
                    <div>
                        <label for="web">Dirección</label>
                        <input id="direccion" name="direccion" value="<?php echo $row['direccion'] ;?>" class="form-input">
                    </div>
                    <div class="mt-3 sm:col-span-2">
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </div>
            </div>
            <?php        
        }          
     
        ?>
        </form>
        <?php 

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $id = $_POST['id'];
            $user;
            $nombres = $_POST['nombres'];
            $dni  = $_POST['dni'];
            $cargo = $_POST['cargo'];  
            $sexo = $_POST['sexo'];
            $incorporacion = $_POST['incorporacion'];
            $nacimiento = $_POST['nacimiento'];
            $agencia = $_POST['agencia'];
            $telefono = $_POST['telefono'];
            $correo = $_POST['correo'];
            $direccion = $_POST['direccion'];

            if(!isset($_FILES['imagen']) || $_FILES['imagen']['error'] == UPLOAD_ERR_NO_FILE ){
                $consulta2 = "UPDATE usuarios SET  
                nombres = '$nombres',
                dni = '$dni',
                cargo = '$cargo',
                sexo = '$sexo',
                incorporacion = '$incorporacion',
                nacimiento = '$nacimiento',
                agencia = '$agencia',
                telefono = '$telefono',
                correo = '$correo',
                direccion = '$direccion'
                WHERE usuario = '$user' ";

                $resultado2 = $conexion->prepare($consulta2);
                $resultado2->execute();
            }else{
                $consulta2 = "UPDATE usuarios SET  
                nombres = '$nombres',
                dni = '$dni',
                cargo = '$cargo',
                sexo = '$sexo',
                incorporacion = '$incorporacion',
                nacimiento = '$nacimiento',
                agencia = '$agencia',
                telefono = '$telefono',
                correo = '$correo',
                direccion = '$direccion'
                WHERE usuario = '$user' ";

                $resultado2 = $conexion->prepare($consulta2);
                $resultado2->execute();

                $consulta3 = "DELETE FROM imagenes_asesores WHERE id_asesor = '$id' ";

                $resultado3 = $conexion->prepare($consulta3);
                $resultado3->execute();

                if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
                // Obtener los datos de la imagen
                $imagen_tmp = $_FILES['imagen']['tmp_name'];  // archivo temporal
                $imagen_nombre = $_FILES['imagen']['name'];  // nombre original
                $imagen_tipo = $_FILES['imagen']['type'];    // tipo MIME

                // Leer el contenido de la imagen (binario)
                $imagen_contenido = file_get_contents($imagen_tmp);

                // Insertar la imagen en la base de datos
                $consulta4 = "INSERT INTO imagenes_asesores (id_asesor ,nombre, tipo, contenido) VALUES ('$id_asesor',:nombre, :tipo, :contenido)";
                $stmt = $conexion->prepare($consulta4);
    
                // Enlace de parámetros
                $stmt->bindParam(':nombre', $imagen_nombre, PDO::PARAM_STR);
                $stmt->bindParam(':tipo', $imagen_tipo, PDO::PARAM_STR);
                $stmt->bindParam(':contenido', $imagen_contenido, PDO::PARAM_LOB);

                // Ejecutar la consulta
                if ($stmt->execute()) {
                    ?>
                    <script type="text/javascript">
                        window.location.href = "perfil.php";
                    </script>
                    <?php
                } else {
                    echo "Error al subir la imagen.";
                }
                } else {
                    echo "Por favor, selecciona una imagen para subir.";
                }
            }

        } 


        ?>
        <!-- end main content section -->
    </div>
    <!--FIN del cont principal-->
    <?php require_once "parte_inferior.php"?>