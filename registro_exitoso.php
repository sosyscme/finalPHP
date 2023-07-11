<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro Exitoso</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    .success-message {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
      font-size: 30px;
      color: white;
      background-color: #28a745;
    }
    .btn-home {
      margin-top: 20px;
    }
  </style>
  <script>
    var count = 10;
    var countdown = setInterval(function() {
      document.getElementById("countdown").innerHTML = count;
      count--;
      if (count < 0) {
        clearInterval(countdown);
        window.location.href = "index.php";
      }
    }, 1000); 
  </script>
</head>
<body>

  <div class="success-message">
    <h1>Registro Exitoso</h1>
    <p>Redireccionando a la página principal en <span id="countdown">10</span> segundos...</p>
    <a href="index.php" class="btn btn-primary btn-home">Volver a la página principal</a>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
