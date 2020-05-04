<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tag extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['tag_model','category_model']);
		$this->load->library(['ion_auth','session', 'form_validation']);
		$this->load->helper(['url','url_helper', 'language']);

	}

	/**
	 * get and show all tags
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
					$data['tags'] = ($this->tag_model->get_tags($tag));
					break;

				case 'active':
					$data['tags'] = ($this->tag_model->get_tags($tag));
					break;

				case 'notactive':
					$data['tags'] = ($this->tag_model->get_tags($tag));
					break;

				case 'deleted':
					$data['tags'] = ($this->tag_model->get_tags($tag));
					break;

				case 'fullinfo':
					$data['tags'] = ($this->tag_model->get_tags($tag));
					break;
			}

			$data['columns'] = ($this->db->list_fields('tags'));
		} else {
            echo 'false';
        }

		//send filename script
		$data['fileName'] = 'tag';

		//load files
		$this->loadhead();
		$this->load->view('dashboard/tags/index', $data);
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
					$response =  ($this->tag_model->get_tags($tag));
					break;

				case 'active':
					$response =  ($this->tag_model->get_tags($tag));
					// $response = array('status' => 'OK');

					
					break;

				case 'notactive':
					$response =  ($this->tag_model->get_tags($tag));
					break;

				case 'deleted':
					$response =  ($this->tag_model->get_tags($tag));
					break;

				case 'fullinfo':
					$response =  ($this->tag_model->get_tags($tag));
				break;

				case 'operation':
					$response =  ($this->tag_model->get_tags($tag));
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
	 * get and show all tags
	 */
	public function create()
	{

		$data['categories'] = ( $this->category_model->get_categories('atglance') );
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->loadhead();
		$this->load->view('dashboard/tags/create',$data);
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
            if (($this->tag_model->get_tags_byId($tag))) {
                //data retured and i.e tags is exist in table
				$data['tags'] = ($this->tag_model->get_tags_byId($tag));
				$data['categories'] = ( $this->category_model->get_categories('atglance') );
				
            } else {
                //if not exist redirect back
				redirect('/tag/index', 'refresh');
            }
        } else {
            echo 'false';
        }
        $this->loadhead();
        $this->load->view('dashboard/tags/edit', $data);
        $this->loaddown();
    }
	
	
	
	/**
	 * delete tag == soft delete on table
	 *  set deleted_at to current time
	 * tag here is equal to => (tags.id)
	 * get id tag by post
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
				'numeric'      => 'delete tag was denied!. %s.',
			)
		);

		// $this->dd('is successed');

        //filter length is not greter than 12
		if (($this->tag_model->delete_tags())) {
			//redirect and flash messaage deleted
			$this->session->set_flashdata('insert_success', 'tags was successfully deleted!');

			redirect('/tag/index', 'refresh');
		} else {
			//does not deleted row or Error accured...
			$this->session->set_flashdata('insert_error', 'tags does not deleted!');

			redirect('/tag/index', 'refresh');
		}


	}
	

	/**
	 * resotre tag by id
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
				'numeric'      => 'delete tag was denied!. %s.',
			)
		);

		// $this->dd('is successed');

        //filter length is not greter than 12
		if (($this->tag_model->restore_tags())) {
			//redirect and flash messaage deleted
			$this->session->set_flashdata('insert_success', 'tags was successfully restored!');

			redirect('/tag/index', 'refresh');
		} else {
			//does not deleted row or Error accured...
			$this->session->set_flashdata('insert_error', 'tags does not restored!');

			redirect('/tag/index', 'refresh');
		}


    }


	/**
	 * store information new tags
	 */
	public function store()
	{

		$this->form_validation->set_rules(
			'name',
			'name',
			'required|min_length[3]|max_length[22]|is_unique[tags.name]',
			array(
				'required'      => 'You have not provided %s.',
				'is_unique'     => 'This %s already exists.'
			)
		);

		$this->form_validation->set_rules(
			'category',
			'category',
			'required|numeric|min_length[1]|max_length[20]',
			array(
				'required'      => 'You have not provided %s.',
			)
		);

		if ($this->form_validation->run() === FALSE) {
			$this->loadhead();
			$this->load->view('dashboard/tags/create');
			$this->loaddown();
		} else {
			if ($this->tag_model->set_tags()) {
				//insert success

				//flash session
				$this->session->set_flashdata('insert_success', 'tags was successfully created!');

				redirect('tag/index', 'refresh');
				
			} else {
				//show error 
				log_message('error', 'Some variable did not contain a value.');
				//redirect to create tag
				redirect('tag/create', 'refresh');

			}
		}
	}

	public function update()
	{
		$this->form_validation->set_rules(
			'name',
			'name',
			'required|min_length[3]|max_length[22]',
			array(
				'required'      => 'You have not provided %s.',
				'is_unique'     => 'This %s already exists.'
			)
		);

		$this->form_validation->set_rules(
			'category',
			'category',
			'required|numeric|min_length[1]|max_length[20]',
			array(
				'required'      => 'You have not provided %s.',
			)
		);

		if ($this->form_validation->run() === FALSE) {
			// $data['tags'] = ($this->tag_model->get_tags_byId($tag));

			$data['categories'] = ( $this->category_model->get_categories('atglance') );

			$this->loadhead();
			$this->load->view('dashboard/tags/edit',$data);
			$this->loaddown();
		} else {
			if ($this->tag_model->update_tags()) {
				//insert success

				//flash session
				$this->session->set_flashdata('insert_success', 'tags was successfully updated!');

				redirect('/tag/index', 'refresh');

			} else {
				//set flahMessage 
				$this->session->set_flashdata('insert_error', 'tags wasn`t updated!');

				//redirect to create tags
				redirect('/tag/edit/'.$this->input->post('id'), 'refresh');

			}
		}
	}

	
}
