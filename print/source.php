<?php 

include'modelo/Conexion.php';

$conexion = new Conexion();
$conexion = $conexion->get_conexion();

//$id = trim($_REQUEST['id']);

try {
	
$query  = "
SELECT 

v.id,
v.producto_id,
v.precio_unidad,
v.cantidad,
v.total,
v.estado,
p.nombre

FROM venta v

INNER JOIN producto p ON v.producto_id=p.id

WHERE v.id=13718";

$statement = $conexion->prepare($query);
//$statement->bindParam(':id',$id);
$statement->execute();

$result  = $statement->fetch(PDO::FETCH_ASSOC);

echo json_encode($result);

} catch (Exception $e) {
	
echo "Error: ".$e->getMessage();

}



 ?>