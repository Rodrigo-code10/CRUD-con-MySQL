<?php
require '../db.php';

$id=$_GET['id'] ?? null;
if($id){
    $stmt=$conn->prepare("DELETE FROM cafes WHERE id_cafe = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}
header("Location: index.php");
exit();