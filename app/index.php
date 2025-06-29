<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Inicio | Cafetería</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
  <h1 class="mb-4 text-center">
    <img src="/ICONOS/cafeteria.png" alt="Café" style="width: 40px; height: 40px; vertical-align: middle;">
    Sistema de Cafetería
  </h1> 
  <h6 class="mb-4 text-center"> "Elaborado con SQL"</h6>
  <div class="d-flex flex-column align-items-center gap-3">
    <div class="col-md-4">
      <div class="card border-primary mb-3">
        <div class="card-body text-center">
          <h5 class="card-title">
            <img src="/ICONOS/cafe.png" alt="Café" style="width: 40px; height: 40px; vertical-align: middle;">
            Cafés
          </h5>
          <p class="card-text">Consulta, agrega y edita cafés disponibles.</p>
          <a href="cafes/index.php" class="btn btn-primary">Ver Cafés</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card border-success mb-3">
        <div class="card-body text-center">
          <h5 class="card-title">
            <img src="/ICONOS/metodo.png" alt="Café" style="width: 40px; height: 40px; vertical-align: middle;">
            Métodos
          </h5>
          <p class="card-text">Gestiona los métodos de preparación de café.</p>
          <a href="metodos/index.php" class="btn btn-success">Ver Métodos</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card border-dark mb-3">
        <div class="card-body text-center">
          <h5 class="card-title">
            <img src="/ICONOS/ventas.png" alt="Café" style="width: 40px; height: 40px; vertical-align: middle;">
            Ventas
          </h5>
          <p class="card-text">Registra y visualiza ventas realizadas.</p>
          <a href="ventas/index.php" class="btn btn-dark">Ver Ventas</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
