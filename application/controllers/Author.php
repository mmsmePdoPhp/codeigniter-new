<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Author extends MY_Controller
{
	protected $imagePath;
	public function __construct()
	{
		parent::__construct();
		$this->load->model('author_model');
		$this->load->library('pagination');
	}

	public function index($perPage = 0)
	{
		// echo ($this->author_model->get_author('atglance',$perPage));
		// $this->dd($this->author_model->get_author('atglance',$perPage));


		//send file name script to load
		$data['fileName'] = 'author';

		$this->loadhead();
		$this->load->view('dashboard/author/index', $data);
		$this->loaddown();
	}

	/**
	 * get and show all authors
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
					$data['authors'] = ($this->author_model->get_author($tag));
					break;

				case 'active':
					$data['authors'] = ($this->author_model->get_author($tag));
					break;

				case 'notactive':
					$data['authors'] = ($this->author_model->get_author($tag));
					break;

				case 'deleted':
					$data['authors'] = ($this->author_model->get_author($tag));
					break;

				case 'fullinfo':
					$data['authors'] = ($this->author_model->get_author($tag));
					break;
			}

			$data['columns'] = ($this->db->list_fields('author'));
		} else {
			echo 'false';
		}
		$this->loadhead();
		$this->load->view('dashboard/author/index', $data);
		$this->loaddown();
	}

	//return authors with filter by ajax and json response
	public function ajaxindex(String $tag = 'atglance', $perPage = 0)
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
					($response =  ($this->author_model->get_author($tag, $perPage)));
					break;

				case 'active':
					$response =  ($this->author_model->get_author($tag, $perPage));
					// $response = array('status' => 'OK');
					break;

				case 'notactive':
					$response =  ($this->author_model->get_author($tag, $perPage));
					break;

				case 'deleted':
					$response =  ($this->author_model->get_author($tag, $perPage));
					break;

				case 'fullinfo':
					$response =  ($this->author_model->get_author($tag, $perPage));
					break;

				case 'operation':
					$response =  ($this->author_model->get_author($tag, $perPage));
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



	//return authors with filter by ajax and json response
	public function rowCount(String $tag = 'atglance')
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
					($response =  ($this->author_model->get_count_author($tag)));
					break;

				case 'active':
					$response =  ($this->author_model->get_count_author($tag));
					// $response = array('status' => 'OK');
					break;

				case 'notactive':
					$response =  ($this->author_model->get_count_author($tag));
					break;

				case 'deleted':
					$response =  ($this->author_model->get_count_author($tag));
					break;

				case 'fullinfo':
					$response =  ($this->author_model->get_count_author($tag));
					break;

				case 'operation':
					$response =  ($this->author_model->get_count_author($tag));
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
	 * get and show all authors
	 */
	public function create()
	{

		// $this->load->helper('form');
		// $this->load->library('form_validation');

		$this->loadhead();
		$this->load->view('dashboard/author/create');
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
			if (($this->author_model->get_author_byId($tag))) {
				//data retured and i.e author is exist in table
				$data['author'] = ($this->author_model->get_author_byId($tag));
			} else {
				//if not exist redirect back
				redirect('/author/index', 'refresh');
			}
		} else {
			echo 'false';
		}
		$this->loadhead();
		$this->load->view('dashboard/author/edit', $data);
		$this->loaddown();
	}


	/**
	 * store information new author
	 */
	public function store()
	{
		$this->load->library('image_lib');


		$this->form_validation->set_rules(
			'first_name',
			'FirstName',
			'required|min_length[5]|max_length[22]',
			array(
				'required'      => 'You have not provided %s.',
				'is_unique'     => 'This %s already exists.'
			)
		);

		$this->form_validation->set_rules(
			'last_name',
			'LastName',
			'required|min_length[5]|max_length[22]',
			array(
				'required'      => 'You have not provided %s.',
				'is_unique'     => 'This %s already exists.'
			)
		);

		$this->form_validation->set_rules(
			'email',
			'email',
			'required|valid_email|min_length[5]|max_length[40]|is_unique[authors.email]',
			array(
				'required'      => 'You have not provided %s.',
				'is_unique'     => 'This %s already exists.'
			)
		);

		$this->form_validation->set_rules(
			'country',
			'country',
			'required|alpha|min_length[3]|max_length[25]',
			array(
				'required'      => 'You have not provided %s.',
			)
		);

		$this->form_validation->set_rules(
			'city',
			'city',
			'required|alpha|min_length[3]|max_length[25]',
			array(
				'required'      => 'You have not provided %s.',
			)
		);

		$this->form_validation->set_rules(
			'about',
			'about',
			'required|min_length[50]|max_length[450]',
			array(
				'required'      => 'You have not provided %s.',
			)
		);

		$this->form_validation->set_rules(
			'age',
			'age',
			'required|numeric|is_natural|min_length[2]|max_length[5]',
			array(
				'required'      => 'You have not provided %s.',
			)
		);


		$this->form_validation->set_rules(
			'university',
			'university',
			'required|alpha|min_length[3]|max_length[35]',
			array(
				'required'      => 'You have not provided %s.',
			)
		);


		$this->form_validation->set_rules(
			'publisher',
			'publisher',
			'required|alpha|min_length[5]|max_length[65]',
			array(
				'required'      => 'You have not provided %s.',
			)
		);




		if ($this->form_validation->run() === FALSE) {
			$this->loadhead();
			$this->load->view('dashboard/author/create');
			$this->loaddown();
		} else {
			// validate upload file
			$this->form_validation->set_rules('image', 'File', 'trim|xss_clean');

			$config['upload_path']          = 'uploads/authors/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 100;
			$config['max_width']            = 1024;
			$config['max_height']           = 768;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('image')) {
				$error = array('error' => $this->upload->display_errors());

				// $this->load->view('upload_form', $error);
				$this->loadhead();
				$this->load->view('dashboard/author/create', $error);
				$this->loaddown();
				return;
			} else {
				//if file does not exist upload it
				$this->imagePath = (basename(dirname($this->upload->data('full_path'))) . '/' . $this->upload->data('file_name'));

				// $data = array('upload_data' => $this->upload->data());
				// $this->dd($data['upload_data']['file_name']);

				// $this->load->view('upload_success', $data);
			}



			if ($this->author_model->set_author($this->imagePath)) {
				//insert success

				//flash session
				$this->session->set_flashdata('insert_success', 'author was successfully created!');

				redirect('author/index', 'refresh');
			} else {
				//show error 
				log_message('error', 'Some variable did not contain a value.');
				//redirect to create author
				$this->loadhead();
				$this->load->view('dashboard/author/create');
				$this->loaddown();
			}
		}
	}

	public function update()
	{
		$this->form_validation->set_rules(
			'author',
			'author',
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
			$this->load->view('dashboard/author/create');
			$this->loaddown();
		} else {
			if ($this->author_model->update_author()) {
				//insert success

				//flash session
				$this->session->set_flashdata('insert_success', 'author was successfully updated!');

				redirect('/author/index', 'refresh');
			} else {
				//set flahMessage 
				$this->session->set_flashdata('insert_error', 'author wasn`t updated!');

				//redirect to create author
				redirect('/author/edit/' . $this->input->post('id'), 'refresh');
			}
		}
	}
}
