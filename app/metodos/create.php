<?php
require '../db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre_metodo'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';

    $stmt=$conn->prepare(
      "INSERT INTO metodos (nombre_metodo, descripcion)
       VALUES (?, ?)"
    );
    $stmt->bind_param("ss", $nombre, $descripcion);

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
  <title>Agregar Metodo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
  <h1>Agregar Metodo</h1>
  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Nombre</label>
      <input type="text" name="nombre_metodo" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Descripcion</label>
      <input type="text" name="descripcion" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
  </form>
</body>
</html>