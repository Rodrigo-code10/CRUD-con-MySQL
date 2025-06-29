<?php
require '../db.php';

$Cafes=[];
$sqlCafes="SELECT id_cafe, nombre_cafe FROM cafes";
$resultCafes=$conn->query($sqlCafes);
if ($resultCafes && $resultCafes->num_rows > 0) {
    while ($cafe=$resultCafes->fetch_assoc()) {
        $Cafes[$cafe['id_cafe']]=$cafe['nombre_cafe'];
    }
}

$Metodos=[];
$sqlMetodos="SELECT id_metodo, nombre_metodo FROM metodos";
$resultMetodos=$conn->query($sqlMetodos);
if ($resultMetodos && $resultMetodos->num_rows > 0) {
    while ($metodo=$resultMetodos->fetch_assoc()) {
        $Metodos[$metodo['id_metodo']]=$metodo['nombre_metodo'];
    }
}

$ventas=[];
$sqlVentas="SELECT * FROM ventas ORDER BY fecha DESC";
$resultVentas=$conn->query($sqlVentas);
if ($resultVentas && $resultVentas->num_rows > 0) {
    while ($venta=$resultVentas->fetch_assoc()) {
        $ventas[]=$venta;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Ventas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
  <h1 class="text-center">
    <img src="/ICONOS/ventas.png" alt="Café" style="width: 40px; height: 40px; vertical-align: middle;">
    Lista de Ventas
  </h1>
  <a href="create.php" class="btn btn-dark mb-3">Agregar venta</a>

  <table class="table table-striped table-bordered text-center">
    <thead class="table-dark">
      <tr>
        <th>Café</th>
        <th>Método</th>
        <th>Fecha</th>
        <th>Precio total</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($ventas)): ?>
        <?php foreach ($ventas as $venta): ?>
          <tr>
            <td><?= $Cafes[$venta['id_cafe']] ?? 'Café eliminado' ?></td>
            <td><?= $Metodos[$venta['id_metodo']] ?? 'Método eliminado' ?></td>
            <td><?= date('Y-m-d H:i', strtotime($venta['fecha'])) ?></td>
            <td>$<?= number_format($venta['precio_total'], 2) ?></td>
            <td>
              <a href="update.php?id=<?= $venta['id_venta'] ?>" class="btn btn-warning btn-sm">Editar</a>
              <a href="delete.php?id=<?= $venta['id_venta'] ?>" class="btn btn-danger btn-sm"
                 onclick="return confirm('¿Eliminar esta venta?');">Eliminar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="5">No hay ventas registradas.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
  <div class="mt-4 text-center">
    <a href="/index.php" class="btn btn-secondary">Volver al inicio</a>
  </div>
</body>
</html>
