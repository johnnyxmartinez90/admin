<?php require_once "parte_superior.php"?>
<style type="text/css">
    .fom-cht39 {
        border: 1px solid gainsboro;
        padding: 15px;
        border-radius: 8px;
    }
    .sho-mes89 {
        border: 1px solid gainsboro;
        border-radius: 8px;
        padding: 15px;
    }
</style>
<?php
// Start the session to access session variables

// Check if the session contains user data
if (isset($_SESSION['s_usuario']) && is_array($_SESSION['s_usuario'])) {
    // If 's_usuario' contains user data as an array, we can use it directly
    $user = $_SESSION['s_usuario'];
} else if (isset($_SESSION['s_usuario']) && is_string($_SESSION['s_usuario'])) {
    // If 's_usuario' is just a username (string), fetch user ID from the database
    $username = $_SESSION['s_usuario'];
    
    // Establish a database connection
    $conn = new mysqli("localhost", "root", "", "progresardatos");

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to get user ID based on the username
    $stmt = $conn->prepare("SELECT id, usuario FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $username); // Bind username to query
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // If user exists, fetch the user data
        $user_data = $result->fetch_assoc();
        // Save the user data in session
        $_SESSION['s_usuario'] = $user_data;
        $user = $user_data;
    } else {
        echo "User not found in the database.";
        exit;
    }

    $conn->close();
} else {
    echo "Session is not properly initialized.";
    exit;
}

// Check if 'id_rec' is passed in the form submission
if (!isset($_POST['id_rec']) || !is_numeric($_POST['id_rec'])) {
    echo "Recipient ID not specified or invalid.";
    exit;
}

$id_rec = $_POST['id_rec']; // The recipient's ID passed in the form

// Establishing the database connection again for message retrieval
$conn = new mysqli("localhost", "root", "", "progresardatos");

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission for sending a new message
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $message = $_POST['message'];
    $image = null;

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = file_get_contents($_FILES['image']['tmp_name']); // Read the image file
    }

    // Insert the new message into the database
    $stmt = $conn->prepare("INSERT INTO messages (id_send, id_receive, message, image, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("iiss", $user['id'], $id_rec, $message, $image);

    if ($stmt->execute()) {
    } else {
        echo "<p>Error sending message: " . $stmt->error . "</p>";
    }
}

// Fetch messages between the logged-in user and the recipient
$sql = "SELECT messages.*, usuarios.usuario FROM messages
        INNER JOIN usuarios ON usuarios.id = messages.id_send
        WHERE (messages.id_send = ? AND messages.id_receive = ?) 
        OR (messages.id_send = ? AND messages.id_receive = ?)
        ORDER BY messages.created_at ASC";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

// Bind parameters for the query
$stmt->bind_param("iiii", $user['id'], $id_rec, $id_rec, $user['id']); // Bind parameters with correct data
$stmt->execute();
$result = $stmt->get_result();
?>  
    <br>
    <div class="fom-cht39">
    <h3>Enviar Mensaje</h3>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_rec" value="<?php echo $id_rec; ?>">
        <textarea name="message" rows="4" cols="50" placeholder="Escribe tu mensaje aquí..." required></textarea><br><br>
        <label for="image">Subir imagen (opcional):</label>
        <input type="file" name="image" id="image" accept="image/*"><br><br>
        <button type="submit">Enviar Mensaje</button>
    </form>
    </div>
    <!-- Display chat messages -->
    <div class="sho-mes89">
        <h3>Conversación</h3>
        <?php
        // Check if any messages exist
        if ($result->num_rows > 0) {
            // Loop through each message and display it
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="message">
                    <strong><?php echo htmlspecialchars($row['usuario']); ?>:</strong> 
                    <?php echo nl2br(htmlspecialchars($row['message'])); ?><br>
                    <?php if ($row['image']) { ?>
                        <!-- Display the image if it exists -->
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($row['image']); ?>"><br>
                    <?php } ?>
                    <small><?php echo $row['created_at']; ?></small>
                </div> 
            <?php 
            }
        } else {
            echo "<p>No messages found.</p>";
        }
        ?>
    </div>

    <!-- Form to send a new message -->

<?php
// Close the connection
$conn->close();
?>
<?php require_once "parte_inferior.php"?>