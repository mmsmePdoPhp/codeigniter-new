<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}



	/**
	 * die dump function for testing
	 */

	public function dd($data){
		echo '<pre>';
		print_r($data);
		echo '</pre>';

		exit;
	}

	
}
