<!DOCTYPE html>
<html>
<head>
  <title>Figuras disponibles</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="figuras.css">
</head>
<body>
 
  <header>
  <nav class="navbar navbar-expand-lg" style="background-color: black;">
    <div class="navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="nosotros.php" style="color: white;">Nosotros</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="producto.php" style="color: white;">Figuras</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="registro.php" style="color: white;">Registro</a>
        </li>
      </ul>
    </div>
  </nav>
</header>

  <div class="container">
    <div class="row">
      <?php
      // Conexión a la base de datos
      $servername = "localhost";
      $username = "cris";
      $password = "cris_123";
      $dbname = "productos";
      $conn = new mysqli($servername, $username, $password, $dbname);

      // Verificar la conexión
      if ($conn->connect_error) {
          die("Error de conexión a la base de datos: " . $conn->connect_error);
      }

      // Consulta para obtener los productos
      $sql = "SELECT * FROM productos";
      $result = $conn->query($sql);

      // Recorrer los resultados y mostrar los productos
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $nombre = $row["Nombre"];
            $descripcion = $row["Descripcion"];
            $precio = $row["Precio"];
            $imagenData = $row["Imagen"];

            // Generar el HTML para cada producto
            echo "<div class='col-md-6'>";
            echo "<div class='product'>";
            echo "<img src='data:image/jpeg;base64," . base64_encode($imagenData) . "' alt='$nombre' class='product-image'>";
            echo "<h2 class='product-title'>$nombre</h2>";
            echo "<p class='product-description'>$descripcion</p>";
            echo "<p class='product-price'>Precio: $precio</p>";
            echo "</div>";
            echo "</div>";
        }
      } else {
        echo "<div class='col-md-12'>";
        echo "<p class='text-center'>No se encontraron productos.</p>";
        echo "</div>";
      }

      // Cerrar la conexión a la base de datos
      $conn->close();
      ?>
    </div>
  </div>

 
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
</body>
</html>