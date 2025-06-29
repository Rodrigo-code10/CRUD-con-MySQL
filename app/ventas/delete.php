<?php
require '../db.php';

$id=$_GET['id'] ?? null;
if($id){
    $stmt=$conn->prepare("DELETE FROM ventas WHERE id_venta = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}
header("Location: index.php");
exit();