<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
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
			$this->load->view('/guest/top');
			$this->load->view('productos');
			$this->load->view('/guest/bottom');
    }
    else {
      redirect('auth/login', 'refresh');
    }
	}
	
	public function menu()
	{
		if ($this->ion_auth->logged_in())
    {
			$data = array('prods' => $this->venta_model->getProductos());
      $this->load->view('/layout/top');
		  $this->load->view('menu/producto/index',$data);
			$this->load->view('/layout/bottom');
			
    }
    else {
      redirect('auth/login', 'refresh');
    }
	}

	public function edit($id)
	{
		if ($this->ion_auth->logged_in())
    {
			$data = array('prod' => $this->producto_model->getProductoById($id));
     
			$this->load->view('/layout/top');
		  $this->load->view('/menu/producto/edit',$data);
			$this->load->view('/layout/bottom');
			
    }
    else {
      redirect('auth/login', 'refresh');
    }
	}

	public function update()
	{
		if ($this->ion_auth->logged_in())
    {
			$estado="";
			if($this->input->post("estado")=="true"){
				$estado = "1";
			}else{
				$estado = "0";
			}
			$result =$this->producto_model->editProducto(
				$this->input->post("id"),
				$this->input->post("nombre"),
				$this->input->post("tipo"),
				$this->input->post("precio_venta"),
				$this->input->post("precio_compra"),
				$estado);
			
			redirect('producto/menu', 'refresh');
			
    }
    else {
      redirect('auth/login', 'refresh');
    }
	}
}