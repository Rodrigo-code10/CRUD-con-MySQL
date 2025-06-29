<?php
require '../db.php';
$sql = "SELECT * FROM metodos ORDER BY id_metodo";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Lista de Metodos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
  <h1 class="text-center">
    <img src="/ICONOS/metodo.png" alt="Método" style="width: 40px; height: 40px; vertical-align: middle;">
    Métodos disponibles
  </h1>
  <a href="create.php" class="btn btn-success mb-3">Agregar método</a>
  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr class="text-center">
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody class="text-center">
      <?php
        if ($result && $result->num_rows > 0) {
          while ($metodo = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$metodo['id_metodo']}</td>
                    <td>{$metodo['nombre_metodo']}</td>
                    <td>{$metodo['descripcion']}</td>
                    <td>
                      <a href='update.php?id={$metodo['id_metodo']}' class='btn btn-warning btn-sm'>Editar</a>
                      <a href='delete.php?id={$metodo['id_metodo']}' class='btn btn-danger btn-sm'>Eliminar</a>
                    </td>
                  </tr>";
          }
        } else {
          echo "<tr><td colspan='4'>No hay métodos registrados.</td></tr>";
        }
      ?>
    </tbody>
  </table>
  <div class="mt-4 text-center">
    <a href="/index.php" class="btn btn-secondary">Volver al inicio</a>
  </div>
</body>
</html>
