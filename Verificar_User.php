
<?php
include 'conexion.php'; // Incluir el archivo de conexión

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta para verificar el usuario y contraseña
    $sql = "SELECT * FROM usuario WHERE User='$username' AND Pass=SHA2('$password', 256)";
   
    $result = $conn->query($sql);
   
    if ($result->num_rows > 0) {
        // Usuario y contraseña válidos
        $row = $result->fetch_assoc();  // Obtener la fila del resultado
        $Tipo = $row['Tip_User'];

        if ($Tipo === '1') {
            echo '<script language="javascript">';
            echo 'window.location.href = "Ventana_Admin.html";';  
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo 'window.location.href = "Ventana_M.php";';  
            echo '</script>';
        }
    } else {
        echo '<script language="javascript">';
        echo 'alert("Usuario o contraseña incorrecta.");';
        echo 'window.location.href = "index.html";';  
        echo '</script>';
    }
}

$conn->close(); // Cerrar la conexión
?>




