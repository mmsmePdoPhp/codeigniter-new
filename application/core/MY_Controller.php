<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->model('news_model');	
		$this->load->helper('url_helper');
	}

	/**
 	* load views with header and footer
	*/
	public function loadview(Array $views){
		//default
		$this->load->view('templates/header');
		$this->load->view('templates/navbar');
		if(count($views)>0){
			foreach ($views as $key => $view) {
				$this->load->view($view);
			}
		}else{
			$this->load->view('dashboard/dashboard');
		}

		//default
		$this->load->view('templates/rightsidebar');

		//default
		$this->load->view('templates/footer');

	 }

	
}
