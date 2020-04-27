<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->load->library('pagination');

	}

	public function index($perPage=0){
		echo $perPage;

		//get informations from users table


		// all staff for pagination page
		$config['base_url'] = base_url().'/users/index';
		$config['total_rows'] = 200;
		$config['per_page'] = 20;
		$config['attributes'] = array('class' => 'btn text-light  hvr-bounce-out bg-custome');
		$config['cur_tag_open'] ='<b class="btn bg-olive  hvr-bounce-out">';
		$config['cur_tag_close'] = '</b>';
		$config['num_tag_open'] = '<span>';
		$config['num_tag_close'] = '<span>';
		$config['num_links'] = 1;
		$config['uri_segment'] = 3;
		$config['next_tag_open'] = '<span  >';
		$config['prev_link'] = 'prev';
		$config['next_link'] = 'next';
		$config['next_tag_close'] = '</span>';

		$this->pagination->initialize($config);

		$data['links'] =  $this->pagination->create_links();

		//send file name script to load
		$data['fileName'] = 'users';
		$this->loadhead();
		$this->load->view('dashboard/users/index',$data);
		$this->loaddown();
	}

	/**
	 * get and show all userss
	 * atgrance
	 * active
	 * 
	 */
	public function indexs(String $tag = 'atglance')
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
					$data['userss'] = ($this->users_model->get_users($tag));
					break;

				case 'active':
					$data['userss'] = ($this->users_model->get_users($tag));
					break;

				case 'notactive':
					$data['userss'] = ($this->users_model->get_users($tag));
					break;

				case 'deleted':
					$data['userss'] = ($this->users_model->get_users($tag));
					break;

				case 'fullinfo':
					$data['userss'] = ($this->users_model->get_users($tag));
					break;
			}

			$data['columns'] = ($this->db->list_fields('users'));
		} else {
			echo 'false';
		}
		$this->loadhead();
		$this->load->view('dashboard/users/index', $data);
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
					($response =  ($this->users_model->get_users($tag)));
					break;

				case 'active':
					$response =  ($this->users_model->get_users($tag));
					// $response = array('status' => 'OK');
					break;

				case 'notactive':
					$response =  ($this->users_model->get_users($tag));
					break;

				case 'deleted':
					$response =  ($this->users_model->get_users($tag));
					break;

				case 'fullinfo':
					$response =  ($this->users_model->get_users($tag));
				break;

				case 'operation':
					$response =  ($this->users_model->get_users($tag));
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
	 * get and show all userss
	 */
	public function create()
	{

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->loadhead();
		$this->load->view('dashboard/users/create');
		$this->loaddown();
	}


	/**
	 * redirect to index page and show information inside it 
	 * filtered by id 
	 * 
	 */
	public function edit($tag)
	{
        $tag = trim($tag);

        $re = "/[0-9]/";
        $numeric = (preg_match($re, $tag));

        $re = "/[^0-9]/";
        $notNumeric = (preg_match($re, $tag));

        //filter length is not greter than 12
        if ($numeric == true && $notNumeric == false) {
            if (($this->users_model->get_users_byId($tag))) {
                //data retured and i.e users is exist in table
                $data['users'] = ($this->users_model->get_users_byId($tag));
            } else {
                //if not exist redirect back
				redirect('/users/index', 'refresh');
            }
        } else {
            echo 'false';
        }
        $this->loadhead();
        $this->load->view('dashboard/users/edit', $data);
        $this->loaddown();
    }
    

	/**
	 * store information new users
	 */
	public function store()
	{


		$this->form_validation->set_rules(
			'users',
			'users',
			'required|min_length[5]|max_length[22]|is_unique[users.users]',
			array(
				'required'      => 'You have not provided %s.',
				'is_unique'     => 'This %s already exists.'
			)
		);

		if ($this->form_validation->run() === FALSE) {
			$this->loadhead();
			$this->load->view('dashboard/users/create');
			$this->loaddown();
		} else {
			if ($this->users_model->set_users()) {
				//insert success

				//flash session
				$this->session->set_flashdata('insert_success', 'users was successfully created!');

				$this->loadhead();
				$this->load->view('dashboard/users/index');
				$this->loaddown();
			} else {
				//show error 
				log_message('error', 'Some variable did not contain a value.');
				//redirect to create users
				$this->loadhead();
				$this->load->view('dashboard/users/create');
				$this->loaddown();
			}
		}
	}

	public function update()
	{
		$this->form_validation->set_rules(
			'users',
			'users',
			'required|min_length[5]|max_length[22]',
			array(
				'required'      => 'You have not provided %s.',
				'is_unique'     => 'This %s already exists.'
			)
		);

		$this->form_validation->set_rules(
			'id',
			'id',
			'required|min_length[1]|max_length[20]',
			array(
				'required'      => 'You have not provided %s.',
			)
		);

		if ($this->form_validation->run() === FALSE) {
			$this->loadhead();
			$this->load->view('dashboard/users/create');
			$this->loaddown();
		} else {
			if ($this->users_model->update_users()) {
				//insert success

				//flash session
				$this->session->set_flashdata('insert_success', 'users was successfully updated!');

				redirect('/users/index', 'refresh');

			} else {
				//set flahMessage 
				$this->session->set_flashdata('insert_error', 'users wasn`t updated!');

				//redirect to create users
				redirect('/users/edit/'.$this->input->post('id'), 'refresh');

			}
		}
	}

	
}
