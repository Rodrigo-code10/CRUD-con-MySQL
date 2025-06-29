<?php
require '../db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}

$stmt=$conn->prepare("SELECT * FROM cafes WHERE id_cafe = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result=$stmt->get_result();
$cafe=$result->fetch_assoc();

if(!$cafe) {
   echo "Café no encontrado";
   exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre=$_POST['nombre_cafe'] ?? '';
    $origen=$_POST['origen'] ?? '';
    $tipo=$_POST['tipo_lavado'] ?? '';
    $precio=(float)($_POST['precio_base'] ?? 0);

    $stmt=$conn->prepare("UPDATE cafes SET nombre_cafe = ?, origen = ?, tipo_lavado = ?, precio_base = ? WHERE id_cafe = ?");
    $stmt->bind_param("sssdi", $nombre, $origen, $tipo, $precio, $id);
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
  <meta charset="UTF-8" />
  <title>Editar Café</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body class="container mt-4">
  <h1>Editar Café</h1>
  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Nombre</label>
      <input type="text" name="nombre_cafe" class="form-control" value="<?= htmlspecialchars($cafe['nombre_cafe']) ?>"required>
    </div>
    <div class="mb-3">
      <label class="form-label">Origen</label>
      <input type="text" name="origen" class="form-control" value="<?= htmlspecialchars($cafe['origen']) ?>"required>
    </div>
    <div class="mb-3">
      <label class="form-label">Tipo de lavado</label>
      <input type="text" name="tipo_lavado" class="form-control" value="<?= htmlspecialchars($cafe['tipo_lavado']) ?>"required>
    </div>
    <div class="mb-3">
      <label class="form-label">Precio</label>
      <input type="number" step="0.01" name="precio_base" class="form-control" value="<?= htmlspecialchars($cafe['precio_base']) ?>"required>
    </div>
    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
  </form>
</body>
</html>
