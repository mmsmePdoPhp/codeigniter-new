<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Group extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('group_model');
		$this->load->library(['ion_auth','session', 'form_validation']);
		$this->load->helper(['url','url_helper', 'language']);

	}

	/**
	 * get and show all groupss
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
					$data['groupss'] = ($this->group_model->get_groups($tag));
					break;

				case 'active':
					$data['groupss'] = ($this->group_model->get_groups($tag));
					break;

				case 'notactive':
					$data['groupss'] = ($this->group_model->get_groups($tag));
					break;

				case 'deleted':
					$data['groupss'] = ($this->group_model->get_groups($tag));
					break;

				case 'fullinfo':
					$data['groupss'] = ($this->group_model->get_groups($tag));
					break;
			}

			$data['columns'] = ($this->db->list_fields('groups'));
		} else {
			echo 'false';
		}
		$this->loadhead();
		$this->load->view('dashboard/groups/index', $data);
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
					$response =  ($this->group_model->get_groups($tag));
					break;

				case 'active':
					$response =  ($this->group_model->get_groups($tag));
					// $response = array('status' => 'OK');

					
					break;

				case 'notactive':
					$response =  ($this->group_model->get_groups($tag));
					break;

				case 'deleted':
					$response =  ($this->group_model->get_groups($tag));
					break;

				case 'fullinfo':
					$response =  ($this->group_model->get_groups($tag));
				break;

				case 'operation':
					$response =  ($this->group_model->get_groups($tag));
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
	 * get and show all groupss
	 */
	public function create()
	{

		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->loadhead();
		$this->load->view('dashboard/groups/create');
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
            if (($this->group_model->get_groups_byId($tag))) {
                //data retured and i.e groups is exist in table
                $data['groups'] = ($this->group_model->get_groups_byId($tag));
            } else {
                //if not exist redirect back
				redirect('/groups/index', 'refresh');
            }
        } else {
            echo 'false';
        }
        $this->loadhead();
        $this->load->view('dashboard/groups/edit', $data);
        $this->loaddown();
    }
	
	
	
	/**
	 * delete group == soft delete on table
	 *  set deleted_at to current time
	 * tag here is equal to => (groups.id)
	 * get id group by post
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
				'numeric'      => 'delete group was denied!. %s.',
			)
		);

		// $this->dd('is successed');

        //filter length is not greter than 12
		if (($this->group_model->delete_groups())) {
			//redirect and flash messaage deleted
			$this->session->set_flashdata('insert_success', 'groups was successfully deleted!');

			redirect('/group/index', 'refresh');
		} else {
			//does not deleted row or Error accured...
			$this->session->set_flashdata('insert_error', 'groups does not deleted!');

			redirect('/group/index', 'refresh');
		}


	}
	

	/**
	 * resotre group by id
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
				'numeric'      => 'delete group was denied!. %s.',
			)
		);

		// $this->dd('is successed');

        //filter length is not greter than 12
		if (($this->group_model->restore_groups())) {
			//redirect and flash messaage deleted
			$this->session->set_flashdata('insert_success', 'groups was successfully restored!');

			redirect('/group/index', 'refresh');
		} else {
			//does not deleted row or Error accured...
			$this->session->set_flashdata('insert_error', 'groups does not restored!');

			redirect('/group/index', 'refresh');
		}


    }


	/**
	 * store information new groups
	 */
	public function store()
	{


		$this->form_validation->set_rules(
			'name',
			'name',
			'required|min_length[5]|max_length[22]|is_unique[groups.name]',
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
			$this->load->view('dashboard/groups/create');
			$this->loaddown();
		} else {
			if ($this->group_model->set_groups()) {
				//insert success

				//flash session
				$this->session->set_flashdata('insert_success', 'groups was successfully created!');

				redirect('group/index', 'refresh');
				
			} else {
				//show error 
				log_message('error', 'Some variable did not contain a value.');
				//redirect to create group
				redirect('group/create', 'refresh');

			}
		}
	}

	public function update()
	{
		$this->form_validation->set_rules(
			'groups',
			'groups',
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
			$this->load->view('dashboard/groups/create');
			$this->loaddown();
		} else {
			if ($this->group_model->update_groups()) {
				//insert success

				//flash session
				$this->session->set_flashdata('insert_success', 'groups was successfully updated!');

				redirect('/groups/index', 'refresh');

			} else {
				//set flahMessage 
				$this->session->set_flashdata('insert_error', 'groups wasn`t updated!');

				//redirect to create groups
				redirect('/groups/edit/'.$this->input->post('id'), 'refresh');

			}
		}
	}

	
}
