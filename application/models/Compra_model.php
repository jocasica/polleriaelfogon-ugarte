<?php


class Compra_model extends CI_Model
{
  public function getCompras(){
    return $this->db->query("select c.id, c.serie, c.numero, c.fecha, sum(total) total, c.estado from compra c inner join compra_producto cp on c.id=cp.compra_id group by (c.id) order by c.created_at desc;");
  }
  public function crearCompra($compra){
    $this->db->insert('compra',$compra);
    $insert_id = $this->db->insert_id();
    return $insert_id;
  }
  public function crearCompraProducto($cp){
    $re = $this->db->insert_batch('compra_producto',$cp);
    return $re;
  }
}