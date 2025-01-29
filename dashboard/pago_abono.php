<?php require_once "parte_superior.php"?>

<!--INICIO del cont principal-->
<form method="POST" style="width: 85%; margin: auto;">
  <div class="mb-3">
    <label for="asesor" class="form-label">Asesor</label>
    <input class="form-control" type="text" name="asesor" id="asesor"> 
  </div>
  <div class="mb-3">
    <label for="cantidad" class="form-label">Cantidad</label>
    <input class="form-control" type="text" name="cantidad" id="cantidad"> 
  </div>
  <div class="mb-3">
    <!-- Botón de tipo submit -->
    <button type="submit" class="btn btn-primary">Guardar</button>
  </div>
</form>
<!-- end main content section -->

<!--FIN del cont principal-->
<?php require_once "parte_inferior.php"?>
