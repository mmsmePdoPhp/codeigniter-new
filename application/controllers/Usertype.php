<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usertype extends CI_Controller {

	public function index()
	{
		$this->load->view('dashboard/login.html');
	}
}
