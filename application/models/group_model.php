<?php

use Carbon\Traits\Timestamp;

class Group_model extends MY_Model
{
	
	
	public function __construct()
	{
		$this->now = date('Y-m-d h:m:s',time());
		$this->load->database();
		$this->load->helper('url');
		$this->load->helper('date');


	}

	/***
	 * set new user type in database if not exists
	 */
	public function set_groups()
	{
		
		$data = array(
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description'),
			'isactive' => $this->input->post('isactive') == 'on' ? 1 : 0,
			'created_at' => $this->now
		);

		//if group not exsit insert
		$query = $this->db->get_where('groups', array('name' => $data['name']));
		if ($query->row_array()) {
			//show errow
			return false;
		} else {
			//insert data
			return $this->db->insert('groups', $data);
		}
	}
	
	/***
	 * set new user type in database if not exists
	 */
	public function update_groups()
	{
		$data = array(
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description'),
			'isactive' => $this->input->post('isactive') == 'on' ? 1 : 0,
		);

		//if groups not exsit insert
		$query = $this->db->get_where('groups', array('id' => $data['id']));
		if ($query->row_array()) {
			//if exist update 
			return $this->db->replace('groups', $data);
			
		} else {
			return false; // return false for handle error and redirect user
		}
	}


	/***
	 * soft delete group 
	 */
	public function delete_groups()
	{
		$data = array(
			'id' => $this->input->post('id'),
		);

		//if groups not exsit insert
		$query = $this->db->get_where('groups', array('id' => $data['id']));
		if ($query->row_array()) {
			//get now timestamp
			$now =date('Y-m-d h:m:s',now());
			
			//soft delete row
			$data = array(
				'id' => $data['id'],
				'now'  => date($now)
			);
			
			
			$this->db->set('deleted_at',$data['now'], true);
			$this->db->where('id', $data['id']);
			return $this->db->update('groups');
		
		// Executes: REPLACE INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')
			
		} else {
			return false; // return false for handle error and redirect user
		}
	}

	/***
	 * soft delete group 
	 */
	public function restore_groups()
	{
		$data = array(
			'id' => $this->input->post('id'),
		);

		//if groups not exsit insert
		$query = $this->db->get_where('groups', array('id' => $data['id']));
		if ($query->row_array()) {
			//get now timestamp
			
			//soft delete row
			$data = array(
				'id' => $data['id'],
			);
			
			
			$this->db->set('deleted_at',null, true);
			$this->db->where('id', $data['id']);
			return $this->db->update('groups');
		
		// Executes: REPLACE INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')
			
		} else {
			return false; // return false for handle error and redirect user
		}
	}

	/**
	 * get all groupss
	 */
	public function get_groups($tag)
	{
		switch ($tag) {
			case 'atglance':
				$this->db->select('id,name,description,isActive,created_at');
				$this->db->where('deleted_at IS Null'); // where group does not deleted

			break;

			case 'active':
				$this->db->select('id,description,isActive,created_at,updated_at,deleted_at');
				$this->db->where('deleted_at IS Null'); // where group does not deleted
				
				$this->db->where('isActive', 1); // where group is active

			break;

			case 'notactive':
				$this->db->select('id,description,isActive,created_at,updated_at,deleted_at');
				$this->db->where('deleted_at IS Null'); // where group does not deleted

				$this->db->where('isActive', 0); // where group is not active

			break;

			case 'deleted':
				$this->db->select('id,description,isActive,deleted_at');
				$this->db->where('deleted_at IS NOT NULL'); // Produces: WHERE name = 'Joe'

			break;

			case 'fullinfo':
				$this->db->select('id,description,isActive,created_at,updated_at,deleted_at');
			break;
			
			case 'operation':
				$this->db->select('id,description');

			break;
			
		}
			$query = $this->db->get('groups');

		if (count($query->result())) {
			//show information

			return $query->result();
		} else {
			//return false for controll logic
			return false;
		}
	}
	
	/**
	 * get one  groupss by its id
	 */
	public function get_groups_byId($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id); // Produces: WHERE name = 'Joe'

		$query = $this->db->get('groups');

		if (count($query->result())) {
			//show information
			return $query->result();
		} else {
			//return false for controll logic
			return false;
		}
	}
}
