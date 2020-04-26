<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
	{
		
		parent::__construct();
		$this->load->database();
		$this->load->helper(['url','url_helper', 'language']);
		$this->load->library(['ion_auth','session', 'form_validation']);

		if (!$this->ion_auth->is_admin())
		{
		  $this->session->set_flashdata('message', 'You must be an admin to view this page');
		  redirect('/');
		}

	}


	/**
	 * load views with header and footer
	 *
	 * main order for loading pages
	 * 1.header
	 * 2.navbar
	 * 3.aside
	 * 4.content-wrapper
	 * 5.aside.control-sidebar
	 * 6.footer
	 * 
	 * 
	 * 
	*/
	public function loadhead($home=false){
        //1.header
		$this->load->view('templates/header');
		
		// 2.navbar
		$this->load->view('templates/navbar');

		// 3.aside
		$this->load->view('templates/rightsidebar');

		//4.contnent
        if ($home===true) {
            $this->load->view('dashboard/dashboard');
		}
		
		//or 4.content
	}
	public function loaddown($home=false){
		//5.controll-sidebar

		// 6.footer
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
