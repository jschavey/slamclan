<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends Front_Controller {

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

		$this->load->library('D3', $params);

		$career = $this->d3->getCareer();
		$hero 	= $this->d3->getHero('14469547');

		$career = json_decode($career);
		$career = json_encode($career, JSON_PRETTY_PRINT);

		$data['career'] 	= $career;
		$data['hero'] 		= $hero;

		# $this->load->library('cimongo'); 

		$this->template->write_view('content', 'slam', $data);

		$this->template->render();

	}

	public function fetish()
	{
		$data['amulet'] = $this->d3->getItem('item/ClAIr9eXUBIHCAQVHyxgXR1yjh0hHfNwB60dqm1A0B24vCB6MIsCOIcDQABQElgEYIcDgAFGpQG4vCB6rQGwwQlytQGwxURkuAHVz7iJA8ABFBi-sIHWC1AGWAA');
		$data['ring1'] = $this->d3->getItem('item/ClYI1KuKpA0SBwgEFcegOLkd2T_Unx07J28kHfJQaCkdm4b24h3FdKFGMIsCOKADQABQElgEYKADgAFGpQE7J28krQHmFdsNtQE2VV1EuAHdmtb3B8ABARjx_LrsCFAGWAA');
		$data['ring2'] = $this->d3->getItem('item/ClYIzLjWxQUSBwgEFSWYersd89VHtB1DTkRRHdKfnkQdfnZVoR2bhvbiMIsCOMACQABQElgEYMACgAFGpQHSn55ErQHmFdsNtQE2VV1EuAGfjInNCcABAhi1n6vICFAGWAA');
		$data['mainHand'] = $this->d3->getItem($hero['items']['mainHand']['tooltipParams']);
		$data['head'] = $this->d3->getItem($hero['items']['head']['tooltipParams']);

		$data['mainHand']['perHit']['min'] = $data['mainHand']['minDamage']['max'] + $data['mainHand']['attributesRaw']['Damage_Weapon_Min#Fire']['max'];
		$data['mainHand']['perHit']['max'] = $data['mainHand']['maxDamage']['max'] + $data['mainHand']['attributesRaw']['Damage_Weapon_Min#Fire']['max'] + $data['mainHand']['attributesRaw']['Damage_Weapon_Delta#Fire']['max'];		

		$data['weaponDamage'] = ( $data['mainHand']['perHit']['min'] + $data['mainHand']['perHit']['max'] ) / 2;
		$data['intelligence'] = $hero['stats']['intelligence'];
		$data['aps'] = $data['mainHand']['attributesRaw']['Attacks_Per_Second_Item']['max'];
		$data['basic'] = $data['weaponDamage'] * ( 1 + ( $data['intelligence'] / 100 ) ) * $data['aps'] * 1.8;
		$data['element'] = $data['head']['attributesRaw']['Item_Power_Passive#ItemPassive_Unique_Ring_526_x1']['max'];
		$data['elite'] = $data['amulet']['attributesRaw']['Damage_Percent_Bonus_Vs_Elites']['max'] + $data['ring1']['attributesRaw']['Damage_Percent_Bonus_Vs_Elites']['max'];

		#$this->load->view('ring2', $data );
		$this->load->helper('url');
		$this->load->view('welcome_message', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */