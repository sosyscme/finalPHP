<?php

// Establecer la conexión a la base de datos
$servername = "localhost";
$username = "cris";
$password = "cris_123";
$dbname = "productos";
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Verificar si se ha enviado el formulario de agregar producto
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
  $nombre = $_POST["nombre"];
  $descripcion = $_POST["descripcion"];
  $precio = $_POST["precio"];
  
  // Verificar si se ha subido una imagen
  if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] === 0) {
    $imagen = $_FILES["imagen"]["tmp_name"];
    $imagenData = file_get_contents($imagen);
    $imagenData = mysqli_real_escape_string($conn, $imagenData);
  }

  // Consulta para agregar el producto a la base de datos
  $sql = "INSERT INTO productos (Nombre, Descripcion, Precio, Imagen) VALUES ('$nombre', '$descripcion', '$precio', '$imagenData')";
  
  if ($conn->query($sql) === TRUE) {
    echo "<p class='mensaje-agregado'>El producto se agregó correctamente</p>";
  } else {
    echo "Error al agregar el producto: " . $conn->error;
  }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agregar Producto</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
  <h1 class="mt-4">Agregar Producto</h1>
  <form method="POST" action="agregar.php" enctype="multipart/form-data">
    <div class="form-group">
      <label for="nombre">Nombre:</label>
      <input type="text" class="form-control" id="nombre" name="nombre" required>
    </div>
    <div class="form-group">
      <label for="descripcion">Descripción:</label>
      <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
    </div>
    <div class="form-group">
      <label for="precio">Precio:</label>
      <input type="number" class="form-control" id="precio" name="precio" required>
    </div>
    <div class="form-group">
      <label for="imagen">Imagen:</label>
      <input type="file" class="form-control-file" id="imagen" name="imagen" required>
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Agregar</button>
  </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
