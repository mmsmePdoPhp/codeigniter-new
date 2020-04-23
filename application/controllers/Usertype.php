<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usertype extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('usertype_model');	
		$this->load->helper('url_helper');
		$this->load->library('session');
		$this->load->library('form_validation');
		

	}

	/**
	 * get and show all usertypes
	 */
	public function index()
	{
		$data['usertypes'] = $this->usertype_model->set_usertype();
		$this->loadview(['dashboard/usertype/index'], $data);
	}

	/**
	 * get and show all usertypes
	 */
	public function create()
	{

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->loadview(['dashboard/usertype/create']);

	}


	/**
	 * store information new usertype
	 */
	public function store(){
			
	
		$this->form_validation->set_rules(
			'usertype', 'usertype',
			'required|min_length[5]|max_length[12]|is_unique[usertype.userType]',
			array(
					'required'      => 'You have not provided %s.',
					'is_unique'     => 'This %s already exists.'
			)
		);
	
		if ($this->form_validation->run() === FALSE)
		{
			$this->loadview(['dashboard/usertype/create']);
		}
		else
		{
			if($this->usertype_model->set_usertype()){
				//insert success

				//flash session
				$this->session->set_flashdata('insert_success', 'UserType was successfully created!');

				$this->loadview(['dashboard/usertype/index']);
			}else{
				//show error 
				log_message('error', 'Some variable did not contain a value.');
				//redirect to create usertype
				$this->loadview(['dashboard/usertype/create']);
			}

		}
	}

	
}
