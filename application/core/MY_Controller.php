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
	public function loadhead($home=false){
        //default
        $this->load->view('templates/header');
		$this->load->view('templates/navbar');

        if ($home===true) {
            $this->load->view('dashboard/dashboard');
        }
	}
	public function loaddown($home=false){
		//default
		$this->load->view('templates/rightsidebar');

		//default
		$this->load->view('templates/footer');

	}
			

	/**
	 * die dump function for testing
	 */

	public function dd($data){
		echo '<pre>';
		print_r($data);
		echo '</pre>';

		exit;
	}

	
}
