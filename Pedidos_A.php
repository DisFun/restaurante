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
    <p id="fecha"></p>

<script>
    var fechaActual = new Date();
    var dia = fechaActual.getDate();
    var mes = fechaActual.getMonth() + 1;
    var anio = fechaActual.getFullYear();
    
    if (dia < 10) {
        dia = '0' + dia;
    }
    if (mes < 10) {
        mes = '0' + mes;
    }
    
    var fechaFormateada = dia + '/' + mes + '/' + anio;
    
    document.getElementById("fecha").innerHTML = "La fecha de hoy es: " + fechaFormateada;

    function obtenerMesa() {
        var xmlhttp = new XMLHttpRequest();
        var combo = document.getElementById("comboMesa");

        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                combo.innerHTML = xmlhttp.responseText;
            }
        };

        xmlhttp.open("GET", "obtener_mesa.php?Fecha=" + fechaFormateada, true);
        xmlhttp.send();
    }
    
    window.onload = function() {
        obtenerMesa();
    };
</script>

<div class="contenedor1">
    <form action="" method="POST">
        <input type="hidden" name="Fecha" value="<?php echo $fechaFormateada; ?>">
        <h3>Mesa # :</h3>
        <select name="Mesa" id="comboMesa" class="combo-box"></select>
        <button type="submit" value="Enviar">Mostrar Datos</button>
    </form>
</div>


<?php
    $seleccion = isset($_POST['Mesa']) ? $_POST['Mesa'] : null;
?>

<div class="contenedor2">
    <?php
    if ($seleccion) {
        include 'conexion.php';

        $sql = "SELECT platos.Nombre, facturas.Num_Factura 
        FROM platos 
        INNER JOIN factura_plato ON platos.ID_Plato = factura_plato.ID_Plato 
        INNER JOIN facturas ON factura_plato.Num_Factura = facturas.Num_Factura 
        WHERE facturas.Num_Mesa = '$seleccion'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Mostrar los resultados en una tabla
            echo "<table><tr><th>Nombre del Plato</th><th>Número de Factura</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["Nombre"] . "</td><td>" . $row["Num_Factura"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "0 resultados";
        }
        
        $conn->close();
    }
    ?>
</div>
      

</body>
</html>
