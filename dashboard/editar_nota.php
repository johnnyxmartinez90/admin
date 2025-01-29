<?php require_once "parte_superior.php" ?>

<form method="POST">
    <input class="form-control" type="text" name="titulo" placeholder="Título" required><br>
    <textarea class="form-control" name="contenido" placeholder="Contenido" required></textarea><br>
    <button class="btn btn-primary" type="submit" name="agregar">Guardar cambios</button>
</form>

<?php require_once "parte_inferior.php" ?>
