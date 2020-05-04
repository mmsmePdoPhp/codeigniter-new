<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('category_model');
		$this->load->library(['ion_auth','session', 'form_validation']);
		$this->load->helper(['url','url_helper', 'language']);

	}

	/**
	 * get and show all categories
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
					$data['categories'] = ($this->category_model->get_categories($tag));
					break;

				case 'active':
					$data['categories'] = ($this->category_model->get_categories($tag));
					break;

				case 'notactive':
					$data['categories'] = ($this->category_model->get_categories($tag));
					break;

				case 'deleted':
					$data['categories'] = ($this->category_model->get_categories($tag));
					break;

				case 'fullinfo':
					$data['categories'] = ($this->category_model->get_categories($tag));
					break;
			}

			$data['columns'] = ($this->db->list_fields('categories'));
		} else {
            echo 'false';
        }

		//send filename script
		$data['fileName'] = 'category';

		//load files
		$this->loadhead();
		$this->load->view('dashboard/categories/index', $data);
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
					$response =  ($this->category_model->get_categories($tag));
					break;

				case 'active':
					$response =  ($this->category_model->get_categories($tag));
					// $response = array('status' => 'OK');

					
					break;

				case 'notactive':
					$response =  ($this->category_model->get_categories($tag));
					break;

				case 'deleted':
					$response =  ($this->category_model->get_categories($tag));
					break;

				case 'fullinfo':
					$response =  ($this->category_model->get_categories($tag));
				break;

				case 'operation':
					$response =  ($this->category_model->get_categories($tag));
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
	 * get and show all categories
	 */
	public function create()
	{

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->loadhead();
		$this->load->view('dashboard/categories/create');
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
            if (($this->category_model->get_categories_byId($tag))) {
                //data retured and i.e categories is exist in table
                $data['categories'] = ($this->category_model->get_categories_byId($tag));
            } else {
                //if not exist redirect back
				redirect('/category/index', 'refresh');
            }
        } else {
            echo 'false';
        }
        $this->loadhead();
        $this->load->view('dashboard/categories/edit', $data);
        $this->loaddown();
    }
	
	
	
	/**
	 * delete category == soft delete on table
	 *  set deleted_at to current time
	 * tag here is equal to => (categories.id)
	 * get id category by post
	 */
	public function delete()
	{
		//first -> validate value
        $this->form_validation->set_rules(
			'id',
			'id',
			'required|numeric',
			array(
				'required'      => 'You have not provided %s.',
				'numeric'      => 'delete category was denied!. %s.',
			)
		);

		// $this->dd('is successed');

        //filter length is not greter than 12
		if (($this->category_model->delete_categories())) {
			//redirect and flash messaage deleted
			$this->session->set_flashdata('insert_success', 'categories was successfully deleted!');

			redirect('/category/index', 'refresh');
		} else {
			//does not deleted row or Error accured...
			$this->session->set_flashdata('insert_error', 'categories does not deleted!');

			redirect('/category/index', 'refresh');
		}


	}
	

	/**
	 * resotre category by id
	 */
	public function restore()
	{
		//first -> validate value
        $this->form_validation->set_rules(
			'id',
			'id',
			'required|numeric',
			array(
				'required'      => 'You have not provided %s.',
				'numeric'      => 'delete category was denied!. %s.',
			)
		);

		// $this->dd('is successed');

        //filter length is not greter than 12
		if (($this->category_model->restore_categories())) {
			//redirect and flash messaage deleted
			$this->session->set_flashdata('insert_success', 'categories was successfully restored!');

			redirect('/category/index', 'refresh');
		} else {
			//does not deleted row or Error accured...
			$this->session->set_flashdata('insert_error', 'categories does not restored!');

			redirect('/category/index', 'refresh');
		}


    }


	/**
	 * store information new categories
	 */
	public function store()
	{

		$this->form_validation->set_rules(
			'name',
			'name',
			'required|min_length[5]|max_length[22]|is_unique[categories.name]',
			array(
				'required'      => 'You have not provided %s.',
				'is_unique'     => 'This %s already exists.'
			)
		);

		$this->form_validation->set_rules(
			'description',
			'description',
			'required|min_length[10]|max_length[100]',
			array(
				'required'      => 'You have not provided %s.',
				'is_unique'     => 'This %s already exists.'
			)
		);

		if ($this->form_validation->run() === FALSE) {
			$this->loadhead();
			$this->load->view('dashboard/categories/create');
			$this->loaddown();
		} else {
			if ($this->category_model->set_categories()) {
				//insert success

				//flash session
				$this->session->set_flashdata('insert_success', 'categories was successfully created!');

				redirect('category/index', 'refresh');
				
			} else {
				//show error 
				log_message('error', 'Some variable did not contain a value.');
				//redirect to create category
				redirect('category/create', 'refresh');

			}
		}
	}

	public function update()
	{
		// filter name field
		$this->form_validation->set_rules(
			'name',
			'name',
			'required|min_length[5]|max_length[22]',
			array(
				'required'      => 'You have not provided %s.',
				'is_unique'     => 'This %s already exists.'
			)
		);
		
		// filter description field
		$this->form_validation->set_rules(
			'description',
			'description',
			'required|min_length[15]|max_length[99]',
			array(
				'required'      => 'You have not provided %s.',
				'is_unique'     => 'This %s already exists.'
			)
		);

		//filter id field
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
			$this->load->view('dashboard/categories/edit');
			$this->loaddown();
		} else {
			if ($this->category_model->update_categories()) {
				//insert success

				//flash session
				$this->session->set_flashdata('insert_success', 'categories was successfully updated!');

				redirect('/category/index', 'refresh');

			} else {
				//set flahMessage 
				$this->session->set_flashdata('insert_error', 'categories wasn`t updated!');

				//redirect to create categories
				redirect('/category/edit/'.$this->input->post('id'), 'refresh');

			}
		}
	}

	
}
