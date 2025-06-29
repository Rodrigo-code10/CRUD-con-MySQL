<?php
require '../db.php';

$cafes=[];
$sql="SELECT id_cafe, nombre_cafe, origen, tipo_lavado, precio_base FROM cafes ORDER BY nombre_cafe";
$res=$conn->query($sql);
if ($res && $res->num_rows>0) {
    while ($row=$res->fetch_assoc()) {
        $cafes[]=$row;
    }
}

$metodos=[];
$sql="SELECT id_metodo, nombre_metodo, descripcion FROM metodos ORDER BY nombre_metodo";
$res=$conn->query($sql);
if ($res && $res->num_rows>0) {
    while ($row=$res->fetch_assoc()) {
        $metodos[]=$row;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_cafe=(int)($_POST['id_cafe'] ?? 0);
    $id_metodo=(int)($_POST['id_metodo'] ?? 0);
    $fecha=$_POST['fecha'] ?? '';
    $precio_total=(float)($_POST['precio_total'] ?? 0);

    if (!$id_cafe||!$id_metodo||!$fecha||!$precio_total) {
        die("Faltan datos o son inválidos.");
    }

    $fecha_sql=date('Y-m-d H:i:s', strtotime(str_replace('T', ' ', $fecha)));

    $stmt=$conn->prepare("
        INSERT INTO ventas (id_cafe,id_metodo,fecha, precio_total)
        VALUES (?, ?, ?, ?)
    ");
    $stmt->bind_param("iisd", $id_cafe,$id_metodo,$fecha_sql,$precio_total);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error al guardar: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Venta</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
  <h1>Registrar nueva venta</h1>

  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Café</label>
      <select name="id_cafe" class="form-select" required>
        <option value="">-- Selecciona un café --</option>
        <?php foreach ($cafes as $cafe): ?>
          <option value="<?= $cafe['id_cafe'] ?>">
            <?= htmlspecialchars("{$cafe['nombre_cafe']} ({$cafe['origen']}, {$cafe['tipo_lavado']}) - \${$cafe['precio_base']}") ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Método</label>
      <select name="id_metodo" class="form-select" required>
        <option value="">-- Selecciona un método --</option>
        <?php foreach ($metodos as $metodo): ?>
          <option value="<?= $metodo['id_metodo'] ?>">
            <?= htmlspecialchars("{$metodo['nombre_metodo']} ({$metodo['descripcion']})") ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Fecha y hora</label>
      <input type="datetime-local" name="fecha" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Precio total</label>
      <input type="number" name="precio_total" step="0.01" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Guardar Venta</button>
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
  </form>
</body>
</html>
