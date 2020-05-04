<?php

use Carbon\Traits\Timestamp;

class Tag_model extends MY_Model
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
	public function set_tags()
	{
		
		$data = array(
			'name' => $this->input->post('name'),
			'categoryId' => $this->input->post('category'),
			'userId' => $this->ion_auth->get_user_id(),
			'created_at' => $this->now
		);

		//if category not exsit insert
		$query = $this->db->get_where('tags', array('name' => $data['name']));
		if ($query->row_array()) {
			//show errow
			return false;
		} else {
			//insert data
			return $this->db->insert('tags', $data);
		}
	}
	
	/***
	 * set new user type in database if not exists
	 */
	public function update_tags()
	{
		$data = array(
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
			'categoryId' => $this->input->post('category'),
			'userId' => $this->ion_auth->get_user_id(),
			'updated_at' => $this->now
		);

		//if tags not exsit insert
		$query = $this->db->get_where('tags', array('id' => $data['id']));
		if ($query->row_array()) {
			//if exist update 

			foreach ($data as $key => $value) {
				$this->db->set($key, $value);
			}
			$this->db->where('id', $data['id']);
			return $this->db->update('tags'); 
			
		} else {
			return false; // return false for handle error and redirect user
		}
	}


	/***
	 * soft delete category 
	 */
	public function delete_tags()
	{
		$data = array(
			'id' => $this->input->post('id'),
		);

		//if tags not exsit insert
		$query = $this->db->get_where('tags', array('id' => $data['id']));
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
			return $this->db->update('tags');
		
		// Executes: REPLACE INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')
			
		} else {
			return false; // return false for handle error and redirect user
		}
	}

	/***
	 * soft delete category 
	 */
	public function restore_tags()
	{
		$data = array(
			'id' => $this->input->post('id'),
		);

		//if tags not exsit insert
		$query = $this->db->get_where('tags', array('id' => $data['id']));
		if ($query->row_array()) {
			//get now timestamp
			
			//soft delete row
			$data = array(
				'id' => $data['id'],
			);
			
			
			$this->db->set('deleted_at',null, true);
			$this->db->where('id', $data['id']);
			return $this->db->update('tags');
		
		// Executes: REPLACE INTO mytable (title, name, date) VALUES ('My title', 'My name', 'My date')
			
		} else {
			return false; // return false for handle error and redirect user
		}
	}

	/**
	 * get all tagss
	 */
	public function get_tags($tag)
	{
		switch ($tag) {
			case 'atglance':
				// $this->db->select('id,name,created_at');
				// $this->db->where('deleted_at IS Null'); // where category does not deleted
                $this->db->select('tags.id,tags.name As Tag,categories.name AS Category,users.first_name AS Creator');


			break;


			case 'deleted':
				$this->db->select('tag.id,tags.name As Tag,categories.name AS Category,tag.deleted_at');
				$this->db->where('deleted_at IS NOT NULL'); // Produces: WHERE name = 'Joe'

			break;

			case 'fullinfo':
                $this->db->select('tags.id,tags.name As Tag,tags.created_at,tags.updated_at,tags.deleted_at,categories.name AS Category,users.first_name AS CreatorName,users.last_name AS CreatorLastName');
			break;
			
			case 'operation':
				$this->db->select('tags.id,tags.name As Tag,categories.name As Category');

			break;
			
		}
		$this->db->from('tags');
        $this->db->join('categories', 'tags.categoryId = categories.id', 'inner');
        $this->db->join('users', 'tags.userId = users.id', 'inner');
		$query = $this->db->get();

		// $this->dd($query->result());

		if (count($query->result())) {
			//show information

			return $query->result();
		} else {
			//return false for controll logic
			return false;
		}
	}
	
	/**
	 * get one  tagss by its id
	 */
	public function get_tags_byId($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id); // Produces: WHERE name = 'Joe'

		$query = $this->db->get('tags');

		if (count($query->result())) {
			//show information
			return $query->result();
		} else {
			//return false for controll logic
			return false;
		}
	}
}
