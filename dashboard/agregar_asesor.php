<?php require_once "parte_superior.php"?>

<!--INICIO del cont principal-->
<div class="animate__animated p-6" :class="[$store.app.animation]">
                    <!-- start main content section -->
                   <div x-data="invoiceAdd">
                            
                        <div class="flex flex-col gap-2.5 xl:flex-row">
                            <div class="panel flex-1 px-0 py-6 ltr:lg:mr-6 rtl:lg:ml-6"> 
                            
                                <h5 class="mb-5 text-lg font-semibold dark:text-white-light" style="padding: 0px 0px 15px 15px;">Agregar Asesor</h5>
                            
                                <div class="flex flex-wrap justify-between px-4">

                            
                                    <div class="mb-6 w-full lg:w-1/2">
                                        
                                        <div class="flex shrink-0 items-center text-black dark:text-white">
                                           <center> <img src="img/progresar_logo.png" alt="image" style="width: 150px;"></center>
                                        </div>

                                        <div class="mt-6 space-y-1 text-gray-500 dark:text-gray-400">
                                            <div>Microfinanciera Progresar Agencia Bambamarca.</div>
                                            <div>Jr. San Carlos 1052</div>
                                        </div>
                                    </div>
                                    <div class="w-full lg:w-1/2 lg:max-w-fit">
                                    <form method="POST" action="" enctype="multipart/form-data">
                                        <div class="flex items-center">
                                            <label for="reciever-name" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Nombres</label>
                                            <input type="text"  class="form-input" name="nombres" required />
                                        </div>
                                        <div class="mt-4 flex items-center">
                                            <label for="reciever-name" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Usuario</label>
                                            <input type="text" class="form-input" name="usuario" required />
                                        </div>
                                        <div class="mt-4 flex items-center">
                                            <label for="reciever-name" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">DNI</label>
                                            <input type="text" class="form-input" name="dni" required />
                                        </div>
                                        <div class="mt-4 flex items-center">
                                            <label for="reciever-name" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Cargo</label>
                                            <select id="cargo" name="cargo" class="form-select" name="cargo">
                                                 <option>Ahorros</option>
                                                 <option>Créditos</option>
                                            </select>
                                        </div>
                                        <div class="mt-4 flex items-center">
                                            <label for="reciever-name" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Fecha de Incorporación</label>
                                            <input id="startDate" type="date" name="incorporacion" class="form-input w-2/3 lg:w-[250px]" x-model="params.invoiceDate">
                                        </div>
                                        <div class="mt-4 flex items-center">
                                            <label for="reciever-name" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Agencia</label>
                                            <select id="agencia" name="agencia" class="form-select" name="agencia">
                                                 <option>Bambamarca</option>
                                                 <option>Chota</option>
                                                 <option>Cajamarca</option>
                                            </select>
                                        </div>
                                        
                                    </div>
                                </div>
                                <hr class="my-6 border-[#e0e6ed] dark:border-[#1b2e4b]">
                                <div class="mt-8 px-4">
                                    <div class="flex flex-col justify-between lg:flex-row">
                                        <div class="mb-6 w-full lg:w-1/2 ltr:lg:mr-6 rtl:lg:ml-6">
                                            <div class="mt-4 flex items-center">
                                                <label for="reciever-name" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">F. de Nacimiento</label>
                                                <input type="date"  class="form-input" name="nacimiento" required />
                                            </div>
                                            <div class="mt-4 flex items-center">
                                                <label for="reciever-name" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Sexo</label>
                                                <select id="sexo" class="form-select" name="sexo">
                                                    <option>Masculino</option>
                                                    <option>Femenino</option>
                                                </select>
                                            </div>
                                            <div class="mt-4 flex items-center">
                                                <label for="swift-code" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Dirección</label>
                                                <input type="text" name="direccion" class="form-input"  />
                                            </div>
                                            <div class="mt-4 flex items-center">
                                                <label for="swift-code" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Contraseña</label>
                                                <input type="password" name="contraseña" class="form-input"  />
                                            </div>
                                        </div>
                                        <div class="w-full lg:w-1/2">
                                            <div class="mt-4 flex items-center">
                                                <label for="iban-code" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Teléfono</label>
                                                <input type="text" name="telefono" class="form-input"  name="telefono" required />
                                            </div>
                                            <div class="mt-4 flex items-center">
                                                <label for="bank-name" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Correo</label>
                                                <input type="text" name="correo" class="form-input" name="correo" />
                                            </div>                                            
                                           <div class="mt-4 flex items-center">
                                                <label for="iban-code" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Foto de perfil</label>
                                                <input type="file" name="imagen" id="imagen">
                                            </div> 
                                            <div class="mt-4 flex items-center">
                                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                            </div>                                           
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>

                            <div class="mt-6 w-full xl:mt-0 xl:w-96">
                                <div class="mt-6 w-full xl:mt-0 xl:w-96">
                                <div class="panel mb-5">
                                    <div class="text-lg font-semibold">Acceso al Sistema</div>
                                    <div>
                                        <label for="reciever-name" class="mb-0 w-1/3 ltr:mr-2 rtl:ml-2">Usuario</label>
                                        <div class="flex flex-1">
                                             <div class="bg-[#eee] flex justify-center items-center ltr:rounded-l-md rtl:rounded-r-md px-3 font-semibold border ltr:border-r-0 rtl:border-l-0 border-[#e0e6ed] dark:border-[#17263c] dark:bg-[#1b2e4b]">@</div>
                                             <input id="actionEmail" type="email" placeholder="" class="form-input ltr:rounded-l-none rtl:rounded-r-none" name="usuario" />
                                        </div>
                                    </div>
                                    <div>
                                        <label for="Txtpassword">Contraseña</label>
                                         <input id="Txtpassword" type="password" placeholder="Agregar contraseña" class="form-input w-3/5" name="password"/>
                                         <span class="text-xs text-white-dark ltr:pl-2 rtl:pr-2">Min 8-12 char</span>
                                    </div>
                                </div>
                            </div>
                                
                                <div class="panel">
                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-1">
                                        <button type="button" class="btn btn-success w-full gap-2" name="enviar">
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end main content section -->

  <?php
    $mysqli = new PDO('mysql:host=localhost;dbname=progresardatos', 'root', '');

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $nombres = $_POST['nombres'];
        $usuario = $_POST['usuario'];
        $dni  = $_POST['dni'];
        $cargo = $_POST['cargo'];  
        $sexo = $_POST['sexo'];
        $incorporacion = $_POST['incorporacion'];
        $nacimiento = $_POST['nacimiento'];
        $agencia = $_POST['agencia'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $direccion = $_POST['direccion'];

        $contraseña = $_POST['contraseña'];
        $password = password_hash($contraseña, PASSWORD_DEFAULT);

        $consulta2 = "INSERT INTO usuarios (usuario,password,nombres,cargo,incorporacion,nacimiento,sexo,correo,telefono,dni,direccion,agencia) VALUES ('$usuario','$password','$nombres','$cargo','$incorporacion','$nacimiento','$sexo','$correo','$telefono','$dni','$direccion','$agencia')";

        $resultado2 = $mysqli->prepare($consulta2);
        $resultado2->execute();

        $consulta3 = "SELECT * FROM usuarios ORDER BY id DESC LIMIT 1";
        $resultado3 = $mysqli->prepare($consulta3);
        $resultado3->execute();
        $data=$resultado3->fetchAll(PDO::FETCH_ASSOC);

        foreach ($data as $row) {
            echo $id_asesor = $row['id'];
        }

        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
                // Obtener los datos de la imagen
                $imagen_tmp = $_FILES['imagen']['tmp_name'];  // archivo temporal
                $imagen_nombre = $_FILES['imagen']['name'];  // nombre original
                $imagen_tipo = $_FILES['imagen']['type'];    // tipo MIME

                // Leer el contenido de la imagen (binario)
                $imagen_contenido = file_get_contents($imagen_tmp);

                // Insertar la imagen en la base de datos
               echo $consulta4 = "INSERT INTO imagenes_asesores (id_asesor ,nombre, tipo, contenido) VALUES ('$id_asesor',:nombre, :tipo, :contenido)";
                $stmt = $conexion->prepare($consulta4);
    
                // Enlace de parámetros
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
</div>
<!--FIN del cont principal-->
<?php require_once "parte_inferior.php"?>