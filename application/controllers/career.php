<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Career extends Front_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$params = [
			'battlenet_tag' => 'emb3r#1997',
			'server'	=> 'us',
			'locale'	=> 'en_US'
		];

		$this->load->library('D3', $params);

		$career = $this->d3->getCareer();
		


		$data['career'] 	= $career;
		
		# $this->load->library('cimongo'); 

		$this->template->write_view('content', 'career', $data);

		$this->template->render();
	}

}