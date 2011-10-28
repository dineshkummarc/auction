<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auction {
	
	public $return_data;
	
	// Constructor
	public function __construct()
	{
		$this->EE =& get_instance();
	}

	public function summary() {
		
		$tagdata = $this->EE->TMPL->tagdata;
		
		// Build array of our variables
		$data = array(
			"current_bid" => "0.00",
			"total_bids" => 0
		);
		
		// Construct $variables array for use in parse_variables method
		$variables = array();
		$variables[] = $data;
	
		return $this->EE->TMPL->parse_variables( $tagdata, $variables );
	}

}
/* End of file mod.auction.php */
/* Location: /system/expressionengine/third_party/auction/mod.auction.php */