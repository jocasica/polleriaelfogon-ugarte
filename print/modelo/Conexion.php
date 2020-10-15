<?php 


class Conexion{

function get_conexion()
{
    
try

{

$conexion = new PDO(
    
    //Comentar el Driver que no va a utilizar
    
    //Driver MySQL
    "mysql:host=localhost;dbname=pollbquc_pollo",//driver servidor base de datos
    
    //Driver SQLServer
     //"sqlsrv:Server=localhost;database=db_test",//driver servidor base de datos
    
    "pollbquc_alonso",//usuario
    "administrador",//contraseña
array(
PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"//ACTIVAR LA VALIDACIÓN DE CODIFICACIÓN UTF8
)
    
);
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//ACTIVSAR MENSAJES DE ERROR Y EXCEPCIÓN
return $conexion;//RETONAR LA CONEXIÓN


} catch (Exception $e) {
	
  echo "Error: ".$e->getMessage();//SE IMPRIME LOS ERRORES EN PANTALLA
}


}


}


?>