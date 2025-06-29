<?php
require "../db.php";
$sql="SELECT * FROM cafes ORDER BY id_cafe";
$result=$conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Lista de Cafés</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
  <h1 class="text-center">
    <img src="/ICONOS/cafe.png" alt="Café" style="width: 40px; height: 40px; vertical-align: middle;">
    Cafés disponibles
  </h1>
  <a href="create.php" class="btn btn-primary mb-3">Agregar café</a>
  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr class="text-center">
        <th>ID</th>
        <th>Nombre</th>
        <th>Origen</th>
        <th>Tipo de lavado</th>
        <th>Precio base</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody class="text-center">
      <?php
        if ($result && $result->num_rows > 0) {
          while ($cafe = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$cafe['id_cafe']}</td>
                    <td>{$cafe['nombre_cafe']}</td>
                    <td>{$cafe['origen']}</td>
                    <td>{$cafe['tipo_lavado']}</td>
                    <td>\${$cafe['precio_base']}</td>
                    <td>
                      <a href='update.php?id={$cafe['id_cafe']}' class='btn btn-warning btn-sm'>Editar</a>
                      <a href='delete.php?id={$cafe['id_cafe']}' class='btn btn-danger btn-sm'>Eliminar</a>
                    </td>
                  </tr>";
          }
        } else {
          echo "<tr><td colspan='6'>No hay cafés registrados.</td></tr>";
        }
      ?>
    </tbody>
  </table>
  <div class="mt-4 text-center">
    <a href="/index.php" class="btn btn-secondary">Volver al inicio</a>
  </div>
</body>
</html>

