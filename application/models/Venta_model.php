<?php
class Venta_model extends CI_Model
{
  // OBTENCION DE DATOS
  public function getProductos()
  {
    return $this->db->query("select * from producto order by orden");
  }
  public function getInsumos()
  {
    return $this->db->query("select * from insumo");
  }
  public function getItemPollo()
  {
    return $this->db->query("select * from registro_item where fecha='".date('Y-m-d')."'");
  }
  public function getRegistroItemPolloHoy()
  {
    $result = $this->db->query("select * from registro_item where fecha='".date('Y-m-d')."' LIMIT 1");
    return $result->row();
  }
  public function getItems()
  {
    return $this->db->query("select * from item where id <> 1");
  }
  public function getComprasInsumos()
  {
    return $this->db->query("select c.id, c. fecha, sum(ci.total) total from compra c inner join compra_insumo ci on ci.compra_id=c.id group by c.id"); 
  }
  public function getComprasItems()
  {
    return $this->db->query("select c.id, c. fecha, sum(ci.total) total from compra c inner join compra_item ci on ci.compra_id=c.id group by c.id");
  }
  public function getVentas()
  {
    return $this->db->query("select v.id, v.created_at, p.nombre, precio_unidad, cantidad, total from venta v inner join producto p on v.producto_id=p.id where v.estado = 1 order by v.created_at desc LIMIT 150");
  }
  public function getCompras()
  {
    return $this->db->query("select * from compra"); 
  }
  public function getDatosTicket($venta_id){
    $result = $this->db->query("select v.id, p.categoria, v.cantidad, p.nombre, v.precio_unidad, v.total, v.created_at from venta v inner join producto p on p.id=v.producto_id WHERE v.id=".$venta_id);
    return $result->row();
  }
  public function getPrecioProducto($id){
    $result = $this->db->query("select precio from producto where id=".$id);
    return $result->row()->precio;
  }
  public function sumarStockInsumo($insumo_id, $cantidad)
  {
    return $this->db->query("update insumo set stock=stock+".$cantidad." where id=".$insumo_id);
  }
  public function getVentaDiaria($fecha)
  {
    return $this->db->query("select v.id, '' mozo, '' numero_mesa,p.nombre,v.cantidad,v.precio_unidad,v.total,v.created_at from venta v inner join producto p on p.id=v.producto_id where v.estado=1 and v.created_at>'".$fecha." 08:00:00' and v.created_at<=CONCAT(DATE_ADD('".$fecha."',INTERVAL 1 DAY),' 07:00:00') order by v.id");
  }
  public function getVentaDiariaTicket($fecha)
  {
    return $this->db->query("select p.nombre,sum(v.cantidad) cantidad, v.precio_unidad, v.total from venta v inner join producto p on p.id=v.producto_id where v.estado=1 and v.created_at>'".$fecha." 08:00:00' and v.created_at<=CONCAT(DATE_ADD('".$fecha."',INTERVAL 1 DAY),' 07:00:00') group by p.id");
  }
  public function getVentaTotalDiaria($fecha)
  {
    $result = $this->db->query("select sum(v.total) venta_total from venta v inner join producto p on p.id=v.producto_id where v.estado=1 and v.created_at>'".$fecha." 08:00:00' and v.created_at<=CONCAT(DATE_ADD('".$fecha."',INTERVAL 1 DAY),' 07:00:00') order by v.id");
    return $result->row();
  }
  
  public function getPollosVendidos($fecha)
  {
    $result = $this->db->query("select sum(p.cantidad_pollo*v.cantidad) cantidad from venta v inner join producto p on p.id=v.producto_id where v.estado=1 and v.created_at>'".$fecha." 08:00:00' and v.created_at<=CONCAT(DATE_ADD('".$fecha."',INTERVAL 1 DAY),' 07:00:00')");
    return $result->row();
  }
  public function getRegistroPollo($fecha)
  {
    $result = $this->db->query("select sum(cantidad) cantidad from registro_item where item_id=1 and fecha='".$fecha."'");
    return $result->row();
  }
  // INSERCION
  public function crearRegistroItem($ir)
  {
    return $this->db->insert("registro_item",$ir);
  }
  public function crearInsumo($i)
  {
    return $this->db->insert("insumo",$i);
  }
  public function crearVenta($venta){
    $this->db->insert('venta',$venta);
    $insert_id = $this->db->insert_id();
    return $insert_id;
  }
  public function crearCompra($compra){
    $this->db->insert('compra',$compra);
    $insert_id = $this->db->insert_id();
    return $insert_id;
  }
  public function crearCompraInsumo($ci){
    $re = $this->db->insert_batch('compra_insumo',$ci);
    return $re;
  }
  public function crearCompraItem($ci){
    $re = $this->db->insert_batch('compra_item',$ci);
    return $re;
  }


  // ACTUALIZACION

  public function sumarStockItem($item_id,$cantidad){
  return $this->db->query("update item set stock = stock +".$cantidad." where id=".$item_id);
  }
  public function restarStockItem($item_id,$cantidad){
  return $this->db->query("update item set stock = stock -".$cantidad." where id=".$item_id);
  }

}