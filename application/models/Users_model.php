<?php
class Users_model extends MY_Model
{

	public function __construct()
	{
		$this->load->database();
		$this->load->helper('url');
	}

	/***
	 * set new user type in database if not exists
	 */
	public function set_users()
	{
		$data = array(
			'users' => $this->input->post('users'),
			'isactive' => $this->input->post('isactive') == 'on' ? 1 : 0,
		);

		//if users not exsit insert
		$query = $this->db->get_where('users', array('users' => $data['users']));
		if ($query->row_array()) {
			//show errow
			return false;
		} else {
			//insert data
			return $this->db->insert('users', $data);
		}
	}
	
	/***
	 * set new user type in database if not exists
	 */
	public function update_users()
	{
		$data = array(
			'id' => $this->input->post('id'),
			'users' => $this->input->post('users'),
			'isactive' => $this->input->post('isactive') == 'on' ? 1 : 0,
		);

		//if users not exsit insert
		$query = $this->db->get_where('users', array('id' => $data['id']));
		if ($query->row_array()) {
			//if exist update 
			return $this->db->replace('users', $data);
			
		} else {
			return false; // return false for handle error and redirect user
		}
	}
	/**
	 * get all userss
	 */
	public function get_users($tag)
	{
		switch ($tag) {
			case 'atglance':
				$this->db->select('id,users,isActive,created_at');
			break;

			case 'active':
				$this->db->select('id,users,isActive,created_at,updated_at,deleted_at');
				$this->db->where('isActive', 1); // Produces: WHERE name = 'Joe'

			break;

			case 'notactive':
				$this->db->select('id,users,isActive,created_at,updated_at,deleted_at');
				$this->db->where('isActive', 0); // Produces: WHERE name = 'Joe'

			break;

			case 'deleted':
				$this->db->select('id,users,isActive,deleted_at');
				$this->db->where('deleted_at IS NOT NULL'); // Produces: WHERE name = 'Joe'

			break;

			case 'fullinfo':
				$this->db->select('id,users,isActive,created_at,updated_at,deleted_at');
			break;
			
			default:case 'operation':
				$this->db->select('id,users');
			break;
			
				$this->db->select('id,users,isActive,created_at,updated_at,deleted_at');
			break;
		}

		$query = $this->db->get('users');

		if (count($query->result())) {
			//show information
			return $query->result();
		} else {
			//return false for controll logic
			return false;
		}
	}
	
	/**
	 * get one  userss by its id
	 */
	public function get_users_byId($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id); // Produces: WHERE name = 'Joe'

		$query = $this->db->get('users');

		if (count($query->result())) {
			//show information
			return $query->result();
		} else {
			//return false for controll logic
			return false;
		}
	}
}
