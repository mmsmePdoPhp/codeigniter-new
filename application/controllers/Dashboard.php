<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->model('news_model');	
		$this->load->helper('url_helper');
	}

	/**
	 * get and show all usertypes
	 */
	public function index()
	{
		$this->loadview([]);
		
	}

	/**
	 * get and show all usertypes
	 */
	public function create()
	{
		$this->load->view('dashboard/usertype/create');
	}


}

