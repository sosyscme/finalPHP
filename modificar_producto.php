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

// Verificar si se ha enviado el formulario de modificación
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idProducto = $_POST["id"];
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];

    // Verificar si se cargó una nueva imagen
    if (!empty($_FILES["imagen"]["tmp_name"])) {
        // Obtener información del archivo de imagen
        $imagen = $_FILES["imagen"]["tmp_name"];
        $imagenNombre = $_FILES["imagen"]["name"];
        $imagenTipo = $_FILES["imagen"]["type"];

        // Leer el contenido del archivo de imagen
        $imagenContenido = file_get_contents($imagen);

        // Actualizar el producto en la base de datos, incluyendo la imagen
        $sql = "UPDATE productos SET Nombre = ?, Descripcion = ?, Precio = ?, Imagen = ? WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $nombre, $descripcion, $precio, $imagenContenido, $idProducto);

        if ($stmt->execute()) {
            // Redirigir al usuario a la página de Gestion_productos
            header("Location: Gestion_productos.php");
            exit();
        } else {
            echo "Error al actualizar el producto: " . $conn->error;
        }
    } else {
        // Actualizar el producto en la base de datos sin modificar la imagen
        $sql = "UPDATE productos SET Nombre = ?, Descripcion = ?, Precio = ? WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $nombre, $descripcion, $precio, $idProducto);

        if ($stmt->execute()) {
            // Redirigir al usuario a la página de Gestion_productos
            header("Location: Gestion_productos.php");
            exit();
        } else {
            echo "Error al actualizar el producto: " . $conn->error;
        }
    }
}

// Obtener el ID del producto a modificar desde la URL
$idProducto = $_GET["id"];

// Consulta para obtener los datos del producto
$sql = "SELECT * FROM productos WHERE ID = $idProducto";
$result = $conn->query($sql);

// Verificar si se encontró el producto
if ($result && $result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $nombre = $row["Nombre"];
    $descripcion = $row["Descripcion"];
    $precio = $row["Precio"];
    $imagenContenido = $row["Imagen"];
} else {
    echo "No se encontró el producto";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modificar Producto</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <h1>Modificar Producto</h1>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo $idProducto; ?>">
      <div>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $nombre; ?>">
      </div>
      <div>
        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion"><?php echo $descripcion; ?></textarea>
      </div>
      <div>
        <label for="precio">Precio:</label>
        <input type="text" name="precio" value="<?php echo $precio; ?>">
      </div>
      <div>
        <label for="imagen">Imagen:</label>
        <input type="file" name="imagen">
      </div>
      <div>
        <label>Imagen Actual:</label><br>
        <img src="data:image/jpeg;base64,<?php echo base64_encode($imagenContenido); ?>" alt="Imagen actual" height="200">
      </div>
      <button type="submit">```php
Guardar
      </button>
    </form>
  </div>
</body>
</html>
