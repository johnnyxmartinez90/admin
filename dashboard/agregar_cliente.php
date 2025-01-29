<?php require_once "parte_superior.php"?>

<?php
$mysqli = new PDO('mysql:host=localhost;dbname=progresardatos', 'root', '');

$user = $_SESSION["s_usuario"];

$consulta = "SELECT * FROM usuarios WHERE usuario = '$user' ";

$resultado = $mysqli->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<!--INICIO del cont principal-->
<div class="animate__animated p-6" :class="[$store.app.animation]">


                    <!-- start main content section -->
                   <div x-data="invoiceAdd">
                            
                        <div class="flex flex-col gap-2.5 xl:flex-row">
                            <div class="panel flex-1 px-0 py-6 ltr:lg:mr-6 rtl:lg:ml-6"> 
                            
                                <h5 class="mb-5 text-lg font-semibold dark:text-white-light" style="padding: 0px 0px 15px 15px;">Agregar Cliente</h5>
                            
                                <div class="flex flex-wrap justify-between px-4">

                            
                                    <div class="mb-6 w-full lg:w-1/2">
                                        
                                        <div class="flex shrink-0 items-center text-black dark:text-white">
                                           <center> <img src="img/progresar_logo.png" alt="image" style="width: 150px;"></center>
                                        </div>

                                        <div class="mt-6 space-y-1 text-gray-500 dark:text-gray-400">
                                            <div>Microfinanciera Progresar Agencia Bambamarca.</div>
                                            <div>Jr. San Carlos 1002</div>
                                        </div>
                                    </div>
                                    <div class="w-full lg:w-1/2 lg:max-w-fit">
                                    <form method="POST" action="" enctype="multipart/form-data">
                                        <div class="flex items-center">
                                            <label for="reciever-name" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Nombres</label>
                                            <input type="text" id=" nombres" name=" nombres" class="form-input" required />
                                        </div>
                                        <div class="mt-4 flex items-center">
                                            <label for="reciever-name" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">DNI</label>
                                            <input type="text" id="dni" name="dni" class="form-input" required />
                                        </div>
                                        <div class="mt-4 flex items-center">
                                            <label for="reciever-name" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">RUC</label>
                                            <input type="text" id="ruc" name="ruc" class="form-input" required />
                                        </div>
                                        <div class="mt-4 flex items-center">
                                            <label for="reciever-name" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Cal. SBS</label>
                                            <select id="calsbs" name="calsbs" class="form-select">
                                                 <option>Normal</option>
                                                 <option>Problemas Potenciales</option>
                                                 <option>Deficiente</option>
                                                 <option>Dudoso</option>
                                                 <option>Perdida</option>
                                            </select>
                                        </div>
                                        
                                    </div>
                                </div>
                                <hr class="my-6 border-[#e0e6ed] dark:border-[#1b2e4b]">
                                <div class="mt-8 px-4">
                                    <div class="flex flex-col justify-between lg:flex-row">
                                        <div class="mb-6 w-full lg:w-1/2 ltr:lg:mr-6 rtl:lg:ml-6">
                                            <div class="mt-4 flex items-center">
                                                <label for="reciever-name" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Teléfono</label>
                                                <input type="text" id="telefono" name="telefono" class="form-input" required />
                                            </div>
                                            <div class="mt-4 flex items-center">
                                                <label for="reciever-email" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Correo</label>
                                                <input type="text" id="correo" name="correo" class="form-input" />
                                            </div>
                                            <div class="mt-4 flex items-center">
                                                <label for="reciever-name" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Sexo</label>
                                                <select id="sexo" name="sexo" class="form-select">
                                                    <option>Masculino</option>
                                                    <option>Femenino</option>
                                                </select>
                                            </div>
                                            <div class="mt-4 flex items-center">
                                                <label for="reciever-address" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Fecha de Nacimiento</label>
                                                <input type="date" id="fechanacimiento" name="fechanacimiento" class="form-input" required />
                                            </div>
                                        </div>
                                        <div class="w-full lg:w-1/2">
                                            <div class="mt-4 flex items-center">
                                                <label for="iban-code" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Estado Civil</label>
                                                <input type="text" id="estadocivil" name="estadocivil" class="form-input" required />
                                            </div>
                                            <div class="mt-4 flex items-center">
                                                <label for="bank-name" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Cónyuge</label>
                                                <input type="text" id="conyuge" name="conyuge" class="form-input"/>
                                            </div>
                                            <div class="mt-4 flex items-center">
                                                <label for="swift-code" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">DNI Cónyuge</label>
                                                <input type="text" id="dniconyuge" name="dniconyuge" class="form-input" />
                                            </div>                                           
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-6 border-[#e0e6ed] dark:border-[#1b2e4b]">
                                <div class="mt-8 px-4">
                                    <div class="flex flex-col justify-between lg:flex-row">
                                        <div class="mb-6 w-full lg:w-1/2 ltr:lg:mr-6 rtl:lg:ml-6">
                                            <div class="text-lg font-semibold">Información de Vivienda</div>
                                            <div class="mt-4 flex items-center">
                                                <label for="reciever-name" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Dirección de Domicilio</label>
                                                <input type="text" id="direcvivienda" name="direcvivienda" class="form-input" required />
                                            </div>
                                            <div class="mt-4 flex items-center">
                                                <label for="reciever-email" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Departamento</label>
                                                <input type="text" id="departamento" name="departamento" class="form-input" required />
                                            </div>
                                            <div class="mt-4 flex items-center">
                                                <label for="reciever-address" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Provincia</label>
                                                <input type="text" id="provincia" name="provincia" class="form-input" required />
                                            </div>
                                            <div class="mt-4 flex items-center">
                                                <label for="reciever-address" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Distrito</label>
                                                <input type="text" id="distrito" name="distrito" class="form-input" required />
                                            </div>
                                        </div>
                                        <div class="w-full lg:w-1/2">
                                            <div class="text-lg font-semibold">&nbsp;</div>
                                            <div class="mt-4 flex items-center">
                                                <label for="reciever-address" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Ubicación</label>
                                                <input type="text" id="ubic" name="ubic" class="form-input" required />
                                            </div>
                                            <div class="mt-4 flex items-center">
                                                <label for="acno" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Ref. Vivienda</label>
                                                <input type="text" id="refvivienda" name="refvivienda" class="form-input" required />
                                            </div>
                                            <div class="mt-4 flex items-center">
                                                <label for="country" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Tipo de Vivienda</label>
                                                <select id="tipovivienda" name="tipovivienda" class="form-select flex-1" x-model="params.bankInfo.country">
                                                    <option>Unifamiliar</option>
                                                    <option>Edificio Multifamiliar</option>
                                                    <option>Conjunto Residencial</option>
                                                    <option>Quinta</option>
                                                </select>
                                            </div>
                                            <div class="mt-4 flex items-center">
                                                <label for="swift-code" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Sumunistro</label>
                                                <input id="suministro" type="text" name="suministro" class="form-input flex-1" x-model="params.bankInfo.swiftCode">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    
                            </div>

                            <div class="mt-6 w-full xl:mt-0 xl:w-96">
                                <div class="mt-6 w-full xl:mt-0 xl:w-96">
                                <div class="panel mb-5">
                                    <div class="text-lg font-semibold">Información de Trabajo</div>
                                    <div>
                                        <label for="reciever-name" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Ocupación</label>
                                        <input id="ocupacion" type="text" name="ocupacion" class="form-input flex-1" x-model="params.to.email">
                                    </div>
                                    <div>
                                        <label for="reciever-address" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Dirección de Trabajo</label>
                                        <input id=" directrabajo" type="text" name=" directrabajo" class="form-input flex-1" x-model="params.to.address">
                                    </div>
                                    <div>
                                        <label for="reciever-email" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Ref. de Trabajo</label>
                                        <input id="reftrabajo" type="text" name="reftrabajo" class="form-input flex-1" x-model="params.to.email">
                                    </div>
                                </div>
                                <div class="panel mb-5">
                                        <label for="notes">Anotaciones</label>
                                        <textarea id="anotaciones" name="anotaciones" class="form-textarea min-h-[130px]" placeholder="Datos Adicionales..." x-model="params.notes"></textarea>
                                        <input type="hidden" id="asesor" name="asesor" value="<?php echo $row['nombres'] ;?>" readonly>
                                </div>
                                <div class="panel mb-5">
                                        <label for="iban-code" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Foto de perfil</label>
                                        <input type="file" name="imagen" id="imagen">
                                </div>
                            </div>
                                
                                <div class="panel">
                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-1">
                                        <button type="submit" class="btn btn-success w-full gap-2">
                                            <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2">
                                                <path d="M3.46447 20.5355C4.92893 22 7.28595 22 12 22C16.714 22 19.0711 22 20.5355 20.5355C22 19.0711 22 16.714 22 12C22 11.6585 22 11.4878 21.9848 11.3142C21.9142 10.5049 21.586 9.71257 21.0637 9.09034C20.9516 8.95687 20.828 8.83317 20.5806 8.58578L15.4142 3.41944C15.1668 3.17206 15.0431 3.04835 14.9097 2.93631C14.2874 2.414 13.4951 2.08581 12.6858 2.01515C12.5122 2 12.3415 2 12 2C7.28595 2 4.92893 2 3.46447 3.46447C2 4.92893 2 7.28595 2 12C2 16.714 2 19.0711 3.46447 20.5355Z" stroke="currentColor" stroke-width="1.5"></path>
                                                <path d="M17 22V21C17 19.1144 17 18.1716 16.4142 17.5858C15.8284 17 14.8856 17 13 17H11C9.11438 17 8.17157 17 7.58579 17.5858C7 18.1716 7 19.1144 7 21V22" stroke="currentColor" stroke-width="1.5"></path>
                                                <path opacity="0.5" d="M7 8H13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path>
                                            </svg>
                                            Guardar
                                        </button>
                                        <a href="lista_clientes.php" class="btn btn-primary w-full gap-2">
                                            <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 ltr:mr-2 rtl:ml-2">
                                                <path opacity="0.5" d="M3.27489 15.2957C2.42496 14.1915 2 13.6394 2 12C2 10.3606 2.42496 9.80853 3.27489 8.70433C4.97196 6.49956 7.81811 4 12 4C16.1819 4 19.028 6.49956 20.7251 8.70433C21.575 9.80853 22 10.3606 22 12C22 13.6394 21.575 14.1915 20.7251 15.2957C19.028 17.5004 16.1819 20 12 20C7.81811 20 4.97196 17.5004 3.27489 15.2957Z" stroke="currentColor" stroke-width="1.5"></path>
                                                <path d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z" stroke="currentColor" stroke-width="1.5"></path>
                                            </svg>
                                            Lista de Clientes
                                        </a>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end main content section -->

                </div>
<?php 

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $nombres = $_POST['nombres'];
    $dni = $_POST['dni'];
    $ruc = $_POST['ruc'];
    $calsbs = $_POST['calsbs'];
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
    $asesor = $_POST['asesor'];
    $anotaciones = $_POST['anotaciones'];

    echo $consulta2 = "INSERT INTO clientes (nombres, dni, ruc, calsbs, telefono, correo, sexo, fechanacimiento, estadocivil, conyuge, dniconyuge, direcvivienda, departamento, provincia, distrito, ubic, refvivienda, tipovivienda, suministro, ocupacion, directrabajo, reftrabajo, asesor, estado, anotaciones) VALUES ('$nombres','$dni','$ruc','$calsbs','$telefono','$correo','$sexo','$fechanacimiento','$estadocivil','$conyuge','$dniconyuge','$direcvivienda','$departamento','$provincia','$distrito','$ubic','$refvivienda','$tipovivienda','$suministro','$ocupacion','$directrabajo','$reftrabajo','$asesor','Activo','$anotaciones')";

    $resultado2 = $mysqli->prepare($consulta2);
    $resultado2->execute();

    $consulta3 = "SELECT id FROM clientes ORDER BY id DESC LIMIT 1";
    $resultado3 = $mysqli->prepare($consulta3);
    $resultado3->execute();
    $data = $resultado3->fetch(PDO::FETCH_ASSOC);
    $id_cliente = $data['id']; 

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        // Obtener los datos de la imagen
        $imagen_tmp = $_FILES['imagen']['tmp_name'];  // archivo temporal
        $imagen_nombre = $_FILES['imagen']['name'];  // nombre original
        $imagen_tipo = $_FILES['imagen']['type'];    // tipo MIME

        // Leer el contenido de la imagen (binario)
        $imagen_contenido = file_get_contents($imagen_tmp);

        // 4. Insertar la imagen en la tabla de imagenes_clientes
        $consulta4 = "INSERT INTO imagenes_clientes (id_cliente, nombre, tipo, contenido) 
                      VALUES (:id_cliente, :nombre, :tipo, :contenido)";

        $stmt = $mysqli->prepare($consulta4);

        // Vincular los parámetros
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $imagen_nombre, PDO::PARAM_STR);
        $stmt->bindParam(':tipo', $imagen_tipo, PDO::PARAM_STR);
        $stmt->bindParam(':contenido', $imagen_contenido, PDO::PARAM_LOB);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            ?>
            <script type="text/javascript">
                window.location.href = "index.php";
            </script>
            <?php
        } else {
            echo "Error al subir la imagen.";
        }
    } else {
        echo "Por favor, selecciona una imagen para subir.";
    } 


}

?>
<!--FIN del cont principal-->
<?php require_once "parte_inferior.php"?>