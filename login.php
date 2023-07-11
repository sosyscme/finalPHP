<?php
// Verificar si se ha enviado el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["usuario"]) && isset($_POST["contrasena"])) {
  $usuario = $_POST["usuario"];
  $contrasena = $_POST["contrasena"];

  // Verificar las credenciales de acceso (en este caso, usuario y contraseña estáticos)
  if ($usuario === "cris" && $contrasena === "cris_123") {
    // Inicio de sesión exitoso, redirigir a la página "Gestion_productos"
    header("Location: Gestion_productos.php");
    exit();
  } else {
    // Credenciales inválidas, mostrar mensaje de error
    $mensaje_error = "Credenciales inválidas. Inténtalo de nuevo.";
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar sesión</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h1 class="mt-4">Iniciar sesión</h1>
    <?php if (isset($mensaje_error)) { ?>
      <div class="alert alert-danger"><?php echo $mensaje_error; ?></div>
    <?php } ?>
    <form method="POST" action="">
      <div class="form-group">
        <label for="usuario">Usuario:</label>
        <input type="text" class="form-control" id="usuario" name="usuario" required>
      </div>
      <div class="form-group">
        <label for="contrasena">Contraseña:</label>
        <input type="password" class="form-control" id="contrasena" name="contrasena" required>
      </div>
      <button type="submit" class="btn btn-primary">Iniciar sesión</button>
    </form>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
