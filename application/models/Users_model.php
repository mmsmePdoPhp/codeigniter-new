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
				$this->db->select('users.id,users.first_name,users.last_name,users.username,users.email,groups.name');
				// $this->db->select('*');
				$this->db->from('users');
				$this->db->join('users_groups', 'users.id = users_groups.user_id', 'inner');
				$this->db->join('groups', 'users_groups.group_id = groups.id', 'inner');
				// $this->dd($query = $this->db->get()->result());
			break;

			case 'active':
				$this->db->select('users.id,users.first_name,users.last_name,users.username,users.email,groups.name');
				$this->db->where('isActive',1); // Produces: WHERE name = 'Joe'
				// $this->db->select('*');
				$this->db->from('users');
				$this->db->join('users_groups', 'users.id = users_groups.user_id', 'inner');
				$this->db->join('groups', 'users_groups.group_id = groups.id', 'inner');

			break;

			case 'notactive':
				$this->db->select('users.id,users.first_name,users.last_name,users.username,users.email,groups.name');
				$this->db->where('isActive', 'Null'); // Produces: WHERE name = 'Joe'
				// $this->db->select('*');
				$this->db->from('users');
				$this->db->join('users_groups', 'users.id = users_groups.user_id', 'inner');
				$this->db->join('groups', 'users_groups.group_id = groups.id', 'inner');

			break;

			case 'deleted':
				$this->db->select('users.id,users.first_name,users.last_name,users.username,users.email,groups.name');
				$this->db->where('active IS  NULL'); // Produces: WHERE name = 'Joe'
				// $this->db->select('*');
				$this->db->from('users');
				$this->db->join('users_groups', 'users.id = users_groups.user_id', 'inner');
				$this->db->join('groups', 'users_groups.group_id = groups.id', 'inner');

			break;

			case 'fullinfo':
				$this->db->select('*');
				$this->db->from('users');
				$this->db->join('users_groups', 'users.id = users_groups.user_id', 'inner');
				$this->db->join('groups', 'users_groups.group_id = groups.id', 'inner');
			break;
			
			default:case 'operation':
				$this->db->select('users.id,users.first_name,users.last_name,users.username,users.email,groups.name');
				// $this->db->select('*');
				$this->db->from('users');
				$this->db->join('users_groups', 'users.id = users_groups.user_id', 'inner');
				$this->db->join('groups', 'users_groups.group_id = groups.id', 'inner');			
			break;
			
				
		}

		$query = $this->db->get();

		if (count($query->result())) {
			//show information
			// return $this->dd($query->result());
			return ($query->result());
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
