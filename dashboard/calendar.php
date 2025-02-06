<?php require_once "parte_superior.php" ?>

<style type="text/css">
    table.table {
        width: 91%;
        margin: 0 auto;
    }
    th.dayt {
        background: #4361ee;
        color: white;
    }
    h1 {
        font-size: 1.5em;
        text-align: center;
    }
    .nav-btns {
        text-align: center;
        margin-bottom: 10px;
    }
    .nav-btns a {
        margin: 0 10px;
        padding: 10px;
        background-color: #4361ee;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }
    .nav-btns a:hover {
        background-color: #375aab;
    }
</style>

<?php
// Obtener el mes y el año actual (o pasar un mes y año específicos si es necesario)
$mes = isset($_GET['mes']) ? (int)$_GET['mes'] : date('n'); // Mes actual
$año = isset($_GET['año']) ? (int)$_GET['año'] : date('Y'); // Año actual

// Nombres de los días y los meses
$diasSemana = ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"];
$meses = [
    1 => "Enero", 2 => "Febrero", 3 => "Marzo", 4 => "Abril", 5 => "Mayo", 6 => "Junio",
    7 => "Julio", 8 => "Agosto", 9 => "Septiembre", 10 => "Octubre", 11 => "Noviembre", 12 => "Diciembre"
];

// Calcular el primer día del mes y cuántos días tiene el mes
$primerDia = date('w', strtotime("$año-$mes-01"));
$diasDelMes = date('t', strtotime("$año-$mes-01"));

// Función para cambiar el mes
function cambiarMes($mes, $año, $cambio) {
    $nuevoMes = $mes + $cambio;

    if ($nuevoMes > 12) {
        $nuevoMes = 1;
        $año++;
    } elseif ($nuevoMes < 1) {
        $nuevoMes = 12;
        $año--;
    }

    return [$nuevoMes, $año];
}

// Enlaces para navegar entre meses
list($mesAnterior, $añoAnterior) = cambiarMes($mes, $año, -1);
list($mesSiguiente, $añoSiguiente) = cambiarMes($mes, $año, 1);

echo "<br>";
echo "<div class='nav-btns'>";
echo "<a href='?mes=$mesAnterior&año=$añoAnterior'>&laquo; Mes Anterior</a>";
echo "<a href='?mes=$mesSiguiente&año=$añoSiguiente'>Mes Siguiente &raquo;</a>";
echo "</div>";

echo "<h1>$meses[$mes] $año</h1>"; 
echo "<br>";
echo "<table class='table' border='1' cellpadding='5' cellspacing='0'>";
echo "<tr>";

// Mostrar los días de la semana
foreach ($diasSemana as $dia) {
    echo "<th class='dayt'>$dia</th>";
}
echo "</tr><tr>";

// Mostrar los días del mes
$dia = 1; // Empezamos con el primer día del mes

// Dejar espacios en blanco antes de que empiece el mes
for ($i = 0; $i < $primerDia; $i++) {
    echo "<td></td>";
}

// Mostrar los días del mes
while ($dia <= $diasDelMes) {
    // Si es un sábado, empezamos una nueva fila
    if ($primerDia > 6) {
        $primerDia = 0;
        echo "</tr><tr>";
    }
    echo "<td>$dia</td>";
    $dia++;
    $primerDia++;
}

// Completar los espacios vacíos al final del mes
while ($primerDia <= 6) {
    echo "<td></td>";
    $primerDia++;
}

echo "</tr></table>";

?>

<?php require_once "parte_inferior.php" ?>