<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="Estilos2.css">
</head>
<body>

    <nav class="navbar">
        <div class="navbar-left">
            <img src="img/bandera.png" alt="ll" class="imagen">
            <a href="Ventana_M.php">Menu</a>
            <a href="Pedidos_A.php">Pedidos Activos</a>
            <a href="pedidos_C.php">Pedidos Canselados</a>
          </div>
        <div class="navbar-right">
          <button class="toggle-button">&#9776;</button>
          
          <a href="index.html">Cerrar Sesion</a>
        </div>
        
      </nav>
      <div class="table-container">
        <table class="styled-table">
          <tr>
            <th>ID_Plato</th>
            <th>Nombre</th>
            <th>Acompañamiento</th>
            <th>Precio</th>
          </tr>

          <?php

            include 'conexion.php';

            $sql = "SELECT ID_Plato, Nombre, Acompañamiento,ID_precio FROM platos";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              // Mostrar los datos en una tabla
              while($row = $result->fetch_assoc()) {
                
                $id_precio = $row["ID_precio"];
                $sql_precio = "SELECT Precio FROM precios WHERE ID_Precio =' $id_precio'";
                $result_precio = $conn->query($sql_precio);
            
                if ($result_precio->num_rows > 0) {
                  $row_precio = $result_precio->fetch_assoc();
                  $precio = $row_precio["Precio"];
                } else {
                  $precio = "No disponible";
                }
                echo "<tr><td>" . $row["ID_Plato"] . "</td><td>" . $row["Nombre"] . "</td><td>" . $row["Acompañamiento"] . "</td><td>" . $precio . "</td></tr>";
                
              }
            } else {
              echo "No se encontraron resultados.";
            }
            
            $sql_b = "SELECT ID_BP,Nombre,ID_Precio FROM bebida_postre";
            $result_b = $conn->query($sql_b);

            if ($result_b->num_rows > 0) {
             
              // Mostrar los datos en una tabla
            
              while($row = $result_b->fetch_assoc()) {
                $id_precio = $row["ID_Precio"];
                $sql_precio = "SELECT Precio FROM precios WHERE ID_Precio =' $id_precio'";
                $result_precio = $conn->query($sql_precio);
            
                if ($result_precio->num_rows > 0) {
                  $row_precio = $result_precio->fetch_assoc();
                  $precio = $row_precio["Precio"];
                } else {
                  $precio = "No disponible";
                }
                echo "<tr><td>" . $row["ID_BP"] . "</td><td>" . $row["Nombre"] . "</td><td>" ."---". "</td><td>" . $precio . "</td></tr>";
                
              }
            } else {
              echo "No se encontraron resultados.";
            }

            $conn->close();
            
            ?>
          </table>
      </div>

</body>
</html>


