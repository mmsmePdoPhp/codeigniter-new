<?php
class Author_model extends MY_Model
{

	public function __construct()
	{
		$this->load->database();
		$this->load->helper('url');
		$this->load->helper('date');


	}

	/***
	 * set new user type in database if not exists
	 */
	public function set_author($imagePath)
	{

		
		$created_at = $this->now = date('Y-m-d h:m:s',now('Asia/Tehran'));
		//now timestamp with time zone tehran

		$data = array(
			'firstName' => $this->input->post('first_name'),
			'lastName' => $this->input->post('last_name'),
			'email' => $this->input->post('email'),
			'image' => $imagePath,
			'country' => $this->input->post('country'),
			'about' => $this->input->post('about'),
			'city' => $this->input->post('city'),
			'age' => $this->input->post('age'),
			'userId' => $this->ion_auth->get_user_id(),
			'university' => $this->input->post('university'),
			'publisher' => $this->input->post('publisher'),
			'created_at' => $created_at,
		);

		//if author not exsit insert
		$query = $this->db->get_where('authors', array('email' => $data['email']));
		if ($query->row_array()) {
			//show errow
			$this->dd('your user is exsit.');
			return false;
		} else {
			//insert data

			return $this->db->insert('authors', $data);
		}
	}
	
	/***
	 * set new user type in database if not exists
	 */
	public function update_author()
	{
		$data = array(
			'id' => $this->input->post('id'),
			'author' => $this->input->post('author'),
			'isactive' => $this->input->post('isactive') == 'on' ? 1 : 0,
		);

		//if author not exsit insert
		$query = $this->db->get_where('author', array('id' => $data['id']));
		if ($query->row_array()) {
			//if exist update 
			return $this->db->replace('author', $data);
			
		} else {
			return false; // return false for handle error and redirect user
		}
	}
	/**
	 * get count all  authors
	 */
	public function get_count_author($tag,$page=0)
	{
        switch ($tag) {
            case 'atglance':
                $this->db->select('authors.id,authors.firstName,authors.lastName,authors.email,authors.image,users.first_name AS Creator');
                
            break;


            case 'deleted':
                $this->db->select('authors.id,authors.first_name,authors.last_name,authors.username,authors.email,users.first_name AS Creator');
                $this->db->where('deleted_at IS NOT  NULL'); // Produces: WHERE name = 'Joe'

            break;

            case 'fullinfo':
                $this->db->select('*');
                
            break;
            
            default:case 'operation':
                $this->db->select('authors.id,authors.firstName,authors.lastName,authors.email,authors.image,groups.name');
                
            break;
            
            
        }
        
		$this->db->from('authors');
        $this->db->join('users', 'authors.userId = users.id', 'inner');
		
        return ($this->db->count_all_results());
    }
	/**
	 * get all authorss
	 */
	public function get_author($tag,$page=0)
	{

		switch ($tag) {
            case 'atglance':
                $this->db->select('authors.id,authors.firstName,authors.lastName,authors.email,authors.image,users.first_name AS Creator');
                
            break;


            case 'deleted':
                $this->db->select('authors.id,authors.first_name,authors.last_name,authors.username,authors.email,users.first_name AS Creator');
                $this->db->where('deleted_at IS NOT  NULL'); // Produces: WHERE name = 'Joe'

            break;

            case 'fullinfo':
                $this->db->select('*');
                
            break;
            
            default:case 'operation':
                $this->db->select('authors.id,authors.firstName,authors.lastName,authors.email,authors.image,users.first_name AS Creator');
                
            break;
			
			
		}
		
		$this->db->from('authors');
        $this->db->join('users', 'authors.userId = users.id', 'inner');
        // $this->db->join('users_groups', 'authors.userId = users_groups.user_id', 'inner');
		// $this->db->join('groups', 'users_groups.group_id = groups.id', 'inner');
		// $this->dd($this->db->get()->result());
		if($page==0){
			$query = $this->db->limit(10,0)->get();
		}else{
			$query = $this->db->limit(10,$page-10)->get();
		}
		
		// $this->dd($query->result());
		if (count($query->result())) {
			//show information
			return ($query->result());
		} else {
			//return false for controll logic
			return false;
		}
	}
	
	/**
	 * get one  authors by its id
	 */
	public function get_author_byId($id)
	{
		$this->db->select('*');
		$this->db->where('id',$id); // Produces: WHERE name = 'Joe'

		$query = $this->db->get('authors');

		if (count($query->result())) {
			//show information
			return $query->result();
		} else {
			//return false for controll logic
			return false;
		}
	}
}
