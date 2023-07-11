<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de Usuario</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="registro.css">
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
          <a class="nav-link" href="index.php" style="color: white;">Inicio</a>
        </li>
      </ul>
    </div>
  </nav>
</header>

  <div class="container">
    <h1 class="mt-4">Registro de Usuario</h1>

    <?php
    // Variable para almacenar los mensajes de error
    $errors = [];

    // Verificar si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Validar campos obligatorios
      if (empty($_POST["Nombre"])) {
        $errors[] = "El campo Nombre es obligatorio";
      }

      if (empty($_POST["Apellido"])) {
        $errors[] = "El campo Apellido es obligatorio";
      }

      if (empty($_POST["Email"])) {
        $errors[] = "El campo Correo Electrónico es obligatorio";
      }

      if (empty($_POST["Telefono"])) {
        $errors[] = "El campo Teléfono es obligatorio";
      }

      // Si no hay errores, procesar los datos
      if (empty($errors)) {
        $nombre = $_POST["Nombre"];
        $apellido = $_POST["Apellido"];
        $correo = $_POST["Email"];
        $telefono = $_POST["Telefono"];

       // ...

// Si no hay errores, procesar los datos
if (empty($errors)) {
    $nombre = $_POST["Nombre"];
    $apellido = $_POST["Apellido"];
    $correo = $_POST["Email"];
    $telefono = $_POST["Telefono"];
  
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
  
    // Insertar los datos en la tabla correspondiente
    $sql = "INSERT INTO registro (Nombre, Apellido, Email, Telefono) VALUES ('$nombre', '$apellido', '$correo', '$telefono')";
  
    if ($conn->query($sql) === TRUE) {
      // Redireccionar al usuario a la página de registro exitoso
      header("Location: registro_exitoso.php");
      exit;
    } else {
      echo "Error al guardar los datos en la base de datos: " . $conn->error;
    }
  
    // Cerrar la conexión a la base de datos
    $conn->close();
  }
  
  // ...
  

        // Redireccionar al usuario a otra página después del registro
        header("Location: registro_exitoso.php");
        exit;
      }
    }
    ?>

    <?php if (!empty($errors)) : ?>
      <div class="alert alert-danger">
        <ul>
          <?php foreach ($errors as $error) : ?>
            <li><?php echo $error; ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
      <div class="form-group">
        <label for="Nombre">Nombre *</label>
        <input type="text" class="form-control" id="Nombre" name="Nombre" required>
      </div>

      <div class="form-group">
        <label for="Apellido">Apellido *</label>
        <input type="text" class="form-control" id="Apellido" name="Apellido" required>
      </div>

      <div class="form-group">
        <label for="Email">Correo Electrónico *</label>
        <input type="email" class="form-control" id="Email" name="Email" required>
      </div>

      <div class="form-group">
        <label for="Telefono">Teléfono *</label>
        <input type="text" class="form-control" id="Telefono" name="Telefono" required>
      </div>

      <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
