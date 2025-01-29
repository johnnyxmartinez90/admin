<?php require_once "parte_superior.php"?>

<!--INICIO del cont principal-->
<?php
include_once 'bd/conexion.php';

$objeto = new Conexion();
$conexion = $objeto->Conectar();

$mysqli = new PDO('mysql:host=localhost;dbname=progresardatos', 'root', '');

$user = $_SESSION["s_usuario"];

// Consulta SQL para obtener el usuario (ajusta según tu lógica)
$sql = "SELECT id, nombres, cargo FROM usuarios WHERE usuario = '$user'";

$resultado = $mysqli->prepare($sql);
$resultado->execute();
$data = $resultado->fetchAll(PDO::FETCH_ASSOC);
foreach ($data as $row) { 
    $id_asesor = $row['id'];
}

$sql2 = "SELECT * FROM usuarios WHERE id <> '$id_asesor'";

$resultado2 = $mysqli->prepare($sql2);
$resultado2->execute();
$data_user = $resultado2->fetchAll(PDO::FETCH_ASSOC);
?>
<style>
        #chat-box {
            max-height: 300px;
            overflow-y: scroll;
            margin-bottom: 15px;
        }
        .sent {
            text-align: right;
            background-color: #0d6efd;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin: 5px;
        }
        .received {
            text-align: left;
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
            margin: 5px;
        }
        #messageInput {
            width: 100%;
        }

        .col.col-left {
            max-width: 38%;
            background: white;
            padding: 1rem;
            border-radius: 8px;
        }
        .col.col-right.chat-box {
            background: white;
            padding: 1rem;
            border-radius: 8px;
            margin-left: 2%;
        }   
        p.mb-1.font-semibold {
            padding: 8px 0;
        }

    </style>

<div class="animate__animated p-6" :class="[$store.app.animation]">
    <div class="container text-center">
        <div class="row chat-content">
            <div class="col col-left">
                <div class="diver-chat">
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
                    ?>
                    <p style="text-align: center;">
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($row['contenido']); ?>" alt="image" class="mx-auto h-20 w-20 rounded-full object-cover md:h-32 md:w-32">
                    </p>
                    <?php foreach ($data as $row) { ?>
                    <p class="mb-1 font-semibold"><?php echo $row['nombres']; ?></p>
                    <p class="text-xs text-white-dark"><b>Cargo: </b><?php echo $row['cargo']; ?></p>
                    <?php } ?>
                </div>

                <div class="diver-chat">
                    <ul>
                        <?php foreach ($data_user as $row) { ?>
                        <li>
                            <!-- Usamos un formulario con un ID único basado en el ID del usuario -->
                            <form class="myForm" data-user-id="<?php echo $row['id']; ?>">
                                <input type="hidden" name="name" value="<?php echo $row['nombres']; ?>" required>
                                <button type="submit"><?php echo $row['nombres']; ?></button>
                            </form>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>

            <!-- Se crean divs separados para cada usuario, donde se mostrará el contenido -->
            <div class="col col-right chat-box">
                <?php foreach ($data_user as $row) { ?>
                <div id="formContent-<?php echo $row['id']; ?>" class="formContent" style="display: none;">
                    <p><strong>Nombre:</strong> <span id="outputName-<?php echo $row['id']; ?>"></span></p>
                    <?php 

                        echo $id1 = $row['id']; echo "<br>";
                        echo $user = $_SESSION["s_usuario"]; echo "<br>";

                        echo$sql3 = "SELECT * FROM usuarios WHERE usuario = '$user'";

                        $resultado3 = $conexion->prepare($sql3);
                        $resultado3->execute();
                        $data1=$resultado3->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($data1 as $row1) {
                            $sender_id = $row1['id'];
                        }
                        

                        $sql4 = "SELECT * FROM usuarios WHERE id = '$id1'";

                        $resultado4 = $conexion->prepare($sql4);
                        $resultado4->execute();
                        $data2=$resultado4->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($data2 as $row2) {
                            $receiver_id = $row2['id'];
                        }
                        

                        $sql = "SELECT * FROM messages WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?) ORDER BY sent_at ASC";
                        $stmt = $mysqli->prepare($sql);
                        $stmt->execute([$sender_id, $receiver_id, $receiver_id, $sender_id]);
                        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($messages as $message) {
                        // Si el mensaje fue enviado por el usuario actual
                        if ($message['sender_id'] == $sender_id) {
                            echo "<div class='sent'>{$message['message']}</div>";
                        } else {
                            echo "<div class='received'>{$message['message']}</div>";
                        }
                        }

                    ?>
                    <form method="POST">
    <!-- Incluye los IDs del remitente y receptor en campos ocultos -->
    <input type="text" name="sender_id" value="<?php echo $sender_id; ?>">
    <input type="text" name="receiver_id" value="<?php echo $receiver_id; ?>">
    <input type="text" id="messageInput" name="message" class="form-control" placeholder="Escribe un mensaje..." required>
    <button type="submit" class="btn btn-primary mt-2">Enviar</button>
</form>

                    <?php 
                    // Asegurarnos de que se ha enviado un mensaje
                    // Asegurémonos de que se ha enviado un mensaje
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['message'])) {
    // Obtener el sender_id y receiver_id del formulario
    $sender_id = $_POST['sender_id'];
    $receiver_id = $_POST['receiver_id'];
    $message = $_POST['message'];

    // Insertar el mensaje en la base de datos solo si se envió el formulario
    //$sql = "INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)";
    //$stmt = $mysqli->prepare($sql);
    //$stmt->execute([$sender_id, $receiver_id, $message]);
}

                    ?>
                </div>
                <?php } 
                    

                ?>

            </div>

        </div>
    </div>
</div>

<script>
    // Seleccionamos todos los formularios con la clase 'myForm'
    const forms = document.querySelectorAll(".myForm");
    
    // Escuchamos el evento de envío de cada formulario
    forms.forEach(form => {
        form.addEventListener("submit", function(event) {
            event.preventDefault();  // Evita que el formulario se envíe y recargue la página

            // Obtenemos el nombre desde el valor del input
            const name = form.querySelector('input[name="name"]').value;

            // Obtenemos el ID del usuario desde el atributo 'data-user-id'
            const userId = form.getAttribute('data-user-id');

            // Asignamos el valor del nombre al correspondiente div de salida
            document.getElementById("outputName-" + userId).textContent = name;

            // Ocultamos todos los divs
            const allFormContents = document.querySelectorAll(".formContent");
            allFormContents.forEach(content => content.style.display = "none");

            // Mostramos solo el div correspondiente
            document.getElementById("formContent-" + userId).style.display = "block";
        });
    });
</script>

<!--FIN del cont principal-->
<?php require_once "parte_inferior.php"?>
