<?php
require '../db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php");
    exit;
}

$stmt=$conn->prepare("SELECT * FROM metodos WHERE id_metodo = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result=$stmt->get_result();
$metodos=$result->fetch_assoc();

if(!$metodos) {
   echo "Metodo no encontrado";
   exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre=$_POST['nombre_metodo'] ?? '';
    $descripcion=$_POST['descripcion'] ?? '';

    $stmt=$conn->prepare("UPDATE metodos SET nombre_metodo = ?, descripcion = ? WHERE id_metodo = ?");
    $stmt->bind_param("ssi", $nombre, $descripcion, $id);
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
  <title>Editar Metodo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body class="container mt-4">
  <h1>Editar Metodo</h1>
  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Nombre</label>
      <input type="text" name="nombre_metodo" class="form-control" value="<?= htmlspecialchars($metodos['nombre_metodo']) ?>"required>
    </div>
    <div class="mb-3">
      <label class="form-label">Descripcion</label>
      <input type="text" name="descripcion" class="form-control" value="<?= htmlspecialchars($metodos['descripcion']) ?>"required>
    </div>
    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="index.php" class="btn btn-secondary">Cancelar</a>
  </form>
</body>
</html>
