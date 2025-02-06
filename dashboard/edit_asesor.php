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
    $sql = "SELECT * FROM usuarios WHERE id = :id";
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
                    // Obtener la imagen del asesor (si existe)
                    $query = "SELECT contenido, tipo FROM imagenes_asesores WHERE id_asesor = :id";
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
                    <input id="nombres" name="nombres" type="text" value="<?php echo htmlspecialchars($row['nombres']); ?>" class="form-input">
                    <input id="id" name="id" type="hidden" value="<?php echo $row['id']; ?>" class="form-input">
                </div>
                <div>
                    <label for="profession">DNI</label>
                    <input id="dni" name="dni" value="<?php echo htmlspecialchars($row['dni']); ?>" type="text" class="form-input">
                </div>
                <div>
                    <label for="profession">Cargo</label>
                    <select id="cargo" name="cargo" class="form-select">
                        <option value="Ahorros" <?php echo ($row['cargo'] == 'Ahorros') ? 'selected' : ''; ?>>Ahorros</option>
                        <option value="Créditos" <?php echo ($row['cargo'] == 'Créditos') ? 'selected' : ''; ?>>Créditos</option>
                    </select>
                </div>
                <div>
                    <label for="profession">Sexo</label>
                    <input id="sexo" name="sexo" value="<?php echo htmlspecialchars($row['sexo']); ?>" type="text" class="form-input">
                </div>
                <div>
                    <label for="address">F. de Incorporación</label>
                    <input id="incorporacion" name="incorporacion" value="<?php echo htmlspecialchars($row['incorporacion']); ?>" type="text" class="form-input">
                </div>
                <div>
                    <label for="location">F. de Nacimiento</label>
                    <input id="nacimiento" name="nacimiento" type="text" value="<?php echo htmlspecialchars($row['nacimiento']); ?>" class="form-input">
                </div>
                <div>
                    <label for="country">Agencia</label>
                    <select id="agencia" name="agencia" class="form-select text-white-dark">
                        <option value="Bambamarca" <?php echo ($row['agencia'] == 'Bambamarca') ? 'selected' : ''; ?>>Bambamarca</option>
                        <option value="Chota" <?php echo ($row['agencia'] == 'Chota') ? 'selected' : ''; ?>>Chota</option>
                        <option value="Cajamarca" <?php echo ($row['agencia'] == 'Cajamarca') ? 'selected' : ''; ?>>Cajamarca</option>
                    </select>
                </div>
                <div>
                    <label for="phone">Telefono</label>
                    <input id="telefono" name="telefono" value="<?php echo htmlspecialchars($row['telefono']); ?>" type="text" class="form-input">
                </div>
                <div>
                    <label for="email">Correo</label>
                    <input id="correo" name="correo" value="<?php echo htmlspecialchars($row['correo']); ?>" class="form-input">
                </div>
                <div>
                    <label for="web">Dirección</label>
                    <input id="direccion" name="direccion" value="<?php echo htmlspecialchars($row['direccion']); ?>" class="form-input">
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

<!--FIN del cont principal-->
<?php require_once "parte_inferior.php"; ?>