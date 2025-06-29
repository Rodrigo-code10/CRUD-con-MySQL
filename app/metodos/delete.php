<?php
require '../db.php';

$id=$_GET['id'] ?? null;
if($id){
    $stmt=$conn->prepare("DELETE FROM metodos WHERE id_metodo = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}
header("Location: index.php");
exit();