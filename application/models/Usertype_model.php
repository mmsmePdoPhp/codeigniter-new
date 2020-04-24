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

	/**
	 * get all usertypes
	 */
	public function get_usertype($tag)
	{
		switch ($tag) {
			case 'atglance':
				$this->db->select('id,usertype,isActive,created_at,updated_at,deleted_at');
			break;

			case 'active':
				$this->db->select('id,usertype,isActive,created_at,updated_at,deleted_at');
			break;

			case 'notactive':
				$this->db->select('id,usertype,isActive,created_at,updated_at,deleted_at');
			break;

			case 'deleted':
				$this->db->select('id,usertype,isActive,created_at,updated_at,deleted_at');
			break;

			case 'fullinfo':
				$this->db->select('id,usertype,isActive,created_at,updated_at,deleted_at');
			break;
			
			default:
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
}
