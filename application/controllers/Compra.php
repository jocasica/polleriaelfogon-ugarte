

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Compra extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('ion_auth', 'form_validation'));
		$this->load->helper(array('url', 'language'));
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->lang->load('auth');
	}
	public function index()
	{
		if ($this->ion_auth->logged_in())
    {
			$data = array('compras_insumos' => $this->venta_model->getComprasInsumos(),
		                'compras_items' =>$this->venta_model->getComprasItems());
			$this->load->view('/layout/top');
			$this->load->view('menu/compra/index',$data);
			$this->load->view('/layout/bottom');
    }
		else {
			redirect('auth/login', 'refresh');
		}
	}
	public function create_insumo()
	{
		if ($this->ion_auth->logged_in())
    {
			$data = array(
				'insumos' => $this->venta_model->getInsumos()
			);
			$this->load->view('/layout/top');
			$this->load->view('menu/compra/create_insumo',$data);
			$this->load->view('/layout/bottom');
		}
		else {
			redirect('auth/login', 'refresh');
		}
  }
  public function create_item()
	{
		if ($this->ion_auth->logged_in())
    {
			$data = array(
				'items' => $this->venta_model->getItems()
			);
			$this->load->view('/layout/top');
			$this->load->view('menu/compra/create_item',$data);
			$this->load->view('/layout/bottom');
		}
		else {
			redirect('auth/login', 'refresh');
		}
  }
  public function post_insumo()
	{
		if ($this->ion_auth->logged_in())
    {
			$c = array(
	      'id'      => '',
	      'users_id' =>  $this->ion_auth->user()->row()->id,
	      'fecha' => $this->input->post('fecha'),
	      'estado'  =>  '1',
	      'created_at' => date('Y-m-d H:i:s')
	    );

			$compra_id = $this->venta_model->crearCompra($c);
			$insumo_id_s = $this->input->post('producto_id');
	    $precio_unidad_s = $this->input->post('precio_unidad');
	    $cantidad_s = $this->input->post('cantidad');
	    $total_s = $this->input->post('total');

			for($x = 0; $x < sizeof($insumo_id_s); $x++){
	      $ci[$x] = array(
	          'compra_id'=> $compra_id,
	          'insumo_id'=> $insumo_id_s[$x],
	          'precio_unidad' => $precio_unidad_s[$x],
	          'cantidad' => $cantidad_s[$x],
	          'total' => $total_s[$x]
				);
				$this->venta_model->sumarStockInsumo($insumo_id_s[$x],$cantidad_s[$x]);
	    }
			$this->venta_model->crearCompraInsumo($ci);
			redirect('compra', 'refresh');
		}
		else {
			redirect('auth/login', 'refresh');
		}
  }
  public function post_item()
	{
		if ($this->ion_auth->logged_in())
    {
			$c = array(
	      'id'      => '',
	      'users_id' =>  $this->ion_auth->user()->row()->id,
	      'fecha' => $this->input->post('fecha'),
	      'estado'  =>  '1',
	      'created_at' => date('Y-m-d H:i:s')
	    );

			$compra_id = $this->venta_model->crearCompra($c);
			$item_id_s = $this->input->post('producto_id');
	    $precio_unidad_s = $this->input->post('precio_unidad');
	    $cantidad_s = $this->input->post('cantidad');
	    $total_s = $this->input->post('total');

			for($x = 0; $x < sizeof($item_id_s); $x++){
	      $ci[$x] = array(
	          'compra_id'=> $compra_id,
	          'item_id'=> $item_id_s[$x],
	          'precio_unidad' => $precio_unidad_s[$x],
	          'cantidad' => $cantidad_s[$x],
	          'total' => $total_s[$x]
	      );
	      $this->venta_model->sumarStockItem($item_id_s[$x], $cantidad_s[$x]);
	    }
			$this->venta_model->crearCompraItem($ci);
			redirect('compra', 'refresh');
		}
		else {
			redirect('auth/login', 'refresh');
		}
  }
  public function postTerminarVenta($venta_id)
	{
		if ($this->ion_auth->logged_in())
    {
    	$dinero_recibido = $this->input->post('dinero_recibido');
    	$dinero_vuelto = $this->input->post('dinero_vuelto');
    	$ended_at = date('Y-m-d H:i:s');

	    $this->venta_model->terminarVenta($venta_id, $dinero_recibido, $dinero_vuelto, $ended_at);
	    redirect('venta', 'refresh');
    }
		else {
			redirect('auth/login', 'refresh');
		}
  }
  
}