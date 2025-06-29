<?php
require '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre=$_POST['nombre_cafe'] ?? '';
    $origen=$_POST['origen'] ?? '';
    $tipo_lavado=$_POST['tipo_lavado'] ?? '';
    $precio_base=(float)$_POST['precio_base'] ?? 0;

    $stmt=$conn->prepare(
      "INSERT INTO cafes (nombre_cafe, origen, tipo_lavado, precio_base)
       VALUES (?, ?, ?, ?)"
    );
    $stmt->bind_param("sssd", $nombre, $origen, $tipo_lavado, $precio_base);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
  }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Agregar Café</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
  <h1>Agregar Café</h1>
  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Nombre</label>
      <input type="text" name="nombre_cafe" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Origen</label>
      <input type="text" name="origen" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Tipo de lavado</label>
      <input type="text" name="tipo_lavado" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Precio base</label>
      <input type="number" step="0.01" name="precio_base" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
  </form>
</body>
</html>