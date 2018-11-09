<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('calendar_model');
		ini_set('display_errors', 0);
	}

	public function index()
	{
		$data['calendar'] = $this->calendar_model->calendar_landing();
		$this->load->view('landing', $data);
	}
}