<?php
defined('BASEPATH') OR exit('No direct script access allowed');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Venta extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('ion_auth', 'form_validation'));
		$this->load->helper(array('url', 'language'));

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
	}
	public function imprimir()
	{
	    $this->load->library('mike');
        $mike = $this->mike;
        $mike->imprimirTicket();
        redirect('venta', 'refresh');
	}
	public function index()
	{
		if ($this->ion_auth->logged_in())
    {
			$data = array('ventas' => $this->venta_model->getVentas(),
										'prods' => $this->venta_model->getProductos(),
		                'registro_pollo' =>$this->venta_model->getRegistroItemPolloHoy());
			$this->load->view('/layout/top');
			$this->load->view('menu/venta/index',$data);
			$this->load->view('/layout/bottom');
    }
		else {
			redirect('auth/login', 'refresh');
		}
	}
	public function listado()
	{
		if ($this->ion_auth->logged_in())
    {
			$data = array('ventas' => $this->venta_model->getVentas(),
										'registro_pollo' =>$this->venta_model->getRegistroItemPolloHoy());
			$this->load->view('/layout/top');
			$this->load->view('menu/venta/listado',$data);
			$this->load->view('/layout/bottom');
			
    }
		else {
			redirect('auth/login', 'refresh');
		}
  }
	public function create()
	{
		if ($this->ion_auth->logged_in())
    {
			$data = array(
				'mozos' => $this->venta_model->getMozos(),
				'pollo' => $this->venta_model->getItemPollo(),
				'productos' => $this->venta_model->getProductos()
			);
			$this->load->view('/layout/top');
			$this->load->view('menu/venta/create',$data);
			$this->load->view('/layout/bottom');
			
    }
		else {
			redirect('auth/login', 'refresh');
		}
	}
	public function show($venta_id)
	{
		if ($this->ion_auth->logged_in())
    {
			$data = array(
				'venta_productos' => $this->venta_model->getProductosVenta($venta_id),
				'productos' => $this->venta_model->getProductos(),
				'mozos' => $this->venta_model->getMozos(),
				'venta' => $this->venta_model->getDatosVenta($venta_id)
			);
			$this->load->view('/layout/top');
			$this->load->view('menu/venta/show',$data);
			$this->load->view('/layout/bottom');
			
    }
		else {
			redirect('auth/login', 'refresh');
		}
  }
  public function postRegistroPollo()
	{
		if ($this->ion_auth->logged_in())
    {
			$ri = array(
	      'id'      => '',
	      'item_id' => 1,
	      'cantidad' => $this->input->post('cantidad_pollo'),
	      'fecha' => date('Y-m-d'),
	      'created_at' => date('Y-m-d H:i:s')
	    );
	    $this->venta_model->crearRegistroItem($ri);
	    redirect('venta', 'refresh');
    }
		else {
			redirect('auth/login', 'refresh');
		}
  }
  public function post()
	{
		$id = $_GET['id'];
    $cantidad = $_GET['cantidad'];
		if ($this->ion_auth->logged_in())
		{
			$data = $_POST;
			$precio = $this->venta_model->getPrecioProducto($id);
			$v = array(
	      'id'      => '',
				'producto_id' => $id,
				'precio_unidad' => $precio,
				'cantidad' => $cantidad,
				'total' => $precio*$cantidad,
	      'estado'  =>  '1',// activo (sin terminar)
	      'created_at' => date('Y-m-d H:i:s')
	    );

			$venta_id = $this->venta_model->crearVenta($v);
			
			 $datos = $this->venta_model->getDatosTicket($venta_id);
			 
			 echo json_encode($datos);
			
		//	redirect('prueba?tipo=ticket&id='.$venta_id, 'refresh');

			
			
			
		}
		else {
			redirect('auth/login', 'refresh');
		}
	}
}