<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slammers extends Front_Controller {

	public function index()
	{
		$init_config = [
			'battlenet_tag' => 'emb3r#1997',
			'server'	=> 'us',
			'locale'	=> 'en_US',
		];

		$this->load->library('d3', $init_config);
	
		$slammers = $this->_configureSlammers();

		$careers 	= array();
		$kills 		= 0;
		$paragon 	= 0;

		foreach( $slammers as $slammer )
		{
			extract( $slammer );

			if( ! $career = $this->d3->getCareer( $server, $host, $battlenet_tag, $locale ) )
			{
				exit( 'Call to getCareer failed.' );
			}

			$kills += $career->kills->monsters;
			$paragon += $career->paragonLevel;
			$careers[] = $career;
		}unset( $slammer );


		$data['kills'] 		= $kills;
		$data['paragon'] 	= $paragon;
		$data['careers'] 	= $careers;

		$this->template->write_view( 'content', 'kills', $data );
		$this->template->write_view( 'content', 'paragon', $data );

		$this->template->render();
	}

	private function _configureSlammers()
	{
		$slammers = array();

		$slammers[] = [
			'host' 		=> '.battle.net',
			'battlenet_tag' => 'emb3r-1997',
			'server'	=> 'us',
			'locale'	=> 'en_US',
		];
		$slammers[] = [
			'host' 		=> '.battle.net',
			'battlenet_tag' => 'Vires-1286',
			'server'	=> 'us',
			'locale'	=> 'en_US'
		];
		$slammers[] = [
			'host' 		=> '.battle.net',
			'battlenet_tag' => 'kurigami-1392',
			'server'	=> 'us',
			'locale'	=> 'en_US'
		];
		$slammers[] = [
			'host' 		=> '.battle.net',
			'battlenet_tag' => 'Atenhara-1797',
			'server'	=> 'us',
			'locale'	=> 'en_US'
		];

		return $slammers;
	}
}