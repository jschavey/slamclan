<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slammers extends Front_Controller {

	public function __construct()
	{
		parent::__construct();

		$init_config = [
			'battlenet_tag' => 'emb3r#1997',
			'server'	=> 'us',
			'locale'	=> 'en_US',
		];

		$this->load->library('d3', $init_config);
	}

	public function index()
	{	
		$slammers = $this->_configureSlammers();

		$careers 			= array();
		$heroes 			= array();
		$kills 				= 0;
		$paragon 			= 0;
		$paragonHardcore 	= 0;
		$seasons 			= 0;

		foreach( $slammers as $slammer )
		{
			extract( $slammer );

			if( ! $career = $this->d3->getCareer( $server, $host, $battlenet_tag, $locale ) )
			{
				exit( 'Call to getCareer failed.' );
			}

			$career->battlenet_tag = $battlenet_tag;
			$career->server = $server;
			$career->host 	= $host;

			$kills 				+= $career->kills->monsters;
			$paragon 			+= $career->paragonLevel;
			$paragonHardcore 	+= $career->paragonLevelHardcore;

			foreach( $career->heroes as $hero )
			{
				if( $hero->seasonal )
				{
					$seasons++;
				}
				$hero->battleTag = $career->battleTag;
				$heroes[] 		 = $hero;
                if( $hero->id == $career->lastHeroPlayed )
                {
                    $last_seen  = DateTime::createFromFormat( 'U', $hero->{'last-updated'} );
                    #print_r( DateTime::getLastErrors );
                    $now        = new DateTime;
                    $interval   = $last_seen->diff( $now );
                    print_r( $interval );
                    $career->lastSeen = $interval;
                }
			}
			$careers[] 			= $career;
		}unset( $slammer );

		/* Global Stats */

		$data['kills'] 				= $kills;
		$data['paragon'] 			= $paragon;
		$data['paragonHardcore'] 	= $paragonHardcore;
		$data['seasons'] 			= $seasons;

        $data['stats'] = '';
        
		uasort( $careers, array($this, '_rankKills'));
		$data['careers'] 			= $careers;
		$data['stats'] .= $this->load->view( 'kills', $data, true );

		uasort( $careers , array( $this, '_rankParagon' ) );
		$data['careers'] 	= $careers;
		$data['stats'] .= $this->load->view( 'paragon', $data, true );

		uasort( $careers, array( $this, '_rankHardcoreParagon' ) );
		$data['careers'] 	= $careers;
		$data['stats'] .= $this->load->view( 'paragonHardcore', $data, true );

		uasort( $heroes, array( $this, '_rankSeason' ) );
		$data['heroes'] 	= $heroes;
		$data['stats'] .= $this->load->view( 'seasonal', $data, true );
        
        $stats = $this->load->view('stats', $data, true);
        
        uasort( $careers, array( $this, '_rankActivity' ) );
        $data['careers'] = $careers;
        $activity = $this->load->view('activity', $data, true);
        
        $this->template->write('content', $stats);
        $this->template->write('content', $activity);

		$this->template->render();
	}

	public function items()
	{
		$slammers = $this->_configureSlammers();

		foreach( $slammers as $slammer )
		{
			extract( $slammer );

			if( ! $career = $this->d3->getCareer( $server, $host, $battlenet_tag, $locale ) )
			{
				exit( 'Call to getCareer failed.' );
			}

			$career->battlenet_tag 	= $battlenet_tag;
			$career->server 		= $server;
			$career->host 			= $host;

			$careers[] 			= $career;
		}unset( $slammer );

		$heroes = array();
		$items 	= array();
		foreach( $careers as $career )
		{
			foreach( $career->heroes as $hero )
			{
				$hero_obj = $this->d3->getHero( $career->server, $career->host, $career->battlenet_tag, $hero->id );
				$heroes[] = $hero_obj;
				foreach( $hero_obj->items as $item )
				{
					$item = $this->d3->getItem( $career->server, $career->host, $career->battlenet_tag, $item->tooltipParams );
					$items[] = $item;
				}
			}
		}

		$data['heroes'] = $heroes;
		#$this->template->write_view( 'content', 'heroes', $data );

		$data['items'] = $items;
		$this->template->write_view( 'content', 'items', $data );

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
		$slammers[] = [
			'host' 		=> '.battle.net',
			'battlenet_tag' => 'Zach-1951',
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

	private function _rankSeason( $a, $b )
	{
		if( $a->level == $b->level )
		{
			return 0;
		}
		return ( $a->level > $b->level ) ? -1 : 1;
	}
    
    private function _rankActivity( $a, $b )
    {
        return ( $a->lastSeen < $b->lastSeen ) ? -1 : 1;
    }
}