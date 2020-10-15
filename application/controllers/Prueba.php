<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prueba extends CI_Controller {

  public function index(){
    $this->load->library('../controllers/fe/printpdf');
    $this->load->library('pdfdos');
    $print = $this->printpdf;
    $pdf = $this->pdfdos;

    $this->load->library('pdf');
    $dompdf = $this->pdf;
    
    $tipo_cpe = $_GET['tipo'];
    $venta_id = $_GET['id'];
    //$prods = $this->venta_model->getProductosVenta($venta_id);
    if($tipo_cpe == 'venta_diaria') {
      $fecha = $_GET['fecha'];
      $datos['fecha'] = $fecha;
      $data = $this->venta_model->getVentaDiaria($fecha);
      $pdf->mostrarVentaDiaria($data,$datos);
    }
    if($tipo_cpe == 'pollo_diario') {
      $fecha = $_GET['fecha'];
      $datos['fecha'] = $fecha;
      $pollo_vendido = $this->venta_model->getPollosVendidos($fecha)->cantidad;
      $pollo_registrado = $this->venta_model->getRegistroPollo($fecha)->cantidad;
      $pdf->mostrarPolloDiario($datos,$pollo_vendido,$pollo_registrado);
    }
    if($tipo_cpe == 'ticket_diario') {
      $fecha = $_GET['fecha'];
      $datos['fecha'] = $fecha;
      $pollo_vendido = $this->venta_model->getPollosVendidos($fecha)->cantidad;
      $pollo_registrado = $this->venta_model->getRegistroPollo($fecha)->cantidad;
      $venta_total = $this->venta_model->getVentaTotalDiaria($fecha)->venta_total;
      $data = $this->venta_model->getVentaDiariaTicket($fecha);
      $pdf->mostrarFlujoDiario($datos,$pollo_vendido,$pollo_registrado,$venta_total,$data);
    }
    if($tipo_cpe == 'factura') {
      $data['comprobante'] = "FACTURA";
      $data['prods'] = $prods;
      $datos = $this->venta_model->getDatosVentaFactura($venta_id);
      $pdf->mostrar($data,$datos);
    }
    if($tipo_cpe == 'venta') {
      $data['comprobante'] = "VENTA";
      $data['prods'] = $prods;
      $datos = $this->venta_model->getDatosVenta($venta_id);
      $pdf->mostrar($data,$datos);
    }
    if($tipo_cpe == 'ticket') {
        
        
      $data['comprobante'] = "TICKET";
      $datos = $this->venta_model->getDatosTicket($venta_id);
     $pdf->mostrar_ticket($data,$datos);
     
    // var_dump($datos);
      
      
    }

    if($tipo_cpe == 'boleta') {
      $data['comprobante'] = "BOLETA";
      $data['prods'] = $prods;
      $datos = $this->venta_model->getDatosVentaBoleta($venta_id);
      $pdf->mostrar($data,$datos);
      //$this->load->library('../controllers/fe/documentos_html');
      //$html_documentos = $this->documentos_html;

      //$html = $html_documentos->get_html_boleta('');

      //define("DOMPDF_ENABLE_REMOTE", true);
      
      //$dompdf->loadHtml($html['html']);
      //$dompdf->setPaper('A4');
      //$dompdf->render();
      //$dompdf->stream("boleta_n_".$id.".pdf",array('Attachment'=>0));
    }

    if($tipo_cpe == 'notadebito') {
      $this->load->library('../controllers/fe/documentos_html');
      $html_documentos = $this->documentos_html;

      $html = $html_documentos->get_html_nota_debito('');

      define("DOMPDF_ENABLE_REMOTE", true);
      
      $dompdf->loadHtml($html['html']);
      $dompdf->setPaper('A4');
      $dompdf->render();
      $dompdf->stream("notadebito_n_".$id.".pdf",array('Attachment'=>0));
    }

    if($tipo_cpe == 'notacredito') {
      $this->load->library('../controllers/fe/documentos_html');
      $html_documentos = $this->documentos_html;
      $data = $this->venta_model->kardexProductoMesAno(1,11,2018);
      $html = $html_documentos->get_html_kardex($data);

      define("DOMPDF_ENABLE_REMOTE", true);
          
      $dompdf->loadHtml($html['html']);
      $dompdf->setPaper('A4','landscape');
      $dompdf->render();
      $dompdf->stream("notacredito_n_".$venta_id.".pdf",array('Attachment'=>1));
    }
    // if($tipo_cpe == 'venta') {
    //   $mes = $_GET['mes'];
    //   $ano = $_GET['ano'];
    //   $doc = $_GET['doc'];

    //   $this->load->library('../controllers/fe/documentos_html');
    //   $html_documentos = $this->documentos_html;
    //   $mes_buscar=0;
    //   $ano_buscar=0;
    //   if($mes==1){
    //     $mes_buscar=12;
    //     $ano_buscar=$ano-1;
    //   }else{
    //     $mes_buscar=$mes-1;
    //     $ano_buscar=$ano;
    //   }
    //   $data = $this->venta_model->getListaComprobantes($mes,$ano,$doc);
    //   $datos = [];
    //   $datos["mes"] = $mes;
    //   $datos["ano"] = $ano;
    //   $datos["doc"] = $doc;
      
    //   $pdf->mostrarListaComprobantes($data,$datos);
      
    // }
    if($tipo_cpe == 'turno') {
      $mes = $_GET['mes'];
      $ano = $_GET['ano'];

      $this->load->library('../controllers/fe/documentos_html');
      $html_documentos = $this->documentos_html;
      $mes_buscar=0;
      $ano_buscar=0;
      if($mes==1){
        $mes_buscar=12;
        $ano_buscar=$ano-1;
      }else{
        $mes_buscar=$mes-1;
        $ano_buscar=$ano;
      }
      $data = $this->venta_model->getTurnosReport();
      $datos = [];
      $datos["mes"] = $mes;
      $datos["ano"] = $ano;
      
      $pdf->mostrarTurnos($data,$datos);
      
    }
    if($tipo_cpe == 'kardex') {
      $mes = $_GET['mes'];
      $ano = $_GET['ano'];
      
      $this->load->library('../controllers/fe/documentos_html');
      $html_documentos = $this->documentos_html;
      $mes_buscar=0;
      $ano_buscar=0;
      if($mes==1){
        $mes_buscar=12;
        $ano_buscar=$ano-1;
      }else{
        $mes_buscar=$mes-1;
        $ano_buscar=$ano;
      }
      $data_ex = $this->venta_model->stockMesAnterior($venta_id,$mes_buscar,$ano_buscar);
      $data = $this->venta_model->kardexProductoMesAno($venta_id,$mes,$ano);
      $prod = $this->producto_model->getProductoById($venta_id)->nombre;
      $datos = [];
      $datos["mes"] = $mes;
      $datos["ano"] = $ano;
      $datos["id"] = $venta_id;
      $datos["producto"] = $prod;
      if($data_ex == null){
        echo "Datos insuficientes.";
      }else{
        $pdf->mostrarKardex($data,$data_ex,$datos);
      }
    }
    set_time_limit (0);
    if($tipo_cpe == 'concar') {
      $mes = $_GET['mes'];
      $ano = $_GET['ano'];
      $tipo = $_GET['doc'];
      

      require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
      require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');
      $excel = new PHPExcel();

      $excel->getProperties()->setCreator("Escienza");
      $excel->getProperties()->setLastModifiedBy("");
      $excel->getProperties()->setTitle("Concar ".$mes."/".$ano);
      $excel->getProperties()->setSubject("");
      $excel->getProperties()->setDescription("");
      $excel->setActiveSheetIndex(0);

      $styleArray = array(
        'font'  => array(
            'bold'  => false,
            'size'  => 10,
            'name'  => 'Arial'
        ));
      
      
      $excel->getActiveSheet()->getColumnDimension('B')->setWidth(9.72);
      $excel->getActiveSheet()->getColumnDimension('C')->setWidth(23);
      $excel->getActiveSheet()->getColumnDimension('D')->setWidth(22);
      $excel->getActiveSheet()->getColumnDimension('E')->setWidth(17.3);
      $excel->getActiveSheet()->getColumnDimension('F')->setWidth(17.3);
      $excel->getActiveSheet()->getColumnDimension('G')->setWidth(17.3);
      $excel->getActiveSheet()->getColumnDimension('H')->setWidth(17.3);
      $excel->getActiveSheet()->getColumnDimension('I')->setWidth(24);
      $excel->getActiveSheet()->getColumnDimension('J')->setWidth(23);
      $excel->getActiveSheet()->getColumnDimension('K')->setWidth(19);
      $excel->getActiveSheet()->getColumnDimension('L')->setWidth(17);
      $excel->getActiveSheet()->getColumnDimension('M')->setWidth(22);
      $excel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
      $excel->getActiveSheet()->getColumnDimension('O')->setWidth(16);
      $excel->getActiveSheet()->getColumnDimension('P')->setWidth(24);
      $excel->getActiveSheet()->getColumnDimension('Q')->setWidth(21);
      $excel->getActiveSheet()->getColumnDimension('R')->setWidth(19);
      $excel->getActiveSheet()->getColumnDimension('S')->setWidth(27);
      $excel->getActiveSheet()->getColumnDimension('T')->setWidth(21);
      $excel->getActiveSheet()->getColumnDimension('U')->setWidth(21);
      $excel->getActiveSheet()->getColumnDimension('V')->setWidth(15);
      $excel->getActiveSheet()->getColumnDimension('W')->setWidth(14);
      $excel->getActiveSheet()->getColumnDimension('X')->setWidth(21);
      $excel->getActiveSheet()->getColumnDimension('Y')->setWidth(13);
      $excel->getActiveSheet()->getColumnDimension('Z')->setWidth(20);
      $excel->getActiveSheet()->getColumnDimension('AA')->setWidth(26);
      $excel->getActiveSheet()->getColumnDimension('AB')->setWidth(25);
      $excel->getActiveSheet()->getColumnDimension('AC')->setWidth(27);
      $excel->getActiveSheet()->getColumnDimension('AD')->setWidth(27);
      $excel->getActiveSheet()->getColumnDimension('AE')->setWidth(27);
      $excel->getActiveSheet()->getColumnDimension('AF')->setWidth(27);
      $excel->getActiveSheet()->getColumnDimension('AG')->setWidth(27);
      $excel->getActiveSheet()->getColumnDimension('AH')->setWidth(27);
      $excel->getActiveSheet()->getColumnDimension('AI')->setWidth(27);
      $excel->getActiveSheet()->getColumnDimension('AJ')->setWidth(27);
      $excel->getActiveSheet()->getColumnDimension('AK')->setWidth(27);
      $excel->getActiveSheet()->getColumnDimension('AL')->setWidth(27);

    //FILA 1
      $excel->getActiveSheet()->SetCellValue('A1','Campo');
      $excel->getActiveSheet()->SetCellValue("B1","Sub Diario");
      $excel->getActiveSheet()->SetCellValue("C1","Número de Comprobante");
      $excel->getActiveSheet()->SetCellValue("D1","Fecha de Comprobante");
      $excel->getActiveSheet()->SetCellValue("E1","Código de Moneda");
      $excel->getActiveSheet()->SetCellValue("F1","Glosa Principal");
      $excel->getActiveSheet()->SetCellValue("G1","Tipo de Cambio");
      $excel->getActiveSheet()->SetCellValue("H1","Tipo de Conversión");
      $excel->getActiveSheet()->SetCellValue("I1","Flag de Conversión de Moneda");
      $excel->getActiveSheet()->SetCellValue("J1","Fecha Tipo de Cambio");
      $excel->getActiveSheet()->SetCellValue("K1","Cuenta Contable");
      $excel->getActiveSheet()->SetCellValue("L1","Código de Anexo");
      $excel->getActiveSheet()->SetCellValue("M1","Código de Centro de Costo");
      $excel->getActiveSheet()->SetCellValue("N1","Debe / Haber");
      $excel->getActiveSheet()->SetCellValue("O1","Importe Original");
      $excel->getActiveSheet()->SetCellValue("P1","Importe en Dólares");
      $excel->getActiveSheet()->SetCellValue("Q1","Importe en Soles");
      $excel->getActiveSheet()->SetCellValue("R1","Tipo de Documento");
      $excel->getActiveSheet()->SetCellValue("S1","Número de Documento");
      $excel->getActiveSheet()->SetCellValue("T1","Fecha de Documento");
      $excel->getActiveSheet()->SetCellValue("U1","Fecha de Vencimiento");
      $excel->getActiveSheet()->SetCellValue("V1","Código de Area");
      $excel->getActiveSheet()->SetCellValue("W1","Glosa Detalle");
      $excel->getActiveSheet()->SetCellValue("X1","Código de Anexo Auxiliar");
      $excel->getActiveSheet()->SetCellValue("Y1","Medio de Pago");
      $excel->getActiveSheet()->SetCellValue("Z1","Tipo de Documento de Referencia");
      $excel->getActiveSheet()->SetCellValue("AA1","Número de Documento Referencia");
      $excel->getActiveSheet()->SetCellValue("AB1","Fecha Documento Referencia");
      $excel->getActiveSheet()->SetCellValue("AC1","Base Imponible Documento Referencia");
      $excel->getActiveSheet()->SetCellValue("AD1","IGV Documento Provisión");
      $excel->getActiveSheet()->SetCellValue("AE1","Tipo Referencia en estado MQ");
      $excel->getActiveSheet()->SetCellValue("AF1","Número Serie Caja Registradora");
      $excel->getActiveSheet()->SetCellValue("AG1","Fecha de Operación");
      $excel->getActiveSheet()->SetCellValue("AH1","Tipo de Tasa");
      $excel->getActiveSheet()->SetCellValue("AI1","Tasa Detracción/Percepción");
      $excel->getActiveSheet()->SetCellValue("AJ1","Importe Base Detracción/Percepción Dólares");
      $excel->getActiveSheet()->SetCellValue("AK1","Importe Base Detracción/Percepción Soles");
      $excel->getActiveSheet()->SetCellValue("AL1","Tipo Cambio para 'F'");
    
  //FILA 2
      $excel->getActiveSheet()->SetCellValue("A2","Restricciones");
      $excel->getActiveSheet()->SetCellValue("B2","Ver T.G.02");
      $excel->getActiveSheet()->SetCellValue("C2","Los dos primero digitos son el mes y
      los otros 4
      siguientes un
      correlativo");
      $excel->getActiveSheet()->SetCellValue("D2","");
      $excel->getActiveSheet()->SetCellValue("E2","Ver T.G. 03");
      $excel->getActiveSheet()->SetCellValue("F2","");
      $excel->getActiveSheet()->SetCellValue("G2","Llenar  solo si Tipo
      de Conversión es
      'C'. Debe estar entre
      >=0 y <=9999.999999");
      $excel->getActiveSheet()->SetCellValue("H2","Solo: 'C'= Especial,
      'M'=Compra, 
    'V'=Venta , 'F' De 
      acuerdo a fecha");
      $excel->getActiveSheet()->SetCellValue("I2","Solo: 'S' = Si se
      convierte, 'N'= No
      se convierte");
      $excel->getActiveSheet()->SetCellValue("J2","Si Tipo de
      Conversión 'F'");
      $excel->getActiveSheet()->SetCellValue("K2","Debe existir en 
      el Plan de 
      Cuentas");
      $excel->getActiveSheet()->SetCellValue("L2","Si Cuenta 
      Contable tiene
      seleccionado 
      Tipo de Anexo,
      debe existir en
      la tabla de
      Anexos");
      $excel->getActiveSheet()->SetCellValue("M2","Si Cuenta 
      Contable tiene 
      habilitado C.
      Costo, Ver T.G. 05");
      $excel->getActiveSheet()->SetCellValue("N2","'D' ó 'H'");
      $excel->getActiveSheet()->SetCellValue("O2","Importe original de 
      la cuenta contable.
      Obligatorio, debe 
      estar entre >=0 y 
      <=99999999999.99 ");
      $excel->getActiveSheet()->SetCellValue("P2","Importe de la 
      Cuenta Contable en
      Dólares. Obligatorio
      si Flag de
      Conversión de 
      Moneda esta en 'N',
      debe estar entre
      >=0 y
      <=99999999999.99 ");
      $excel->getActiveSheet()->SetCellValue("Q2","Importe de la
      Cuenta Contable en 
    Soles. Obligatorio si 
    Flag de Conversión 
    de Moneda esta en 
    'N', debe estra entre 
    >=0 y 
    <=99999999999.99 ");
      $excel->getActiveSheet()->SetCellValue("R2","Si Cuenta Contable 
      tiene habilitado el 
      Documento 
      Referencia Ver T.G.
      06");
      $excel->getActiveSheet()->SetCellValue("S2","Si Cuenta Contable 
      tiene habilitado el 
      Documento 
      Referencia Incluye 
      Serie y Número");
      $excel->getActiveSheet()->SetCellValue("T2","Si Cuenta 
      Contable tiene 
      habilitado el 
      Documento 
      Referencia");
      $excel->getActiveSheet()->SetCellValue("U2","Si Cuenta 
      Contable tiene 
      habilitada la 
      Fecha de 
      Vencimiento");
      $excel->getActiveSheet()->SetCellValue("V2","Si Cuenta 
      Contable tiene 
      habilitada el 
      Area. Ver T.G. 26");
      $excel->getActiveSheet()->SetCellValue("W2","");
      $excel->getActiveSheet()->SetCellValue("X2","Si Cuenta 
      Contable tiene 
      seleccionado 
      Tipo de Anexo 
      Referencia");
      $excel->getActiveSheet()->SetCellValue("Y2","Si Cuenta Contable 
      tiene habilitado 
      Tipo Medio Pago. 
      Ver T.G. 'S1'");
      $excel->getActiveSheet()->SetCellValue("Z2","Si Tipo de 
      Documento es 
      'NA' ó 'ND' Ver 
      T.G. 06");
      $excel->getActiveSheet()->SetCellValue("AA2","Si Tipo de 
      Documento es 
      'NC', 'NA' ó 'ND', 
      incluye Serie y 
      Número");
      $excel->getActiveSheet()->SetCellValue("AB2","Si Tipo de 
      Documento es 
      'NC', 'NA' ó 'ND'");
      $excel->getActiveSheet()->SetCellValue("AC2","Si Tipo de 
      Documento es 
      'NC', 'NA' ó 'ND'");
      $excel->getActiveSheet()->SetCellValue("AD2","Si Tipo de 
      Documento es 
      'NC', 'NA' ó 'ND'");
      $excel->getActiveSheet()->SetCellValue("AE2","Si la Cuenta Contable 
      tiene Habilitado 
      Documento 
      Referencia 2 y  Tipo 
      de Documento es 'TK'");
      $excel->getActiveSheet()->SetCellValue("AF2","Si la Cuenta Contable 
      teinen Habilitado 
      Documento 
      Referencia 2 y  Tipo 
      de Documento es 'TK'");
      $excel->getActiveSheet()->SetCellValue("AG2","Si la Cuenta Contable 
      tiene Habilitado 
      Documento 
      Referencia 2. Cuando 
      Tipo de Documento 
      es 'TK', consignar la 
      fecha de emision del 
      ticket");
      $excel->getActiveSheet()->SetCellValue("AH2","Si la Cuenta 
      Contable tiene 
      configurada la 
      Tasa:  Si es '1' ver 
      T.G. 28 y '2' ver T.G. 
      29");
      $excel->getActiveSheet()->SetCellValue("AI2","Si la Cuenta Contable 
      tiene conf. een Tasa:  Si 
      es '1' ver T.G. 28 y '2' ver 
      T.G. 29. Debe estar entre 
      >=0 y <=999.99");
      $excel->getActiveSheet()->SetCellValue("AJ2","Si la Cuenta Contable 
      tiene configurada la 
      Tasa. Debe ser el 
      importe total del 
      documento y estar entre 
      >=0 y <=99999999999.99");
      $excel->getActiveSheet()->SetCellValue("AK2","Si la Cuenta Contable 
      tiene configurada la 
      Tasa. Debe ser el 
      importe total del 
      documento y estar entre 
      >=0 y <=99999999999.99");
      $excel->getActiveSheet()->SetCellValue("AL2","Especificar solo si 
      Tipo Conversión es 
      'F'. Se permite 'M' 
      Compra y 'V' Venta.");
            
      //FILA 3
      $excel->getActiveSheet()->SetCellValue('A3','Numérico 11,6');
      $excel->getActiveSheet()->SetCellValue("B3","2 Caracteres");
      $excel->getActiveSheet()->SetCellValue("C3","6 caracteres");
      $excel->getActiveSheet()->SetCellValue("D3","dd/mm/aaaa");
      $excel->getActiveSheet()->SetCellValue("E3","2 Caracteres");
      $excel->getActiveSheet()->SetCellValue("F3","40 Caracteres");
      $excel->getActiveSheet()->SetCellValue("G3","");
      $excel->getActiveSheet()->SetCellValue("H3","1 Caracteres");
      $excel->getActiveSheet()->SetCellValue("I3","1 Caracteres");
      $excel->getActiveSheet()->SetCellValue("J3","dd/mm/aaaa");
      $excel->getActiveSheet()->SetCellValue("K3","8 Caracteres");
      $excel->getActiveSheet()->SetCellValue("L3","18 Caracteres");
      $excel->getActiveSheet()->SetCellValue("M3","6 Caracteres");
      $excel->getActiveSheet()->SetCellValue("N3","1 Carácter");
      $excel->getActiveSheet()->SetCellValue("O3","Numérico 14,2");
      $excel->getActiveSheet()->SetCellValue("P3","Numérico 14,2");
      $excel->getActiveSheet()->SetCellValue("Q3","Numérico 14,2");
      $excel->getActiveSheet()->SetCellValue("R3","2 Caracteres");
      $excel->getActiveSheet()->SetCellValue("S3","20 Caracteres");
      $excel->getActiveSheet()->SetCellValue("T3","dd/mm/aaaa");
      $excel->getActiveSheet()->SetCellValue("U3","dd/mm/aaaa");
      $excel->getActiveSheet()->SetCellValue("V3","3 Caracteres");
      $excel->getActiveSheet()->SetCellValue("W3","30 Caracteres");
      $excel->getActiveSheet()->SetCellValue("X3","18 Caracteres");
      $excel->getActiveSheet()->SetCellValue("Y3","8 Caracteres");
      $excel->getActiveSheet()->SetCellValue("Z3","2 Caracteres");
      $excel->getActiveSheet()->SetCellValue("AA3","20 Caracteres");
      $excel->getActiveSheet()->SetCellValue("AB3","dd/mm");
      $excel->getActiveSheet()->SetCellValue("AC3","Numérico 14,2 ");
      $excel->getActiveSheet()->SetCellValue("AD3","Numérico 14,2");
      $excel->getActiveSheet()->SetCellValue("AE3","'MQ'");
      $excel->getActiveSheet()->SetCellValue("AF3","15 Caracteres");
      $excel->getActiveSheet()->SetCellValue("AG3","dd/mm/aaaa");
      $excel->getActiveSheet()->SetCellValue("AH3","5 Caracteres");
      $excel->getActiveSheet()->SetCellValue("AI3","Numérico 14,2");
      $excel->getActiveSheet()->SetCellValue("AJ3","Numérico 14,2");
      $excel->getActiveSheet()->SetCellValue("AK3","Numérico 14,2");
      $excel->getActiveSheet()->SetCellValue("AL3","1 Caracter");
      
      $r = 4;
      if($tipo=="BOLETA"){
        $data = $this->venta_model->getDataConcarBoleta($mes,$ano);
        foreach($data->result() as $row){
          $date = new DateTime($row->fecha);
          $fecha = $date->format('d/m/Y');
          $excel->getActiveSheet()->SetCellValue('B'.$r, '04');
          $excel->getActiveSheet()->SetCellValue('C'.$r, $row->mes.$row->count);
          $excel->getActiveSheet()->SetCellValue('D'.$r, $fecha);
          $excel->getActiveSheet()->SetCellValue('E'.$r, 'MN');
          $excel->getActiveSheet()->SetCellValue('F'.$r, 'datos de bl');
          $excel->getActiveSheet()->SetCellValue('G'.$r, '0');
          $excel->getActiveSheet()->SetCellValue('H'.$r, 'V');
          $excel->getActiveSheet()->SetCellValue('I'.$r, 'S');
          $excel->getActiveSheet()->SetCellValue('K'.$r, '701111');
          $excel->getActiveSheet()->SetCellValue('L'.$r, '0002');
          $excel->getActiveSheet()->SetCellValue('N'.$r, 'H');
          $excel->getActiveSheet()->SetCellValue('O'.$r, $row->subtotal);
          $excel->getActiveSheet()->SetCellValue('R'.$r, 'BV');
          $excel->getActiveSheet()->SetCellValue('S'.$r, substr($row->serie, 1, 3).'-'.$row->numero);
          $excel->getActiveSheet()->SetCellValue('T'.$r, $fecha);
          $r++;
          $excel->getActiveSheet()->SetCellValue('B'.$r, '04');
          $excel->getActiveSheet()->SetCellValue('C'.$r, $row->mes.$row->count);
          $excel->getActiveSheet()->SetCellValue('D'.$r, $fecha);
          $excel->getActiveSheet()->SetCellValue('E'.$r, 'MN');
          $excel->getActiveSheet()->SetCellValue('F'.$r, 'datos de bl');
          $excel->getActiveSheet()->SetCellValue('G'.$r, '0');
          $excel->getActiveSheet()->SetCellValue('H'.$r, 'V');
          $excel->getActiveSheet()->SetCellValue('I'.$r, 'S');
          $excel->getActiveSheet()->SetCellValue('K'.$r, '401111');
          $excel->getActiveSheet()->SetCellValue('N'.$r, 'H');
          $excel->getActiveSheet()->SetCellValue('O'.$r, $row->igv);
          $excel->getActiveSheet()->SetCellValue('R'.$r, 'BV');
          $excel->getActiveSheet()->SetCellValue('S'.$r, substr($row->serie, 1, 3).'-'.$row->numero);
          $excel->getActiveSheet()->SetCellValue('T'.$r, $fecha);
          $r++;
          $excel->getActiveSheet()->SetCellValue('B'.$r, '04');
          $excel->getActiveSheet()->SetCellValue('C'.$r, $row->mes.$row->count);
          $excel->getActiveSheet()->SetCellValue('D'.$r, $fecha);
          $excel->getActiveSheet()->SetCellValue('E'.$r, 'MN');
          $excel->getActiveSheet()->SetCellValue('F'.$r, 'datos de bl');
          $excel->getActiveSheet()->SetCellValue('G'.$r, '0');
          $excel->getActiveSheet()->SetCellValue('H'.$r, 'V');
          $excel->getActiveSheet()->SetCellValue('I'.$r, 'S');
          $excel->getActiveSheet()->SetCellValue('K'.$r, '121203');
          $excel->getActiveSheet()->SetCellValue('L'.$r, '0002');
          $excel->getActiveSheet()->SetCellValue('N'.$r, 'D');
          $excel->getActiveSheet()->SetCellValue('O'.$r, $row->total);
          $excel->getActiveSheet()->SetCellValue('R'.$r, 'BV');
          $excel->getActiveSheet()->SetCellValue('S'.$r, substr($row->serie, 1, 3).'-'.$row->numero);
          $excel->getActiveSheet()->SetCellValue('T'.$r, $fecha);
          $excel->getActiveSheet()->SetCellValue('U'.$r, $fecha);
          $r++;
        }
      }else if ($tipo=="FACTURA"){
        $data = $this->venta_model->getDataConcarFactura($mes,$ano);
        foreach($data->result() as $row){
          $date = new DateTime($row->fecha);
          $fecha = $date->format('d/m/Y');
          $excel->getActiveSheet()->SetCellValue('B'.$r, '05');
          $excel->getActiveSheet()->SetCellValue('C'.$r, $row->mes.$row->count);
          $excel->getActiveSheet()->SetCellValue('D'.$r, $fecha);
          $excel->getActiveSheet()->SetCellValue('E'.$r, 'MN');
          $excel->getActiveSheet()->SetCellValue('F'.$r, 'datos de ft');
          $excel->getActiveSheet()->SetCellValue('G'.$r, '0');
          $excel->getActiveSheet()->SetCellValue('H'.$r, 'V');
          $excel->getActiveSheet()->SetCellValue('I'.$r, 'S');
          $excel->getActiveSheet()->SetCellValue('K'.$r, '701111');
          $excel->getActiveSheet()->SetCellValue('L'.$r, $row->ruc);
          $excel->getActiveSheet()->SetCellValue('N'.$r, 'H');
          $excel->getActiveSheet()->SetCellValue('O'.$r, $row->subtotal);
          $excel->getActiveSheet()->SetCellValue('R'.$r, 'FT');
          $excel->getActiveSheet()->SetCellValue('S'.$r, substr($row->serie, 1, 3).'-'.$row->numero);
          $excel->getActiveSheet()->SetCellValue('T'.$r, $fecha);
          $r++;
          $excel->getActiveSheet()->SetCellValue('B'.$r, '05');
          $excel->getActiveSheet()->SetCellValue('C'.$r, $row->mes.$row->count);
          $excel->getActiveSheet()->SetCellValue('D'.$r, $fecha);
          $excel->getActiveSheet()->SetCellValue('E'.$r, 'MN');
          $excel->getActiveSheet()->SetCellValue('F'.$r, 'datos de ft');
          $excel->getActiveSheet()->SetCellValue('G'.$r, '0');
          $excel->getActiveSheet()->SetCellValue('H'.$r, 'V');
          $excel->getActiveSheet()->SetCellValue('I'.$r, 'S');
          $excel->getActiveSheet()->SetCellValue('K'.$r, '401111');
          $excel->getActiveSheet()->SetCellValue('N'.$r, 'H');
          $excel->getActiveSheet()->SetCellValue('O'.$r, $row->igv);
          $excel->getActiveSheet()->SetCellValue('R'.$r, 'FT');
          $excel->getActiveSheet()->SetCellValue('S'.$r, substr($row->serie, 1, 3).'-'.$row->numero);
          $excel->getActiveSheet()->SetCellValue('T'.$r, $fecha);
          $r++;
          $excel->getActiveSheet()->SetCellValue('B'.$r, '05');
          $excel->getActiveSheet()->SetCellValue('C'.$r, $row->mes.$row->count);
          $excel->getActiveSheet()->SetCellValue('D'.$r, $fecha);
          $excel->getActiveSheet()->SetCellValue('E'.$r, 'MN');
          $excel->getActiveSheet()->SetCellValue('F'.$r, 'datos de ft');
          $excel->getActiveSheet()->SetCellValue('G'.$r, '0');
          $excel->getActiveSheet()->SetCellValue('H'.$r, 'V');
          $excel->getActiveSheet()->SetCellValue('I'.$r, 'S');
          $excel->getActiveSheet()->SetCellValue('K'.$r, '121201');
          $excel->getActiveSheet()->SetCellValue('L'.$r, $row->ruc);
          $excel->getActiveSheet()->SetCellValue('N'.$r, 'D');
          $excel->getActiveSheet()->SetCellValue('O'.$r, $row->total);
          $excel->getActiveSheet()->SetCellValue('R'.$r, 'FT');
          $excel->getActiveSheet()->SetCellValue('S'.$r, substr($row->serie, 1, 3).'-'.$row->numero);
          $excel->getActiveSheet()->SetCellValue('T'.$r, $fecha);
          $excel->getActiveSheet()->SetCellValue('U'.$r, $fecha);
          $r++;
        }
      }
      
      $excel->getActiveSheet()
        ->getStyle("A1:".$excel->getActiveSheet()->getHighestDataColumn().$excel->getActiveSheet()->getHighestDataRow())
        ->getAlignment()
        ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
      $excel->getActiveSheet()->getStyle("A1:".$excel->getActiveSheet()->getHighestDataColumn().$excel->getActiveSheet()->getHighestDataRow())->applyFromArray($styleArray);
      
      $filename = "CONCAR_".$tipo."_".$mes."/".$ano.".xls";
      $excel->getActiveSheet()->setTitle("Parte 1");
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment; filename="'.$filename.'"');
      header('Cache-Control: max-age=0');
      $writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
      $writer->save('php://output');
      exit;
      
    }
    if($tipo_cpe == 'dbf') {
      $mes = $_GET['mes'];
      $ano = $_GET['ano'];
      $tipo = $_GET['doc'];
      
  
      require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel.php');
      require(APPPATH.'third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');
      $excel = new PHPExcel();
  
      $excel->getProperties()->setCreator("Escienza");
      $excel->getProperties()->setLastModifiedBy("");
      $excel->getProperties()->setTitle("DBF ".$mes."/".$ano);
      $excel->getProperties()->setSubject("");
      $excel->getProperties()->setDescription("");
      $excel->setActiveSheetIndex(0);
  
      $styleArray = array(
        'font'  => array(
            'bold'  => false,
            'size'  => 10,
            'name'  => 'Arial'
        ));
      
      
      $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
      $excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
      $excel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
      $excel->getActiveSheet()->getColumnDimension('E')->setWidth(17.3);
      $excel->getActiveSheet()->getColumnDimension('F')->setWidth(17.3);
      $excel->getActiveSheet()->getColumnDimension('G')->setWidth(17.3);
      $excel->getActiveSheet()->getColumnDimension('H')->setWidth(17.3);
      $excel->getActiveSheet()->getColumnDimension('I')->setWidth(24);
    //FILA 1
      $excel->getActiveSheet()->SetCellValue('A1','AVANEXO');
      $excel->getActiveSheet()->SetCellValue("B1","ACODANE");
      $excel->getActiveSheet()->SetCellValue("C1","ADESANE");
      $excel->getActiveSheet()->SetCellValue("D1","AREFANE");
      $excel->getActiveSheet()->SetCellValue("E1","ARUC");
      $excel->getActiveSheet()->SetCellValue("F1","ACODMON");
      $excel->getActiveSheet()->SetCellValue("G1","AESTADO");
      $excel->getActiveSheet()->SetCellValue("H1","ADATE");
      $excel->getActiveSheet()->SetCellValue("I1","AHORA");
    
      
      $r = 2;
      if ($tipo=="FACTURA"){
        $data = $this->venta_model->getDataDBF($mes,$ano);
        foreach($data->result() as $row){
          $date = new DateTime($row->fecha);
          $date2 = new DateTime($row->created_at);
          $fecha = $date->format('d/m/Y');
          $hora = $date->format('H:i');
          $excel->getActiveSheet()->SetCellValue('A'.$r, 'C');
          $excel->getActiveSheet()->SetCellValue('B'.$r, $row->ruc);
          $excel->getActiveSheet()->SetCellValue('C'.$r, $row->cliente);
          $excel->getActiveSheet()->SetCellValue('D'.$r, '');
          $excel->getActiveSheet()->SetCellValue('E'.$r, $row->ruc);
          $excel->getActiveSheet()->SetCellValue('F'.$r, 'MN');
          $excel->getActiveSheet()->SetCellValue('G'.$r, 'V');
          $excel->getActiveSheet()->SetCellValue('H'.$r, $fecha);
          $excel->getActiveSheet()->SetCellValue('I'.$r, $hora);
          $r++;
        }
      }
      
      $excel->getActiveSheet()
        ->getStyle("A1:".$excel->getActiveSheet()->getHighestDataColumn().$excel->getActiveSheet()->getHighestDataRow())
        ->getAlignment()
        ->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
      $excel->getActiveSheet()->getStyle("A1:".$excel->getActiveSheet()->getHighestDataColumn().$excel->getActiveSheet()->getHighestDataRow())->applyFromArray($styleArray);
      
      $filename = "DBF_".$tipo."_".$mes."/".$ano.".dbf";
      $excel->getActiveSheet()->setTitle("Parte 1");
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment; filename="'.$filename.'"');
      header('Cache-Control: max-age=0');
      $writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
      $writer->save('php://output');
      exit;
      
    }

  }

}