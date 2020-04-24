<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usertype extends MY_Controller
{

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
	 * atgrance
	 * active
	 * 
	 */
	public function index(String $tag = 'atglance')
	{
		$tag = trim($tag);

		$re = "/[a-z]/";
		$alpha = (preg_match($re, $tag));

		$re = "/[^a-z]/";
		$notAlphpa = (preg_match($re, $tag));

		//filter length is not greter than 12
		if ($alpha == true && $notAlphpa == false) {

			// $this->dd($this->input->get(null,true));
			switch ($tag) {
				case 'atglance':
					$data['usertypes'] = ($this->usertype_model->get_usertype($tag));
					break;

				case 'active':
					$data['usertypes'] = ($this->usertype_model->get_usertype($tag));
					break;

				case 'notactive':
					$data['usertypes'] = ($this->usertype_model->get_usertype($tag));
					break;

				case 'deleted':
					$data['usertypes'] = ($this->usertype_model->get_usertype($tag));
					break;

				case 'fullinfo':
					$data['usertypes'] = ($this->usertype_model->get_usertype($tag));
					break;
			}

			$data['columns'] = ($this->db->list_fields('usertype'));
		} else {
			echo 'false';
		}
		$this->loadhead();
		$this->load->view('dashboard/usertype/index', $data);
		$this->loaddown();
	}
	public function ajaxindex(String $tag = 'atglance')
	{
		$tag = trim($tag);

		$re = "/[a-z]/";
		$alpha = (preg_match($re, $tag));

		$re = "/[^a-z]/";
		$notAlphpa = (preg_match($re, $tag));

		//filter length is not greter than 12
		if ($alpha == true && $notAlphpa == false) {

			// $this->dd($this->input->get(null,true));
			switch ($tag) {
				case 'atglance':
					$response =  ($this->usertype_model->get_usertype($tag));
					break;

				case 'active':
					$response =  ($this->usertype_model->get_usertype($tag));
					// $response = array('status' => 'OK');

					
					break;

				case 'notactive':
					$response =  ($this->usertype_model->get_usertype($tag));
					break;

				case 'deleted':
					$response =  ($this->usertype_model->get_usertype($tag));
					break;

				case 'fullinfo':
					$response =  ($this->usertype_model->get_usertype($tag));
					break;
			}

			$this->output
				->set_status_header(200)
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
				->_display();
			exit;
		} else {
			echo 'false';
		}
	}
	/**
	 * get and show all usertypes
	 */
	public function create()
	{

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->loadhead();
		$this->load->view('dashboard/usertype/create');
		$this->loaddown();
	}


	/**
	 * store information new usertype
	 */
	public function store()
	{


		$this->form_validation->set_rules(
			'usertype',
			'usertype',
			'required|min_length[5]|max_length[22]|is_unique[usertype.userType]',
			array(
				'required'      => 'You have not provided %s.',
				'is_unique'     => 'This %s already exists.'
			)
		);

		if ($this->form_validation->run() === FALSE) {
			$this->loadhead();
			$this->load->view('dashboard/usertype/create');
			$this->loaddown();
		} else {
			if ($this->usertype_model->set_usertype()) {
				//insert success

				//flash session
				$this->session->set_flashdata('insert_success', 'UserType was successfully created!');

				$this->loadhead();
				$this->load->view('dashboard/usertype/index');
				$this->loaddown();
			} else {
				//show error 
				log_message('error', 'Some variable did not contain a value.');
				//redirect to create usertype
				$this->loadhead();
				$this->load->view('dashboard/usertype/create');
				$this->loaddown();
			}
		}
	}
}
