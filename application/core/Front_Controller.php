<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Front_Controller extends Base_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('template');
	}
}