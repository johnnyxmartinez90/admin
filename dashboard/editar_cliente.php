<?php
require_once "parte_superior.php";

// Conexión a la base de datos usando PDO
try {
    $conexion = new PDO('mysql:host=localhost;dbname=progresardatos', 'root', '');
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable exceptions for errors
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Obtener el ID del usuario desde la URL
$id = $_GET['id'] ?? null;

if ($id) {
    // Consulta para obtener los datos del usuario
    $sql = "SELECT * FROM clientes WHERE id = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // Mostrar el formulario con los datos del usuario
?>
        <form method="POST" action="" class="mb-5 rounded-md border border-[#ebedf2] bg-white p-4 dark:border-[#191e3a] dark:bg-[#0e1726]" enctype="multipart/form-data">
            <h6 class="mb-5 text-lg font-bold">General Information</h6>
            <div class="grid flex-1 grid-cols-1 gap-5 sm:grid-cols-2">
                <div class="mb-5 w-full sm:w-2/12 ltr:sm:mr-4 rtl:sm:ml-4">
                    <?php
                    // Obtener la imagen del cliente (si existe)
                    $query = "SELECT contenido, tipo FROM imagenes_clientes WHERE id_cliente = :id";
                    $stmt_img = $conexion->prepare($query);
                    $stmt_img->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt_img->execute();
                    $imagen = $stmt_img->fetch(PDO::FETCH_ASSOC);

                    if ($imagen) {
                        // Mostrar la imagen en base64
                        echo '<div>
                                <img src="data:image/jpeg;base64,' . base64_encode($imagen['contenido']) . '" alt="image" class="mx-auto h-20 w-20 rounded-full object-cover md:h-32 md:w-32">
                              </div>';
                    } else {
                        echo '<div>No hay imagen disponible.</div>';
                    }
                    ?>
                    <input type="file" name="imagen" id="imagen">
                </div>
                <div>
                    <label for="name">Nombres</label>
                    <input id="nombres" name="nombres" type="text" value="<?php echo htmlspecialchars($row['nombres'] ?? ''); ?>" class="form-input">
                </div>
                <div>
                    <label for="profession">DNI</label>
                    <input id="dni" name="dni" value="<?php echo htmlspecialchars($row['dni'] ?? ''); ?>" type="text" class="form-input">
                </div>
                <div>
                    <label for="profession">Estado Civil</label>
                    <input id="estadocivil" name="estadocivil" value="<?php echo htmlspecialchars($row['estadocivil'] ?? ''); ?>" type="text" class="form-input">
                </div>
                <div>
                    <label for="profession">Teléfono</label>
                    <input id="telefono" name="telefono" value="<?php echo htmlspecialchars($row['telefono'] ?? ''); ?>" type="text" class="form-input">
                </div>
                <div>
                    <label for="location">Correo</label>
                    <input id="correo" name="correo" type="text" value="<?php echo htmlspecialchars($row['correo'] ?? ''); ?>" class="form-input">
                </div>
                <div>
                    <label for="country">Cónyuge</label>
                    <input id="conyuge" name="conyuge" value="<?php echo htmlspecialchars($row['conyuge'] ?? ''); ?>" type="text" class="form-input">
                </div>
                <div>
                    <label for="phone">DNI Cónyuge</label>
                    <input id="dniconyuge" name="dniconyuge" value="<?php echo htmlspecialchars($row['dniconyuge'] ?? ''); ?>" type="text" class="form-input">
                </div>
                <div>
                    <label for="email">Sexo</label>
                    <input id="sexo" name="sexo" value="<?php echo htmlspecialchars($row['sexo'] ?? ''); ?>" class="form-input">
                </div>
                <div>
                    <label for="web">Fecha de Nacimiento</label>
                    <input id="fechanacimiento" name="fechanacimiento" value="<?php echo htmlspecialchars($row['fechanacimiento'] ?? ''); ?>" class="form-input">
                </div>
                <div>
                    <label for="web">Ocupación</label>
                    <input id="ocupacion" name="ocupacion" value="<?php echo htmlspecialchars($row['ocupacion'] ?? ''); ?>" class="form-input">
                </div>
                <div>
                    <label for="web">Dirección de Trabajo</label>
                    <input id="directrabajo" name="directrabajo" value="<?php echo htmlspecialchars($row['directrabajo'] ?? ''); ?>" class="form-input">
                </div>
                <div>
                    <label for="web">Ref. de Trabajo</label>
                    <input id="reftrabajo" name="reftrabajo" value="<?php echo htmlspecialchars($row['reftrabajo'] ?? ''); ?>" class="form-input">
                </div>
                <div>
                    <label for="web">Dirección de Domicilio</label>
                    <input id="direcvivienda" name="direcvivienda" value="<?php echo htmlspecialchars($row['direcvivienda'] ?? ''); ?>" class="form-input">
                </div>
                <div>
                    <label for="web">Departamento</label>
                    <input id="departamento" name="departamento" value="<?php echo htmlspecialchars($row['departamento'] ?? ''); ?>" class="form-input">
                </div>
                <div>
                    <label for="web">Provincia</label>
                    <input id="provincia" name="provincia" value="<?php echo htmlspecialchars($row['provincia'] ?? ''); ?>" class="form-input">
                </div>
                <div>
                    <label for="web">Distrito</label>
                    <input id="distrito" name="distrito" value="<?php echo htmlspecialchars($row['distrito'] ?? ''); ?>" class="form-input">
                </div>
                <div>
                    <label for="web">Ubicación</label>
                    <input id="ubic" name="ubic" value="<?php echo htmlspecialchars($row['ubic'] ?? ''); ?>" class="form-input">
                </div>
                <div>
                    <label for="web">Ref. Vivienda</label>
                    <input id="refvivienda" name="refvivienda" value="<?php echo htmlspecialchars($row['refvivienda'] ?? ''); ?>" class="form-input">
                </div>
                <div>
                    <label for="web">Tipo de Vivienda</label>
                    <input id="tipovivienda" name="tipovivienda" value="<?php echo htmlspecialchars($row['tipovivienda'] ?? ''); ?>" class="form-input">
                </div>
                <div>
                    <label for="web">Suministro</label>
                    <input id="suministro" name="suministro" value="<?php echo htmlspecialchars($row['suministro'] ?? ''); ?>" class="form-input">
                </div>
                <div class="mt-3 sm:col-span-2">
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </div>
        </form>
<?php
    } else {
        echo "No se encontró el usuario.";
    }
}

// Procesar el formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];
    $nombres = $_POST['nombres'];
    $dni = $_POST['dni'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $sexo = $_POST['sexo'];
    $fechanacimiento = $_POST['fechanacimiento'];
    $estadocivil = $_POST['estadocivil'];
    $conyuge = $_POST['conyuge'];
    $dniconyuge = $_POST['dniconyuge'];
    $direcvivienda = $_POST['direcvivienda'];
    $departamento = $_POST['departamento'];
    $provincia = $_POST['provincia'];
    $distrito = $_POST['distrito'];
    $ubic = $_POST['ubic'];
    $refvivienda = $_POST['refvivienda'];
    $tipovivienda = $_POST['tipovivienda'];
    $suministro = $_POST['suministro'];
    $ocupacion = $_POST['ocupacion'];
    $directrabajo = $_POST['directrabajo'];
    $reftrabajo = $_POST['reftrabajo'];

    // Actualizar los datos del cliente
    $consulta2 = "UPDATE clientes SET  
        nombres = :nombres,
        dni = :dni,
        telefono = :telefono,
        correo = :correo,
        sexo = :sexo,
        fechanacimiento = :fechanacimiento,
        estadocivil = :estadocivil,
        conyuge = :conyuge,
        dniconyuge = :dniconyuge,
        direcvivienda = :direcvivienda,
        departamento = :departamento,
        provincia = :provincia,
        distrito = :distrito,
        ubic = :ubic,
        refvivienda = :refvivienda,
        tipovivienda = :tipovivienda,
        suministro = :suministro,
        ocupacion = :ocupacion,
        directrabajo = :directrabajo,
        reftrabajo = :reftrabajo
        WHERE id = :id";

    $resultado2 = $conexion->prepare($consulta2);
    $resultado2->bindParam(':nombres', $nombres, PDO::PARAM_STR);
    $resultado2->bindParam(':dni', $dni, PDO::PARAM_STR);
    $resultado2->bindParam(':telefono', $telefono, PDO::PARAM_STR);
    $resultado2->bindParam(':correo', $correo, PDO::PARAM_STR);
    $resultado2->bindParam(':sexo', $sexo, PDO::PARAM_STR);
    $resultado2->bindParam(':fechanacimiento', $fechanacimiento, PDO::PARAM_STR);
    $resultado2->bindParam(':estadocivil', $estadocivil, PDO::PARAM_STR);
    $resultado2->bindParam(':conyuge', $conyuge, PDO::PARAM_STR);
    $resultado2->bindParam(':dniconyuge', $dniconyuge, PDO::PARAM_STR);
    $resultado2->bindParam(':direcvivienda', $direcvivienda, PDO::PARAM_STR);
    $resultado2->bindParam(':departamento', $departamento, PDO::PARAM_STR);
    $resultado2->bindParam(':provincia', $provincia, PDO::PARAM_STR);
    $resultado2->bindParam(':distrito', $distrito, PDO::PARAM_STR);
    $resultado2->bindParam(':ubic', $ubic, PDO::PARAM_STR);
    $resultado2->bindParam(':refvivienda', $refvivienda, PDO::PARAM_STR);
    $resultado2->bindParam(':tipovivienda', $tipovivienda, PDO::PARAM_STR);
    $resultado2->bindParam(':suministro', $suministro, PDO::PARAM_STR);
    $resultado2->bindParam(':ocupacion', $ocupacion, PDO::PARAM_STR);
    $resultado2->bindParam(':directrabajo', $directrabajo, PDO::PARAM_STR);
    $resultado2->bindParam(':reftrabajo', $reftrabajo, PDO::PARAM_STR);
    $resultado2->bindParam(':id', $id, PDO::PARAM_INT);
    $resultado2->execute();

    // Procesar la imagen si se subió
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $imagen_tmp = $_FILES['imagen']['tmp_name'];
        $imagen_nombre = $_FILES['imagen']['name'];
        $imagen_tipo = $_FILES['imagen']['type'];
        $imagen_contenido = file_get_contents($imagen_tmp);

        // Eliminar la imagen anterior (si existe)
        $consulta3 = "DELETE FROM imagenes_clientes WHERE id_cliente = :id";
        $resultado3 = $conexion->prepare($consulta3);
        $resultado3->bindParam(':id', $id, PDO::PARAM_INT);
        $resultado3->execute();

        // Insertar la nueva imagen
        $consulta4 = "INSERT INTO imagenes_clientes (id_cliente, nombre, tipo, contenido) VALUES (:id_cliente, :nombre, :tipo, :contenido)";
        $stmt = $conexion->prepare($consulta4);
        $stmt->bindParam(':id_cliente', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $imagen_nombre, PDO::PARAM_STR);
        $stmt->bindParam(':tipo', $imagen_tipo, PDO::PARAM_STR);
        $stmt->bindParam(':contenido', $imagen_contenido, PDO::PARAM_LOB);
        $stmt->execute();
    }

    // Redirigir después de guardar los cambios
    echo '<script type="text/javascript">window.location.href = "lista_clientes.php";</script>';
}
?>

<!--FIN del cont principal-->
<?php require_once "parte_inferior.php"; ?>