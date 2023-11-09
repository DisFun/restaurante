<?php

include 'conexion.php';

$sql = "SELECT ID_Plato, Nombre, Acompañamiento FROM platos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Mostrar los datos en una tabla
  echo "<table border='1'>";
  echo "<tr><th>Acompañamiento</th><th>ID_Plato</th><th>Nombre</th></tr>";

  while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["ID_Plato"]. "</td><td>" . $row["Nombre"]. "</td><td>" . $row["Acompañamiento"]. "</td></tr>";
  }
  echo "</table>";
} else {
  echo "No se encontraron resultados.";
}

$conn->close();

?>