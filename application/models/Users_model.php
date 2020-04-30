<?php
class Users_model extends MY_Model
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
	public function set_users()
	{
		$timestamp = local_to_gmt(time());
		$timezone  = 'Asia/Tehran';
		$daylight_saving = True;
		echo gmt_to_local($timestamp, $timezone, $daylight_saving);//now timestamp with time zone tehran

		$data = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'email' => $this->input->post('email'),
			'isactive' => $this->input->post('isactive') == 'on' ? 1 : 0,
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'phone' => $this->input->post('phone'),
		);

		//if users not exsit insert
		$query = $this->db->get_where('users', array('email' => $data['email']));
		if ($query->row_array()) {
			//show errow
			$this->dd('your user is exsit.');
			return false;
		} else {
			//insert data
			$this->dd($this->db->insert('users', $data));

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
	 * get count all  userss
	 */
	public function get_count_users($tag,$page=0)
	{
        switch ($tag) {
            case 'atglance':
                $this->db->select('users.id,users.first_name,users.last_name,users.username,users.email,groups.name');
                
            break;

            case 'active':
                $this->db->select('users.id,users.first_name,users.last_name,users.username,users.email,groups.name');
                $this->db->where('isActive', 1); // Produces: WHERE name = 'Joe'
                

            break;

            case 'notactive':
                $this->db->select('users.id,users.first_name,users.last_name,users.username,users.email,groups.name');
                $this->db->where('isActive', 'Null'); // Produces: WHERE name = 'Joe'
                

            break;

            case 'deleted':
                $this->db->select('users.id,users.first_name,users.last_name,users.username,users.email,groups.name');
                $this->db->where('active IS  NULL'); // Produces: WHERE name = 'Joe'
                

            break;

            case 'fullinfo':
                $this->db->select('*');
                
            break;
            
            default:case 'operation':
                $this->db->select('users.id,users.first_name,users.last_name,users.username,users.email,groups.name');
                
            break;
            
            
        }
        
        $this->db->from('users');
        $this->db->join('users_groups', 'users.id = users_groups.user_id', 'left');
        $this->db->join('groups', 'users_groups.group_id = groups.id', 'left');
        return ($this->db->count_all_results());
    }
	/**
	 * get all userss
	 */
	public function get_users($tag,$page=0)
	{

		switch ($tag) {
			case 'atglance':
				$this->db->select('users.id,users.first_name,users.last_name,users.username,users.email,groups.name');
				
			break;

			case 'active':
				$this->db->select('users.id,users.first_name,users.last_name,users.username,users.email,groups.name');
				$this->db->where('isActive',1); // Produces: WHERE name = 'Joe'
				

			break;

			case 'notactive':
				$this->db->select('users.id,users.first_name,users.last_name,users.username,users.email,groups.name');
				$this->db->where('isActive', 'Null'); // Produces: WHERE name = 'Joe'
				

			break;

			case 'deleted':
				$this->db->select('users.id,users.first_name,users.last_name,users.username,users.email,groups.name');
				$this->db->where('active IS  NULL'); // Produces: WHERE name = 'Joe'
				

			break;

			case 'fullinfo':
				$this->db->select('*');
				
			break;
			
			default:case 'operation':
				$this->db->select('users.id,users.first_name,users.last_name,users.username,users.email,groups.name');
				
			break;
			
			
		}
		
		$this->db->from('users');
		$this->db->join('users_groups', 'users.id = users_groups.user_id', 'left');
		$this->db->join('groups', 'users_groups.group_id = groups.id', 'left');
		// $count = ($this->db->count_all_results());
				//	limit(count,offset)
		if($page==0){
			$query = $this->db->limit(10,0)->get();
		}else{
			$query = $this->db->limit(10,$page-10)->get();
		}
		// $this->dd($query->result());
		if (count($query->result())) {
			//show information
			// return $this->dd($query->result());
			return (array_merge($query->result(),['count'=>$this->get_count_users($tag,$page)]));
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
