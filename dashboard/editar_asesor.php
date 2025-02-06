<?php require_once "parte_superior.php"?>
<?php
// Iniciar la sesión (si no está iniciada)
session_start();

// Incluir la conexión a la base de datos
include_once 'bd/conexion.php';

// Verificar si el usuario está logueado (opcional, si decides usar sesiones más adelante)
if (!isset($_SESSION["s_usuario"])) {
    // Si no hay sesión, puedes redirigir o manejar el caso como desees
    // Por ahora, asignamos un valor por defecto para evitar errores
    $_SESSION["s_usuario"] = "usuario_prueba"; // Cambia esto según tus necesidades
}

// Obtener el nombre de usuario desde la sesión
$user = $_SESSION["s_usuario"];

// Consulta para obtener los datos del usuario
$consulta = "SELECT * FROM usuarios WHERE usuario = :user";
$resultado = $conexion->prepare($consulta);
$resultado->bindParam(':user', $user, PDO::PARAM_STR);
$resultado->execute();

// Obtener los datos del usuario
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

// Obtener el ID del asesor (si existe)
$id_asesor = null;
if (!empty($data)) {
    $id_asesor = $data[0]['id'];
}
?>

<!-- INICIO del cont principal -->
<div class="animate__animated p-6" :class="[$store.app.animation]">
    <form method="POST" action="" class="mb-5 rounded-md border border-[#ebedf2] bg-white p-4 dark:border-[#191e3a] dark:bg-[#0e1726]" enctype="multipart/form-data">
        <h6 class="mb-5 text-lg font-bold">General Information</h6>
        <div class="flex flex-col sm:flex-row">
            <div class="mb-5 w-full sm:w-2/12 ltr:sm:mr-4 rtl:sm:ml-4">
                <?php
                // Obtener la imagen del asesor (si existe)
                if ($id_asesor) {
                    $query = "SELECT contenido, tipo FROM imagenes_asesores WHERE id_asesor = :id";
                    $stmt = $conexion->prepare($query);
                    $stmt->bindParam(':id', $id_asesor, PDO::PARAM_INT);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($row) {
                        // Mostrar la imagen en base64
                        echo '<div>
                                <img src="data:image/jpeg;base64,' . base64_encode($row['contenido']) . '" alt="image" class="mx-auto h-20 w-20 rounded-full object-cover md:h-32 md:w-32">
                              </div>';
                    } else {
                        echo '<div>No hay imagen disponible.</div>';
                    }
                }
                ?>
                <input type="file" name="imagen" id="imagen">
            </div>

            <?php foreach ($data as $row) { ?>
                <div class="grid flex-1 grid-cols-1 gap-5 sm:grid-cols-2">
                    <div>
                        <label for="name">Nombres</label>
                        <input id="nombres" name="nombres" type="text" value="<?php echo $row['nombres']; ?>" class="form-input">
                        <input id="id" name="id" type="hidden" value="<?php echo $row['id']; ?>" class="form-input">
                    </div>
                    <div>
                        <label for="profession">DNI</label>
                        <input id="dni" name="dni" value="<?php echo $row['dni']; ?>" type="text" class="form-input">
                    </div>
                    <div>
                        <label for="profession">Cargo</label>
                        <select id="cargo" name="cargo" class="form-select">
                            <option>Ahorros</option>
                            <option>Créditos</option>
                        </select>
                    </div>
                    <div>
                        <label for="profession">Sexo</label>
                        <input id="sexo" name="sexo" value="<?php echo $row['sexo']; ?>" type="text" class="form-input">
                    </div>
                    <div>
                        <label for="address">F. de Incorporación</label>
                        <input id="incorporacion" name="incorporacion" value="<?php echo $row['incorporacion']; ?>" type="text" class="form-input">
                    </div>
                    <div>
                        <label for="location">F. de Nacimiento</label>
                        <input id="nacimiento" name="nacimiento" type="text" value="<?php echo $row['nacimiento']; ?>" class="form-input">
                    </div>
                    <div>
                        <label for="country">Agencia</label>
                        <select id="agencia" name="agencia" class="form-select text-white-dark">
                            <option>Bambamarca</option>
                            <option>Chota</option>
                            <option>Cajamarca</option>
                        </select>
                    </div>
                    <div>
                        <label for="phone">Telefono</label>
                        <input id="telefono" name="telefono" value="<?php echo $row['telefono']; ?>" type="text" class="form-input">
                    </div>
                    <div>
                        <label for="email">Correo</label>
                        <input id="correo" name="correo" value="<?php echo $row['correo']; ?>" class="form-input">
                    </div>
                    <div>
                        <label for="web">Dirección</label>
                        <input id="direccion" name="direccion" value="<?php echo $row['direccion']; ?>" class="form-input">
                    </div>
                    <div class="mt-3 sm:col-span-2">
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </div>
            <?php } ?>
        </div>
    </form>

    <?php
    // Procesar el formulario cuando se envía
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $id = $_POST['id'];
        $nombres = $_POST['nombres'];
        $dni = $_POST['dni'];
        $cargo = $_POST['cargo'];
        $sexo = $_POST['sexo'];
        $incorporacion = $_POST['incorporacion'];
        $nacimiento = $_POST['nacimiento'];
        $agencia = $_POST['agencia'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $direccion = $_POST['direccion'];

        // Actualizar los datos del usuario
        $consulta2 = "UPDATE usuarios SET  
            nombres = :nombres,
            dni = :dni,
            cargo = :cargo,
            sexo = :sexo,
            incorporacion = :incorporacion,
            nacimiento = :nacimiento,
            agencia = :agencia,
            telefono = :telefono,
            correo = :correo,
            direccion = :direccion
            WHERE id = :id";

        $resultado2 = $conexion->prepare($consulta2);
        $resultado2->bindParam(':nombres', $nombres, PDO::PARAM_STR);
        $resultado2->bindParam(':dni', $dni, PDO::PARAM_STR);
        $resultado2->bindParam(':cargo', $cargo, PDO::PARAM_STR);
        $resultado2->bindParam(':sexo', $sexo, PDO::PARAM_STR);
        $resultado2->bindParam(':incorporacion', $incorporacion, PDO::PARAM_STR);
        $resultado2->bindParam(':nacimiento', $nacimiento, PDO::PARAM_STR);
        $resultado2->bindParam(':agencia', $agencia, PDO::PARAM_STR);
        $resultado2->bindParam(':telefono', $telefono, PDO::PARAM_STR);
        $resultado2->bindParam(':correo', $correo, PDO::PARAM_STR);
        $resultado2->bindParam(':direccion', $direccion, PDO::PARAM_STR);
        $resultado2->bindParam(':id', $id, PDO::PARAM_INT);
        $resultado2->execute();

        // Procesar la imagen si se subió
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
            $imagen_tmp = $_FILES['imagen']['tmp_name'];
            $imagen_nombre = $_FILES['imagen']['name'];
            $imagen_tipo = $_FILES['imagen']['type'];
            $imagen_contenido = file_get_contents($imagen_tmp);

            // Eliminar la imagen anterior (si existe)
            $consulta3 = "DELETE FROM imagenes_asesores WHERE id_asesor = :id";
            $resultado3 = $conexion->prepare($consulta3);
            $resultado3->bindParam(':id', $id, PDO::PARAM_INT);
            $resultado3->execute();

            // Insertar la nueva imagen
            $consulta4 = "INSERT INTO imagenes_asesores (id_asesor, nombre, tipo, contenido) VALUES (:id_asesor, :nombre, :tipo, :contenido)";
            $stmt = $conexion->prepare($consulta4);
            $stmt->bindParam(':id_asesor', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $imagen_nombre, PDO::PARAM_STR);
            $stmt->bindParam(':tipo', $imagen_tipo, PDO::PARAM_STR);
            $stmt->bindParam(':contenido', $imagen_contenido, PDO::PARAM_LOB);
            $stmt->execute();
        }

        // Redirigir después de guardar los cambios
        echo '<script type="text/javascript">window.location.href = "perfil.php";</script>';
    }
    ?>
</div>
<!-- FIN del cont principal -->