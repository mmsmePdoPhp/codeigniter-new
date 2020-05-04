<?php

use Carbon\Traits\Timestamp;

class Category_model extends MY_Model
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
	public function set_categories()
	{
		
		$data = array(
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description'),
			'userId' => $this->ion_auth->get_user_id(),
			'created_at' => $this->now
		);

		//if category not exsit insert
		$query = $this->db->get_where('categories', array('name' => $data['name']));
		if ($query->row_array()) {
			//show errow
			return false;
		} else {
			//insert data
			return $this->db->insert('categories', $data);
		}
	}
	
	/***
	 * set new user type in database if not exists
	 */
	public function update_categories()
	{
		$data = array(
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
			'description' => $this->input->post('description'),
			'userId' => $this->ion_auth->get_user_id(),
			'updated_at' => $this->now

		);

		//if categories not exsit insert
		$query = $this->db->get_where('categories', array('id' => $data['id']));
		if ($query->row_array()) {
			//if exist update 

			foreach ($data as $key => $value) {
				$this->db->set($key, $value);
			}
			$this->db->where('id', $data['id']);
			return $this->db->update('categories'); 
			
		} else {
			return false; // return false for handle error and redirect user
		}
	}


	/***
	 * soft delete category 
	 */
	public function delete_categories()
	{
		$data = array(
			'id' => $this->input->post('id'),
		);

		//if categories not exsit insert
		$query = $this->db->get_where('categories', array('id' => $data['id']));
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
			return $this->db->update('categories');
		
		// Executes: REPLACE INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')
			
		} else {
			return false; // return false for handle error and redirect user
		}
	}

	/***
	 * soft delete category 
	 */
	public function restore_categories()
	{
		$data = array(
			'id' => $this->input->post('id'),
		);

		//if categories not exsit insert
		$query = $this->db->get_where('categories', array('id' => $data['id']));
		if ($query->row_array()) {
			//get now timestamp
			
			//soft delete row
			$data = array(
				'id' => $data['id'],
			);
			
			
			$this->db->set('deleted_at',null, true);
			$this->db->where('id', $data['id']);
			return $this->db->update('categories');
		
		// Executes: REPLACE INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')
			
		} else {
			return false; // return false for handle error and redirect user
		}
	}

	/**
	 * get all categoriess
	 */
	public function get_categories($tag)
	{
		switch ($tag) {
			case 'atglance':
				$this->db->select('id,name,description,created_at');
				$this->db->where('deleted_at IS Null'); // where category does not deleted

			break;


			case 'deleted':
				$this->db->select('id,description,deleted_at');
				$this->db->where('deleted_at IS NOT NULL'); // Produces: WHERE name = 'Joe'

			break;

			case 'fullinfo':
				$this->db->select('id,name,description,created_at,updated_at,deleted_at');
			break;
			
			case 'operation':
				$this->db->select('id,name,description');

			break;
			
		}
			$query = $this->db->get('categories');

		if (count($query->result())) {
			//show information

			return $query->result();
		} else {
			//return false for controll logic
			return false;
		}
	}
	
	/**
	 * get one  categoriess by its id
	 */
	public function get_categories_byId($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id); // Produces: WHERE name = 'Joe'

		$query = $this->db->get('categories');

		if (count($query->result())) {
			//show information
			return $query->result();
		} else {
			//return false for controll logic
			return false;
		}
	}
}
