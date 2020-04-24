<?php
class Usertype_model extends MY_Model
{

	public function __construct()
	{
		$this->load->database();
		$this->load->helper('url');
	}

	/***
	 * set new user type in database if not exists
	 */
	public function set_usertype()
	{
		$data = array(
			'usertype' => $this->input->post('usertype'),
			'isactive' => $this->input->post('isactive') == 'on' ? 1 : 0,
		);

		//if usertype not exsit insert
		$query = $this->db->get_where('userType', array('userType' => $data['usertype']));
		if ($query->row_array()) {
			//show errow
			return false;
		} else {
			//insert data
			return $this->db->insert('usertype', $data);
		}
	}
	
	/***
	 * set new user type in database if not exists
	 */
	public function update_usertype()
	{
		$data = array(
			'id' => $this->input->post('id'),
			'usertype' => $this->input->post('usertype'),
			'isactive' => $this->input->post('isactive') == 'on' ? 1 : 0,
		);

		//if usertype not exsit insert
		$query = $this->db->get_where('userType', array('id' => $data['id']));
		if ($query->row_array()) {
			//if exist update 
			return $this->db->replace('usertype', $data);
			
		} else {
			return false; // return false for handle error and redirect user
		}
	}
	/**
	 * get all usertypes
	 */
	public function get_usertype($tag)
	{
		switch ($tag) {
			case 'atglance':
				$this->db->select('id,usertype,isActive,created_at');
			break;

			case 'active':
				$this->db->select('id,usertype,isActive,created_at,updated_at,deleted_at');
				$this->db->where('isActive', 1); // Produces: WHERE name = 'Joe'

			break;

			case 'notactive':
				$this->db->select('id,usertype,isActive,created_at,updated_at,deleted_at');
				$this->db->where('isActive', 0); // Produces: WHERE name = 'Joe'

			break;

			case 'deleted':
				$this->db->select('id,usertype,isActive,deleted_at');
				$this->db->where('deleted_at IS NOT NULL'); // Produces: WHERE name = 'Joe'

			break;

			case 'fullinfo':
				$this->db->select('id,usertype,isActive,created_at,updated_at,deleted_at');
			break;
			
			default:case 'operation':
				$this->db->select('id,usertype');
			break;
			
				$this->db->select('id,usertype,isActive,created_at,updated_at,deleted_at');
			break;
		}

		$query = $this->db->get('usertype');

		if (count($query->result())) {
			//show information
			return $query->result();
		} else {
			//return false for controll logic
			return false;
		}
	}
	
	/**
	 * get one  usertypes by its id
	 */
	public function get_usertype_byId($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id); // Produces: WHERE name = 'Joe'

		$query = $this->db->get('usertype');

		if (count($query->result())) {
			//show information
			return $query->result();
		} else {
			//return false for controll logic
			return false;
		}
	}
}
