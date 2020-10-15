<?php
defined('BASEPATH') OR exit('No direct script access allowed');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Item extends CI_Controller {
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
			$data = array('items' => $this->venta_model->getItems());
			$this->load->view('/layout/top');
			$this->load->view('menu/item/index',$data);
			$this->load->view('/layout/bottom');
    }
		else {
			redirect('auth/login', 'refresh');
		}
	}
}