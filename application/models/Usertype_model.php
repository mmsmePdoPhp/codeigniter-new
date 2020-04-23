<?php
class Usertype_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	/***
	 * set new user type in database if not exists
	 */
	public function set_usertype()
	{
		$this->load->helper('url');

		$data = array(
			'usertype' => $this->input->post('usertype'),
			'isactive' => $this->input->post('isactive')=='on' ? 1 : 0,
		);

		//if usertype not exsit insert
		$query = $this->db->get_where('userType', array('userType' => $data['usertype']));
		if($query->row_array()){
			//show errow
			return false;
		}else{
			//insert data
			return $this->db->insert('usertype', $data);
		}
	}

	/**
	 * get all usertypes
	 */

}

