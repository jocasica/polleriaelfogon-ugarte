<?php


class Venta_model extends CI_Model
{
  public function getVentas(){
    return $this->db->query("select v.id, f.serie, LPAD(f.numero, 6, '0') numero, f.estado, v.created_at fecha, sum(vp.total) total from venta v inner join factura f on f.venta_id=v.id inner join venta_producto vp on vp.venta_id=v.id group by (v.id) union select v.id, f.serie, LPAD(f.numero, 6, '0') numero, f.estado, v.created_at fecha, sum(vp.total) total from venta v inner join boleta f on f.venta_id=v.id inner join venta_producto vp on vp.venta_id=v.id group by (v.id) order by fecha desc limit 400");
    
  }
  public function getNumeroFactura(){
    $result = $this->db->query("select case when max(numero) IS NULL then LPAD(1, 6, '0') else LPAD(max(numero)+1, 6, '0') end as numero from factura LIMIT 1");
    return $result->row();
  }
  public function getNumeroBoleta(){
    $result = $this->db->query("select case when max(numero) IS NULL then LPAD(1, 6, '0') else LPAD(max(numero)+1, 6, '0') end as numero from boleta LIMIT 1");
    return $result->row();
  }
  public function crearVenta($venta){
    $this->db->insert('venta',$venta);
    $insert_id = $this->db->insert_id();
    return $insert_id;
  }

  public function crearFactura($f){
    $this->db->insert('factura',$f);
    $insert_id = $this->db->insert_id();
    return $insert_id;
  }

  public function crearBoleta($b){
    $this->db->insert('boleta',$b);
    $insert_id = $this->db->insert_id();
    return $insert_id;
  }
  
  public function crearVentaProducto($vp){
    $re = $this->db->insert_batch('venta_producto',$vp);
    return $re;
  }
  public function getProductosVenta($venta_id){
    return $this->db->query("select vp.cantidad, p.nombre, vp.precio_unidad, vp.subtotal, vp.total FROM venta v inner join venta_producto vp on v.id = vp.venta_id inner join producto p on p.id = vp.producto_id inner join unidad_medida um on um.id = p.unidad_medida_id WHERE v.id=".$venta_id);
  }
  public function getDatosVentaFactura($venta_id){
    $result = $this->db->query("select f.placa,f.hash, f.ruc docum, f.direccion,f.cliente, f.serie, LPAD(f.numero, 6, '0') numero, v.created_at, concat(u.first_name,' ',u.last_name) username from venta v inner join users u on v.users_id=u.id inner join factura f on f.venta_id=v.id where v.id=".$venta_id);
    return $result->row();
  }
  public function getDatosVentaBoleta($venta_id){
    $result = $this->db->query("select f.placa,f.hash, f.dni docum, f.direccion,f.cliente, f.serie, LPAD(f.numero, 6, '0') numero, v.created_at, concat(u.first_name,' ',u.last_name) username from venta v inner join users u on v.users_id=u.id inner join boleta f on f.venta_id=v.id where v.id=".$venta_id." LIMIT 1");
    return $result->row();
  }
  public function stockMesAnterior($producto_id,$mes,$ano){
    $result = $this->db->query("select * from stock_fin_mes_producto where producto_id=".$producto_id." and mes=".$mes." and ano=".$ano." LIMIT 1");
    return $result->row();
  }
  public function getUltimoNumeroComprobante(){
    return $this->db->query("select case when max(numero) IS NULL then LPAD(1, 6, '0') else LPAD(max(numero)+1, 6, '0') end as numero,'factura' tipo from factura UNION select case when max(numero) IS NULL then LPAD(1, 6, '0') else LPAD(max(numero)+1, 6, '0') end as numero,'boleta' tipo from boleta");
  }
  public function kardexProductoMesAno($producto_id,$mes,$ano){
    return $this->db->query("SELECT b.serie,LPAD(numero, 6, '0') numero,vp.cantidad,vp.precio_unidad,vp.total,b.created_at,b.fecha,'VENTA' tipo FROM boleta b inner join venta v on b.venta_id=v.id inner join venta_producto vp on v.id=vp.venta_id 
    where vp.producto_id=".$producto_id." and month(b.created_at)=".$mes." and year(b.created_at)=".$ano."
    UNION     SELECT f.serie,LPAD(numero, 6, '0') numero,vp.cantidad,vp.precio_unidad,vp.total,f.created_at,f.fecha,'VENTA' tipo FROM factura f 
    inner join venta v on f.venta_id=v.id 
    inner join venta_producto vp on v.id=vp.venta_id 
    where vp.producto_id=".$producto_id." and month(f.created_at)=".$mes." and year(f.created_at)=".$ano."
    UNION
    SELECT c.serie,LPAD(c.numero, 6, '0') numero,cp.cantidad,cp.precio_unidad,cp.total,c.fecha,c.fecha,'COMPRA' tipo FROM compra c 
    inner join compra_producto cp on c.id=cp.compra_id
    where cp.producto_id=".$producto_id." and month(c.fecha)=".$mes." and year(c.fecha)=".$ano."
    order by created_at");
  }
  public function verificarPrimeraVentaMes($producto_id,$mes,$ano){
    $result = $this->db->query("select count(*) cant_regs,p.stock from venta v inner join venta_producto vp on v.id=vp.venta_id inner join producto p on p.id=vp.producto_id where day(v.created_at)=1 and month(v.created_at)=".$mes." and year(v.created_at)=".$ano." and vp.producto_id=".$producto_id." LIMIT 1");
    if($result->row()->cant_regs == 0){
      $mes_insert = 0;
      $ano_insert = 0;
      if($mes==1){
        $mes_insert=12;
        $ano_insert=$ano-1;
      }else{
        $mes_insert=$mes-1;
        $ano_insert=$ano;
      }
      $s = array(
				'id'	=>	'',
				'producto_id'	=>	$producto_id,
				'mes'	=>	$mes_insert,
				'ano'	=>	$ano_insert,
				'cantidad'	=>	$result->row()->stock
			);
      $this->db->insert('stock_fin_mes_producto',$s);
    }
  }
  public function getDataConcarFactura($mes,$ano){
    return $this->db->query("select LPAD(@i := @i + 1, 4, '0') as count, f.ruc,f.serie, LPAD(f.numero, 6, '0') numero, f.fecha, LPAD(month(f.fecha), 2, '0') mes, (select sum(subtotal) from venta_producto where venta_id=v.id) subtotal, (select sum(total)-sum(subtotal) from venta_producto where venta_id=v.id) igv, (select sum(total) from venta_producto where venta_id=v.id) total from venta v inner join factura f on v.id=f.venta_id cross join (select @i := 0) vp where month(f.fecha)=".$mes." and year(f.fecha)=".$ano." order by f.created_at");
  }
  public function getDataConcarBoleta($mes,$ano){
    return $this->db->query("select LPAD(@i := @i + 1, 4, '0') as count, f.serie, LPAD(f.numero, 6, '0') numero, f.fecha, LPAD(month(f.fecha), 2, '0') mes, (select sum(subtotal) from venta_producto where venta_id=v.id) subtotal, (select sum(total)-sum(subtotal) from venta_producto where venta_id=v.id) igv, (select sum(total) from venta_producto where venta_id=v.id) total from venta v inner join boleta f on v.id=f.venta_id cross join (select @i := 0) vp where month(f.fecha)=".$mes." and year(f.fecha)=".$ano." order by f.created_at");
  }
  public function getDataDBF($mes,$ano){
    return $this->db->query("select DISTINCT ruc,fecha, created_at, cliente from factura where MONTH(fecha)=".$mes." and YEAR(fecha)=".$ano." and LENGTH(ruc)=11");
  }
  public function getListaComprobantes($mes,$ano,$doc){
    if($doc=="BOLETA"){
      return $this->db->query("select v.created_at as fecha, concat(f.serie,'-',LPAD(f.numero, 6, '0')) as numero, f.cliente, sum(vp.subtotal) subtotal ,sum(vp.total)-sum(vp.subtotal) igv, sum(vp.total) total, v.metodo_pago from venta v inner join boleta f on f.venta_id=v.id inner join venta_producto vp on vp.venta_id=v.id where month(f.created_at)=".$mes." and year(f.created_at)=".$ano." group by (v.id)");
      
    }else if($doc=="FACTURA"){
      return $this->db->query("select v.created_at as fecha, concat(f.serie,'-',LPAD(f.numero, 6, '0')) as numero, f.cliente, sum(vp.subtotal) subtotal ,sum(vp.total)-sum(vp.subtotal) igv, sum(vp.total) total, v.metodo_pago from venta v inner join factura f on f.venta_id=v.id inner join venta_producto vp on vp.venta_id=v.id where MONTH(f.created_at)=".$mes." and YEAR(f.created_at)=".$ano." group by v.id ");
    }    
  }
  public function getTurnoActual(){
    $result = $this->db->query("select t.id, tu.usuario_id,t.hora_llegada,t.estado,u.last_name,u.first_name from turno t inner join turno_usuario tu on t.id=tu.turno_id inner join users u on u.id=tu.usuario_id
    where t.estado=1 and tu.lugar=1 LIMIT 1");
    return $result->row();
  }

  public function getUltimoTurno(){
    $result = $this->db->query("select * from turno ORDER BY id DESC LIMIT 1");
    return $result->row();
  }

  public function insertTurno($t,$tu){
    if($this->db->insert('turno',$t))
    {
      $insert_id      = $this->db->insert_id();
      $tu['turno_id'] = $insert_id;
      if($this->db->insert('turno_usuario',$tu))
      {
        return $insert_id;
      }
      
    }
  }
  public function regContometros($c){
    $re = $this->db->insert_batch('contometro',$c);
    return $re;
  }

  public function insertTurnoUsuario($tu){
    $this->db->insert('turno_usuario',$tu);
  }

  public function getUsuarios(){
    return $this->db->query("select * from users");
  }

  public function updateTerminarTurno($turno_id,$hora_salida){
    $this->db->query("update turno_usuario set hora_salida ='".$hora_salida."' where turno_id=".$turno_id);
    return $this->db->query("update turno set estado=0, hora_salida ='".$hora_salida."' where id=".$turno_id);
  }

  public function getMaquinas(){
    return $this->db->query("select m.id,m.isla,m.lado,p.nombre from maquina m inner join producto p on m.producto_id=p.id");
  }

  public function registrarContometroSalida($turno_id,$maquina_id,$contometro_salida)
  {
    return $this->db->query("update contometro set contometro_salida=".$contometro_salida." where turno_id=".$turno_id." and maquina_id=".$maquina_id);
  }

  public function getCantidadTurnos(){
    $result = $this->db->query("select count(id) numero from turno");
    return $result->row();
  }
  public function guardarContometroSalida($turno_id)
  {
    return $this->db->query("insert into contometro(turno_id,maquina_id,contometro_llegada) SELECT '".$turno_id."',maquina_id,contometro_salida from contometro where turno_id = (select id from turno ORDER BY id DESC LIMIT 1 OFFSET 1)");
  }

  public function getTurnosReport()
  {
    return $this->db->query("select p.nombre, m.isla, m.lado, concat(u.first_name,' ',u.last_name) as encargado, t.hora_llegada, t.hora_salida, contometro_salida-contometro_llegada as galones, ifnull((select v_p.precio_unidad from venta_producto v_p where v_p.maquina_id=m.id and v_p.created_at>t.hora_llegada and v_p.created_at<t.hora_salida limit 1),0) precio from turno t inner join turno_usuario tu on t.id = tu.turno_id inner join users u on tu.usuario_id = u.id inner join contometro c on t.id = c.turno_id inner join maquina m on m.id = c.maquina_id inner join producto p on m.producto_id = p.id where tu.lugar=1 and t.estado=0  order by t.id,m.id");
  }
}