<?php
class Blog extends CI_Controller {

	public function show($page = 'home')
	{
		echo 'blog controller new method';
	}

	public function hi($num=1){
		echo 'hi '.$num;
	}
}
