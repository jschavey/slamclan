<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$params = [
			'battlenet_tag' => 'emb3r#1997',
			'server'	=> 'us',
			'locale'	=> 'en_US'
		];

		$this->load->library('D3', $params );
		
		echo "Career Data:";
		$CAREER_DATA = $this->d3->getCareer();

		// Before handling the data check to make sure the return is an array
		// If the data is not an array then something wen't wrong.
		//
		if(is_array($CAREER_DATA)) {
		    echo '<pre>';
		    var_dump($CAREER_DATA);
		    echo '</pre>';
		}

		$this->load->view('welcome_message');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */