<?php
require '../db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}

$sql="SELECT * FROM ventas WHERE id_venta = ?";
$stmt=$conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$res=$stmt->get_result();
$venta=$res->fetch_assoc();

if (!$venta) {
    echo "Venta no encontrada.";
    exit;
}

$cafes=[];
$sql="SELECT id_cafe, nombre_cafe, origen, tipo_lavado, precio_base FROM cafes ORDER BY nombre_cafe";
$res=$conn->query($sql);
if ($res && $res->num_rows > 0) {
    while ($row=$res->fetch_assoc()) {
        $cafes[]=$row;
    }
}

// Traer métodos
$metodos=[];
$sql="SELECT id_metodo, nombre_metodo, descripcion FROM metodos ORDER BY nombre_metodo";
$res=$conn->query($sql);
if ($res && $res->num_rows > 0) {
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

    $fecha_sql=date('Y-m-d H:i:s', strtotime(str_replace('T',' ', $fecha)));

    $stmt = $conn->prepare("
        UPDATE ventas
        SET id_cafe=?,id_metodo=?,fecha=?,precio_total=?
        WHERE id_venta=?
    ");
    $stmt->bind_param("iisdi",$id_cafe,$id_metodo,$fecha_sql,$precio_total,$id);

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
  <title>Editar Venta</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
  <h1>Editar Venta</h1>

  <form method="POST">
    <div class="mb-3">
      <label for="id_cafe" class="form-label">Café</label>
      <select name="id_cafe" id="id_cafe" class="form-select" required>
        <option value="">-- Selecciona un café --</option>
        <?php foreach ($cafes as $cafe): ?>
          <option value="<?= $cafe['id_cafe'] ?>"
            <?= $venta['id_cafe'] == $cafe['id_cafe'] ? 'selected' : '' ?>>
            <?= htmlspecialchars("{$cafe['nombre_cafe']} ({$cafe['origen']}, {$cafe['tipo_lavado']}) - \${$cafe['precio_base']}") ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="id_metodo" class="form-label">Método</label>
      <select name="id_metodo" id="id_metodo" class="form-select" required>
        <option value="">-- Selecciona un método --</option>
        <?php foreach ($metodos as $metodo): ?>
          <option value="<?= $metodo['id_metodo'] ?>"
            <?= $venta['id_metodo'] == $metodo['id_metodo'] ? 'selected' : '' ?>>
            <?= htmlspecialchars("{$metodo['nombre_metodo']} ({$metodo['descripcion']})") ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Fecha y hora</label>
      <input type="datetime-local" name="fecha" class="form-control"
        value="<?= date('Y-m-d\TH:i', strtotime($venta['fecha'])) ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Precio total</label>
      <input type="number" step="0.01" name="precio_total"
             class="form-control" value="<?= $venta['precio_total'] ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
  </form>
</body>
</html>
