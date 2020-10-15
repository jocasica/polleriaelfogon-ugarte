<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Turno extends CI_Controller {

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
			$data = array('turno' => $this->venta_model->getTurnoActual(),
							'maquinas' => $this->venta_model->getMaquinas());
			$data['usuarios'] = $this->venta_model->getUsuarios();
      $this->load->view('/layout/top');
		  $this->load->view('menu/turno/index',$data);
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
			//$data = array('prod' => $this->producto_model->getProductoById($id));
			$data = array('turno' => $this->venta_model->getUltimoTurno());
			$data['maquinas'] = $this->venta_model->getMaquinas();
			$this->load->view('/layout/top');
		  $this->load->view('/menu/turno/create',$data);
			$this->load->view('/layout/bottom');
			
    }
    else {
      redirect('auth/login', 'refresh');
    }
	}

	public function post()
	{
		if ($this->ion_auth->logged_in())
    {
			$turno = $this->venta_model->getTurnoActual();
			if($turno == null){
				$data = $_POST;
				$maquina_ids = $this->input->post('maquina_id');
      	$contometro_llegadas = $this->input->post('contometro_llegada');
				$t = array(
					'id'      => '',
					'estado'  =>  '1',
					'hora_llegada' => date('Y-m-d H:i:s'),
					'dinero_llegada' => $data['dinero_efectivo']
				);
				$tu = array(
					'id'		=>	'',
					'usuario_id'	=> $this->ion_auth->user()->row()->id,
					'turno_id' 	=>	'',
					'hora_llegada'	=>	$t['hora_llegada'],
					'lugar'	=>	'1'
				);
				$turno_id = $this->venta_model->insertTurno($t,$tu);
				if($this->venta_model->getCantidadTurnos()->numero>1)
				{
					$this->venta_model->guardarContometroSalida($turno_id);
				}else{
					for($x = 0; $x < sizeof($maquina_ids); $x++){
						$c[$x] = array(
								'maquina_id'=> $maquina_ids[$x],
								'turno_id'=> $turno_id,
								'contometro_llegada' => $contometro_llegadas[$x]
						);
					}
					$this->venta_model->regContometros($c);
				}
								
				redirect('turno', 'refresh');
			}
			else
			{
				redirect('turno', 'refresh');
			}
    }
    else {
      redirect('auth/login', 'refresh');
    }
	}

	public function add_companero($id)
	{
		if ($this->ion_auth->logged_in())
    {
			
			$data = array('usuarios' => $this->venta_model->getUsuarios());
			$this->load->view('/layout/top');
		  $this->load->view('/menu/turno/add_companero',$data);
			$this->load->view('/layout/bottom');
			
    }
    else {
      redirect('auth/login', 'refresh');
    }
	}

	public function post_companero()
	{
		if ($this->ion_auth->logged_in())
    {
			$data = $_POST;
				$tu = array(
					'id'		=>	'',
					'usuario_id'	=> $data['usuario_id'],
					'turno_id' 	=>	$data['turno_id'],
					'hora_llegada'	=>	$data['hora_llegada'],
					'lugar'	=>	''
				);
				$this->venta_model->insertTurnoUsuario($tu);
				redirect('turno', 'refresh');
    }
    else {
      redirect('auth/login', 'refresh');
    }
	}

	public function post_terminar_turno()
	{
		if ($this->ion_auth->logged_in())
    {
				$data = $_POST;
				$maquina_ids = $this->input->post('maquina_id');
      	$contometro_salidas = $this->input->post('contometro_salida');
				$this->venta_model->updateTerminarTurno($data['turno_id'],date('Y-m-d H:i:s'));
				
				for($x = 0; $x < sizeof($maquina_ids); $x++){
					$c[$x] = array(
							'maquina_id'=> $maquina_ids[$x],
							'turno_id'=> $data['turno_id'],
							'contometro_llegada' => $contometro_salidas[$x]
					);
					$this->venta_model->registrarContometroSalida($data['turno_id'],$maquina_ids[$x],$contometro_salidas[$x]);
				}
				redirect('turno', 'refresh');
    }
    else {
      redirect('auth/login', 'refresh');
    }
	}

}