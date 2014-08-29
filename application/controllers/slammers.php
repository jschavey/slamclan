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
			$paragonHardcore += $career->paragonLevelHardcore;
			$careers[] = $career;
		}unset( $slammer );

		uasort( $careers, array($this, '_rankKills'));

		$data['kills'] 				= $kills;
		$data['paragon'] 			= $paragon;
		$data['paragonHardcore'] 	= $paragonLevelHardcore;
		$data['careers'] 			= $careers;

		$this->template->write_view( 'content', 'kills', $data );

		uasort( $careers , array( $this, '_rankParagon' ) );
		$data['careers'] 	= $careers;
		$this->template->write_view( 'content', 'paragon', $data );

		uasort( $careers, array( $this, '_rankHardcoreParagon' ) );
		$data['careers'] 	= $careers;
		$this->template->write_view( 'content', 'paragonHardcore', $data );

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
		$slammers[] = [
			'host' 		=> '.battle.net',
			'battlenet_tag' => 'Bearnaked-1299',
			'server' 	=> 'us',
			'locale' 	=> 'en_US'
		];
		$slammers[] = [
			'host' 		=> '.battle.net',
			'battlenet_tag' => 'Zoller-1555',
			'server' 	=> 'us',
			'locale' 	=> 'en_US'
		];

		return $slammers;
	}

	private function _rankKills($a, $b)
	{
	    if ($a->kills->monsters == $b->kills->monsters) {
	        return 0;
	    }
	    return ($a->kills->monsters > $b->kills->monsters) ? -1 : 1;
	}

	private function _rankParagon( $a, $b )
	{
		if( $a->paragonLevel == $b->paragonLevel )
		{
			return 0;
		}
		return ( $a->paragonLevel > $b->paragonLevel ) ? -1 : 1;
	}

	private function _rankHardcoreParagon( $a, $b )
	{
		if( $a->paragonLevelHardcore == $b->paragonLevelHardcore )
		{
			return 0;
		}
		return ( $a->paragonLevelHardcore > $b->paragonLevelHardcore ) ? -1 : 1;
	}
}