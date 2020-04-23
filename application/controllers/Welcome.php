<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

		printf("Right now is %s", Carbon::now()->toDateTimeString());
		printf("Right now in Vancouver is %s", Carbon::now('America/Vancouver'));  //implicit __toString()
		echo $tomorrow = Carbon::now()->addDay();
		echo $lastWeek = Carbon::now()->subWeek();
		echo $nextSummerOlympics = Carbon::createFromDate(2016)->addYears(4);
		return;
		$this->load->view('welcome_message');
	}
}
