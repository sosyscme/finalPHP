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

// Consulta para obtener los productos de la tabla
$sql = "SELECT * FROM productos";
$result = $conn->query($sql);

// Verificar si se ha enviado el formulario de eliminación
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["eliminar"])) {
  $idProducto = $_POST["eliminar"];

  // Verificar si se confirmó la eliminación
  if ($_POST["confirmacion"] === "si") {
    // Consulta para eliminar el producto de la base de datos
    $sql = "DELETE FROM productos WHERE id = $idProducto";
    
    if ($conn->query($sql) === TRUE) {
      echo "<p class='mensaje-eliminacion'>El producto se eliminó correctamente</p>";
      echo "<script>window.location.href = 'gestion_productos.php';</script>";
    } else {
      echo "Error al eliminar el producto: " . $conn->error;
    }
  }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestión de Productos</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
  <h1 class="mt-4">Gestión de Productos</h1>
  <a href="agregar.php" class="btn btn-primary mb-3">Agregar Nuevo Producto</a>

  <div class="row">
    <?php while ($row = $result->fetch_assoc()) { ?>
      <div class="col-md-4 mb-4">
        <div class="card">
          <img src="data:image/jpeg;base64,<?php echo base64_encode($row['Imagen']); ?>" class="card-img-top product-image" alt="<?php echo $row['Nombre']; ?>">
          <div class="card-body">
            <h5 class="card-title"><?php echo $row['Nombre']; ?></h5>
            <p class="card-text"><?php echo $row['Descripcion']; ?></p>
            <p class="card-text">Precio: <?php echo $row['Precio']; ?></p>
            <div class="btn-group" role="group">
              <a href="modificar_producto.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Modificar</a>
              <form method="POST" action="gestion_productos.php" style="display: inline;">
                <input type="hidden" name="eliminar" value="<?php echo $row['id']; ?>">
                <button type="button" class="btn btn-danger" onclick="confirmarEliminacion(<?php echo $row['id']; ?>)">Eliminar</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

<script>
  function confirmarEliminacion(idProducto) {
    var confirmacion = confirm("¿Estás seguro de que deseas eliminar este producto?");
    if (confirmacion) {
      // Enviar el formulario con la confirmación de eliminación
      var form = document.createElement("form");
      form.method = "POST";
      form.action = "gestion_productos.php";
      form.style.display = "none";

      var inputId = document.createElement("input");
      inputId.type = "hidden";
      inputId.name = "eliminar";
      inputId.value = idProducto;
      form.appendChild(inputId);

      var inputConfirmacion = document.createElement("input");
      inputConfirmacion.type = "hidden";
      inputConfirmacion.name = "confirmacion";
      inputConfirmacion.value = "si";
      form.appendChild(inputConfirmacion);

      document.body.appendChild(form);
      form.submit();
    }
  }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
