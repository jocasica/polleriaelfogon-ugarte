<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Producto_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }
  public function getProductos(){
    return $this->db->query("select p.id, p.nombre, u.descripcion unidad_medida, p.stock, p.tipo, p.precio_venta, p.precio_compra,
    p.estado from producto p inner join unidad_medida u on p.unidad_medida_id=u.id");
  }
  public function restarStock($producto_id,$cantidad){
    return $this->db->query("update producto set stock = stock -".$cantidad." where id=".$producto_id);
  }
  public function sumarStock($producto_id,$cantidad){
    return $this->db->query("update producto set stock = stock +".$cantidad." where id=".$producto_id);
  }
  public function getProductoById($id){
    $result =  $this->db->query("select * from producto where id = ".$id." LIMIT 1");
    return $result->row();
  }
  public function editProducto($id,$nombre,$tipo,$precio_venta,$precio_compra,$estado){
    $result =  $this->db->query("update producto set nombre='".$nombre."', tipo='".$tipo."', 
      precio_venta='".$precio_venta."', precio_compra='".$precio_compra."', estado='".$estado."'  where id = ".$id);
    return $result;
  }

  public function getProductosComprobante(){
    return $this->db->query("SELECT (@i := @i + 1) as contador, p.id producto_id, nombre, p.precio_venta, p.unidad_medida_id, um.descripcion unidad_medida  from producto p inner join unidad_medida um on p.unidad_medida_id=um.id cross join (select @i := -1) c");
  }
}