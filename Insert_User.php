<?php

include 'conexion.php';
// Obtener datos del formulario
$username = $_POST['username'];
$password = $_POST['password'];
$Tipos = $_POST['Tipos'];
$Tip = 2;
if ($Tipos == Administrador) {
    $Tip = 1;
}
$sql = "SELECT * FROM usuario WHERE User='$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo '<script language="javascript">';
    echo 'alert("Usuario ya existente.");';
    echo 'window.location.href = "index.html";';  
    echo '</script>';
}else{
    // Insertar los datos en la base de datos
    $sql = "INSERT INTO usuario(User,Pass,Tip_User) VALUES ('$username', '$password','$Tip')";

    if ($conn->query($sql) === TRUE) {
        echo '<script language="javascript">';
        echo 'alert("Registro exitoso.");';
        echo 'window.location.href = "index.html";';  
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo 'alert("Datos incorrectos.");';
        echo 'window.location.href = "registro.html";';  
        echo '</script>';
    }
   
}
cerrar($conn);

?>
