<?php
// obtener_mesa.php
if(isset($_GET['Fecha'])) {
    $fechaFormateada = $_GET['Fecha'];

    // Realiza la validación o consulta en la base de datos utilizando $fechaFormateada
    // Por ejemplo, aquí se puede realizar una consulta SQL para obtener las opciones del combo box

    include 'conexion.php';

    $sql = "SELECT Num_Mesa FROM facturas JOIN forma_pago ON facturas.ID_Forma_Pago = forma_pago.ID_Pago WHERE forma_pago.ID_Pago = 6 AND Fecha = '$fechaFormateada'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<option value='" . $row["Num_Mesa"] . "'>" . $row["Num_Mesa"] . "</option>";
        }
    } else {
        echo "<option value=''>No hay resultados</option>";
    }

    $conn->close();
}
?>