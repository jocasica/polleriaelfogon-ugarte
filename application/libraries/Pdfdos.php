<?php
include "fpdf/fpdf.php";
class Pdfdos {
  public function mostrar($data,$datos){
    $pdf = new FPDF($orientation='P',$unit='mm', array(85,300));
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',8);    //Letra Arial, negrita (Bold), tam. 20
    $textypos = 5;
    $pdf->setY(2);
    $pdf->setX(2);
    $pdf->SetFont('Arial','',9.5); 
    $pdf->setX(10);
    $pdf->Cell(0,$textypos,"POLLERIA EL FOGON - UGARTE",0,0,'C');
    $textypos+=8;
    $pdf->setX(13);
    $pdf->Cell(0,$textypos,"VENTA N-".$datos->id,0,0,'C');
    $textypos+=10;
    $pdf->setX(2);
    $pdf->Cell(5,$textypos,'---------------------------------------------------------------------');
    $textypos+=10;
    $pdf->setX(2);
    $pdf->Cell(5,$textypos,"Fecha y hora: ".$datos->created_at);

    $textypos+=10;
    $pdf->setX(2);
    $pdf->Cell(5,$textypos,'---------------------------------------------------------------------');
    $textypos+=10;
    $pdf->setX(2);
    $pdf->Cell(5,$textypos,'CANT.          PRODUCTO           PRECIO     TOTAL');
    $textypos+=10;
    $pdf->setX(2);
    $pdf->Cell(0,$textypos,'---------------------------------------------------------------------');
    $total =0;
    $textypos+=8;
    $subtotal=0;
    foreach($data["prods"]->result() as $pro){
      $pdf->setX(2);
      $pdf->Cell(5,$textypos,$pro->cantidad);
      $pdf->setX(13);
      $pdf->Cell(37,$textypos,  "".ucfirst(substr($pro->nombre, 0,18)) );
      $pdf->setX(54);
      $pdf->Cell(11,$textypos,  "".number_format($pro->precio_unidad,2,".",",") ,0,0,"R");
      $pdf->setX(68);
      $pdf->Cell(11,$textypos,  "".number_format($pro->total,2,".",",") ,0,0,"R");
      $total += $pro->total;
      $textypos+=10;
    }
    $textypos+=4;
    $pdf->setX(35);
    $pdf->Cell(5,$textypos,"TOTAL A PAGAR: " );
    $pdf->setX(75);
    $pdf->Cell(5,$textypos,"S/ ".number_format($total,2,".",","),0,0,"R");
    $textypos+=12;
    $pdf->setX(35);
    $pdf->Cell(5,$textypos,"EFECTIVO: " );
    $pdf->setX(75);
    $pdf->Cell(5,$textypos,"S/ ".number_format($datos->dinero_recibido,2,".",","),0,0,"R");
    $textypos+=12;
    $pdf->setX(35);
    $pdf->Cell(5,$textypos,"VUELTO: " );
    $pdf->setX(75);
    $pdf->Cell(5,$textypos,"S/ ".number_format($datos->dinero_vuelto,2,".",","),0,0,"R");
    $textypos+=12;
    $pdf->setX(2);
    $pdf->Cell(5,$textypos,"MOZO: ".$datos->mozo );
    $textypos+=10;
    $pdf->setX(2);
    $pdf->Cell(5,$textypos,"CAJA: 01" );
    $pdf->setX(20);
    $pdf->Cell(5,$textypos,"TURNO: 02" );
    $pdf->setX(2);
    $pdf->setX(7);

    $pdf->setX(2);
    $pdf->setX(10);
    $pdf->Cell(0,$textypos+23,'GRACIAS POR SU PREFERENCIA ',0,0,'C');
    $pdf->output('',$datos->id.'.pdf');
  }
  //por venta_producto
  public function mostrar_ticket($data,$datos){
    $pdf = new FPDF($orientation='P',$unit='mm', array(85,300));
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',8);    //Letra Arial, negrita (Bold), tam. 20
    $textypos = 5;
    $pdf->setY(2);
    $pdf->setX(2);
    $pdf->SetFont('Arial','',9.5); 
    $pdf->setX(10);
    $pdf->Cell(0,$textypos,"POLLERIA EL FOGON - UGARTE",0,0,'C');
    $textypos+=8;
    $pdf->setX(13);
    $pdf->Cell(0,$textypos,"VENTA N-".$datos->id,0,0,'C');
    $textypos+=8;
    $pdf->setX(11);
    $date = new DateTime($datos->created_at);
    $pdf->Cell(0,$textypos,$date->format('d/m/Y H:i'),0,0,'C');
    $textypos+=10;
    $pdf->setX(2);
    $pdf->setX(2);
    $pdf->Cell(10,$textypos,'Cantidad :' );
    $textypos+=9;
    $pdf->setX(5);
    $pdf->Cell(37,$textypos,  "".$datos->cantidad);

    $textypos+=9;
    $pdf->setX(2);
    $pdf->Cell(10,$textypos,'Producto :' );
    $textypos+=9;
    $pdf->setX(5);
    $pdf->Cell(37,$textypos,  "".substr($datos->nombre, 0,35) );

    $textypos+=9;
    $pdf->setX(2);
    $pdf->Cell(10,$textypos,'Precio :' );
    $textypos+=9;
    $pdf->setX(5);
    $pdf->Cell(37,$textypos, "S/ ".number_format($datos->precio_unidad,2,".",",") );
    
    $textypos+=9;
    $pdf->setX(2);
    $pdf->Cell(10,$textypos,'Total :' );
    $textypos+=9;
    $pdf->setX(5);
    $pdf->Cell(37,$textypos, "S/ ".number_format($datos->precio_unidad*$datos->cantidad,2,".",",") );
    $pdf->output('',$datos->id.'.pdf');
  }
  public function mostrarKardex($data,$data_ex,$datos){
    $pdf = new FPDF($orientation='L',$unit='mm', 'A4');
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',10); 
    $pdf->Cell(0,8,utf8_decode('FORMATO 12.1: "REGISTRO DEL INVENTARIO PERMANENTE EN UNIDADES FÍSICAS DETALLE DEL INVENTARIO PERMANENTE EN UNIDADES FÍSICAS"'),0,1,'L');
    $pdf->Cell(0,8,utf8_decode('PERÍODO: '.$datos["mes"].'/'.$datos["ano"]),0,1,'L');
    $pdf->Cell(0,8,utf8_decode('RUC: 20534172304'),0,1,'L');
    $pdf->Cell(0,8,utf8_decode('APELLIDOS Y NOMBRES, DENOMINACIÓN O RAZÓN SOCIAL: LK COMBUSTIBLES S.A.C.'),0,1,'L');
    $pdf->Cell(0,8,utf8_decode('ESTABLECIMIENTO: 1'),0,1,'L');
    $pdf->Cell(0,8,utf8_decode('CÓDIGO DE LA EXISTENCIA: '.$datos["id"]),0,1,'L');
    $pdf->Cell(0,8,utf8_decode('TIPO (TABLA 5): 01'),0,1,'L');
    $pdf->Cell(0,8,utf8_decode('DESCRIPCIÓN: '.$datos["producto"]),0,1,'L');
    $pdf->Cell(0,8,utf8_decode('CÓDIGO DE LA UNIDAD DE MEDIDA (TABLA 6): 09'),0,1,'L');




    $pdf->SetFillColor(100, 150, 250);
    $pdf->Cell(20,10,'FECHA',1,0,'C',true);
    $pdf->Cell(30,10,'TIPO (Tabla 10)',1,0,'C',true);
    $pdf->Cell(20,10,'SERIE',1,0,'C',true);
    $pdf->Cell(40,10,'NUMERO',1,0,'C',true);
    $pdf->Cell(50,10,'TIPO OPERACION Tabla 12',1,0,'C',true);
    $pdf->Cell(30,10,'INGRESO (Gal.)',1,0,'C',true);
    $pdf->Cell(30,10,'EGRESO(Gal.)',1,0,'C',true);
    $pdf->Cell(35,10,'SALDO FINAL(Gal.)',1,0,'C',true);
    $pdf->Ln();
    $pdf->SetFont('Arial','',9);
    $cantidad_ex = $data_ex->cantidad;

      $pdf->Cell(20,8,'',1,0,'C');
      $pdf->Cell(30,8,'00',1,0,'C');
      
      $pdf->Cell(20,8,'',1,0,'C');
      $pdf->Cell(40,8,'',1,0,'C');
      
      $pdf->Cell(50,8,'99',1,0,'C');
      $pdf->Cell(30,8,$data_ex->cantidad,1,0,'C');
      $pdf->Cell(30,8,'',1,0,'C');
      
      $pdf->Cell(35,8,$data_ex->cantidad,1,0,'C');
      $pdf->Ln();
    foreach($data->result() as $pro){
      $date = new DateTime($pro->fecha);
      $pdf->Cell(20,8,$date->format('d/m/Y'),1,0,'C');
      if($pro->serie[0]=="F"){
        $pdf->Cell(30,8,'01',1,0,'C');
      } else if($pro->serie[0]=="B"){
        $pdf->Cell(30,8,'03',1,0,'C');
      }
      
      $pdf->Cell(20,8,$pro->serie,1,0,'C');
      $pdf->Cell(40,8,$pro->numero,1,0,'C');
      
      if($pro->tipo == "VENTA"){
        $cantidad_ex -= $pro->cantidad;
        $pdf->Cell(50,8,'01',1,0,'C');
        $pdf->Cell(30,8,'',1,0,'C');
        $pdf->Cell(30,8,$pro->cantidad,1,0,'C');
      }else if ($pro->tipo == "COMPRA"){
        $cantidad_ex += $pro->cantidad;
        $pdf->Cell(50,8,'02',1,0,'C');
        $pdf->Cell(30,8,$pro->cantidad,1,0,'C');
        $pdf->Cell(30,8,'',1,0,'C');
      }
      $pdf->Cell(35,8,number_format($cantidad_ex,4,".",","),1,0,'C');
      $pdf->Ln();
    } 
    $pdf->Cell(20,8,'',0,0,'C');
    $pdf->Cell(30,8,'',0,0,'C');
    $pdf->Cell(20,8,'',0,0,'C');
    $pdf->Cell(40,8,'',0,0,'C');
    $pdf->Cell(50,8,'TOTALES',0,0,'C');
    $pdf->Cell(30,8,'',1,0,'C');
    $pdf->Cell(30,8,'',1,0,'C');
    $pdf->Cell(35,8,number_format($cantidad_ex,4,".",","),1,0,'C');
    $pdf->output('','s.pdf');
  }
  public function mostrarVentaDiaria($data,$datos){
    $pdf = new FPDF($orientation='L',$unit='mm', 'A4');
    $pdf->AddPage();
    $pdf->SetFont('Arial','I',14); 
    $fecha = new DateTime($datos["fecha"]);
    
    $pdf->SetFont('Arial','B',14); 
    $pdf->Cell(0,8,utf8_decode('Polleria el Fogon - UGARTE'),0,1,'C');
    $pdf->Cell(0,8,utf8_decode('LISTA DE VENTAS DEL DIA '.$fecha->format('d/m/Y')),0,1,'C');
    $pdf->Ln();

    $pdf->SetFont('Arial','B',10); 

    $pdf->SetFillColor(100, 150, 250);
    $pdf->Cell(15,10,'N',1,0,'C',true);
    $pdf->Cell(60,10,'MOZO',1,0,'C',true);
    $pdf->Cell(20,10,'MESA',1,0,'C',true);
    $pdf->Cell(30,10,'FECHA',1,0,'C',true);
    $pdf->Cell(75,10,'PRODUCTO',1,0,'C',true);
    $pdf->Cell(24,10,'CANTIDAD',1,0,'C',true);
    $pdf->Cell(25,10,'PRECIO',1,0,'C',true);
    $pdf->Cell(25,10,'TOTAL (S/)',1,0,'C',true);
    $pdf->Ln();
    $pdf->SetFont('Arial','',9);
    $total =0;
    foreach($data->result() as $pro){
      $date = new DateTime($pro->created_at);
      
      $pdf->Cell(15,8,$pro->id,1,0,'C');
      $pdf->Cell(60,8,utf8_decode(substr($pro->mozo,0,48)),1,0,'C');
      $pdf->Cell(20,8,$pro->numero_mesa,1,0,'C');
      $pdf->Cell(30,8,$date->format('d/m/Y H:m'),1,0,'C');
      $pdf->Cell(75,8,$pro->nombre,1,0,'C');
      $pdf->Cell(24,8,$pro->cantidad,1,0,'C');
      $pdf->Cell(25,8,utf8_decode($pro->precio_unidad),1,0,'C');
      $pdf->Cell(25,8,$pro->total,1,0,'C');
      $total = $total + (float)$pro->total;
      $pdf->Ln();
    }
      $pdf->Cell(249,8,'TOTAL',1,0,'C');
      $pdf->Cell(25,8,number_format((float)$total, 2, '.', ''),1,0,'C');
    $pdf->output('','s.pdf');
  }
  public function mostrarPolloDiario($datos,$pollo_vendido,$pollo_registrado){
    $pdf = new FPDF($orientation='L',$unit='mm', 'A4');
    $pdf->AddPage();
    $pdf->SetFont('Arial','I',14); 
    $fecha = new DateTime($datos["fecha"]);
    
    $pdf->SetFont('Arial','B',14); 
    $pdf->Cell(0,8,utf8_decode('Polleria el Fogon'),0,1,'C');
    $pdf->Cell(0,8,utf8_decode('REGISTRO DE POLLOS DEL DIA '.$fecha->format('d/m/Y')),0,1,'C');
    $pdf->Ln();

    $pdf->SetFont('Arial','B',10); 

    $pdf->SetFillColor(100, 150, 250);
    $pdf->Cell(135,10,'CANTIDAD DE POLLOS REGISTRADOS POR LA CAJERA (UND)',1,0,'C',true);
    $pdf->Cell(135,10,'CANTIDAD DE POLLOS VENDIDOS EN EL SISTEMA (UND)',1,0,'C',true);
    
    $pdf->Ln();
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(135,8,$pollo_registrado,1,0,'C');
    $pdf->Cell(135,8,utf8_decode(substr($pollo_vendido,0,48)),1,0,'C');
    $pdf->output('','s.pdf');
  }
  public function mostrarTurnos($data,$datos){
    $pdf = new FPDF($orientation='L',$unit='mm', 'A4');
    $pdf->AddPage();
    $pdf->SetFont('Arial','I',14); 
    
    $pdf->Cell(240,8,utf8_decode('PERÍODO: '.$datos["mes"].'/'.$datos["ano"]),0,'L');
    $pdf->Cell(900,8,utf8_decode('HORA: '.date('H:i')),0,'L');
      $pdf->Ln();
    
    $pdf->SetFont('Arial','B',14); 
    $pdf->Cell(0,8,utf8_decode('GRIFO SEÑOR DE LOS MILAGROS'),0,1,'C');
    $pdf->Cell(0,8,utf8_decode('LISTA DE TURNOS'),0,1,'C');
    $pdf->Ln();

    $pdf->SetFont('Arial','B',10); 

    $pdf->SetFillColor(100, 150, 250);
    $pdf->Cell(32,10,'HORA LLEGADA',1,0,'C',true);
    $pdf->Cell(30,10,'HORA SALIDA',1,0,'C',true);
    $pdf->Cell(70,10,'ENCARGADO',1,0,'C',true);
    $pdf->Cell(28,10,'PRODUCTO',1,0,'C',true);
    $pdf->Cell(19,10,'ISLA',1,0,'C',true);
    $pdf->Cell(19,10,'LADO',1,0,'C',true);
    $pdf->Cell(25,10,'GALONES',1,0,'C',true);
    $pdf->Cell(27,10,'PRECIO',1,0,'C',true);
    $pdf->Cell(27,10,'SOLES',1,0,'C',true);
    $pdf->Ln();
    $pdf->SetFont('Arial','',9);
    $total =0;
    $llegada = 'x';
    $c = 0;
    foreach($data->result() as $pro){
      $date1 = new DateTime($pro->hora_llegada);
      $date2 = new DateTime($pro->hora_salida);
      if( $c%8 == 0)
      {
        
        $pdf->SetFont('Arial','B',10);
        $pdf->SetFillColor(100, 150, 250);
        $pdf->Cell(32,8,$date1->format('d/m/Y H:i'),1,0,'C');
        $pdf->Cell(30,8,$date2->format('d/m/Y H:i'),1,0,'C');
        $pdf->Cell(70,8,$pro->encargado,1,0,'C');
      }
      else
      {
        $pdf->Cell(32,8,'',2,0,'C');
        $pdf->Cell(30,8,'',2,0,'C');
        $pdf->Cell(70,8,'',2,0,'C');
      }
      $pdf->SetFont('Arial','',9);
      $c++;
      
      $pdf->Cell(28,8,$pro->nombre,1,0,'C');
      $pdf->Cell(19,8,$pro->isla,1,0,'C');
      $pdf->Cell(19,8,$pro->lado,1,0,'C');
      //$total = $total + (float)$pro->total;
      $pdf->Cell(25,8,$pro->galones,1,0,'C');
      $pdf->Cell(27,8,$pro->precio,1,0,'C');
      $pdf->Cell(27,8,round($pro->precio*$pro->galones,2),1,0,'C');
      $pdf->Ln();
    }
      //$pdf->Cell(212,8,'TOTAL',1,0,'C');
      //$pdf->Cell(28,8,$total,1,0,'C');
      //$total = $total + (float)$pro->total;
      //$pdf->Cell(35,8,'',1,0,'C');
    $pdf->output('','s.pdf');
  }
  //por venta_producto
  public function mostrarFlujoDiario($datos,$pollo_vendido,$pollo_registrado,$venta_total,$data){
      $fecha = new DateTime($datos["fecha"]);
    $pdf = new FPDF($orientation='P',$unit='mm', array(85,2000));
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',8);    //Letra Arial, negrita (Bold), tam. 20
    $textypos = 5;
    $pdf->setY(2);
    $pdf->setX(2);
    $pdf->SetFont('Arial','',9.5); 
    $pdf->setX(10);
    $pdf->Cell(0,$textypos,"POLLERIA EL FOGON - UGARTE",0,0,'C');
    $textypos+=8;
    $pdf->setX(11);
    $pdf->Cell(0,$textypos,$fecha->format('d/m/Y'),0,0,'C');
    $textypos+=9;
    $pdf->setX(2);
    foreach($data->result() as $pro){
      $pdf->setX(2);
      
      $pdf->Cell(4,$textypos,str_pad(round($pro->cantidad),2,"0",STR_PAD_LEFT));
      $pdf->setX(8);
      $pdf->Cell(1,$textypos,substr($pro->nombre,0,40)." (".$pro->precio_unidad.")");
      $pdf->setX(75);
      $pdf->Cell(1,$textypos,str_pad($pro->precio_unidad*$pro->cantidad,3," ",STR_PAD_LEFT));
      $textypos+=10;
    $pdf->setX(2);
    }
    $textypos+=10;
    $pdf->setX(2);
    $pdf->Cell(10,$textypos,'TOTAL VENDIDO DEL DIA :' );
    $textypos+=9;
    $pdf->setX(5);
    $pdf->Cell(37,$textypos,  "S/ ".$venta_total);

    $textypos+=9;
    $pdf->setX(2);
    $pdf->Cell(10,$textypos,'CANTIDAD POLLOS VENDIDOS :' );
    $textypos+=9;
    $pdf->setX(5);
    $pdf->Cell(37,$textypos,  $pollo_vendido);

    $textypos+=9;
    $pdf->setX(2);
    $pdf->Cell(10,$textypos,'CANTIDAD POLLOS REGISTRADOS :' );
    $textypos+=9;
    $pdf->setX(5);
    $pdf->Cell(37,$textypos, $pollo_registrado);
    
    $textypos+=9;
    $pdf->setX(2);
    $pdf->Cell(10,$textypos,'CANTIDAD POLLOS SOBRANTES :' );
    $textypos+=9;
    $pdf->setX(5);
    $pdf->Cell(37,$textypos, ABS($pollo_vendido-$pollo_registrado));
    $pdf->output('',$fecha->format('d/m/Y').'.pdf');
  }
}
