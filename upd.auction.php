<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auction_upd {
	
	public $version = '1.0';

	private $module_name = "Auction";
	private $EE;
	
	// Constructor
	public function __construct()
	{
		$this->EE =& get_instance();
	}
	
	/**
	 * Install the module
	 *
	 * @return boolean TRUE
	 */
	public function install()
	{
		$mod_data = array(
			'module_name' => $this->module_name,
			'module_version' => $this->version,
			'has_cp_backend' => "y",
			'has_publish_fields' => 'n'
		);
		$this->EE->db->insert('modules', $mod_data);
		
		$this->EE->load->dbforge();
		
		$fields = array(
			'id' => array(
				'type' => 'int',
				'constraint' => '10',
				'unsigned' => TRUE,
				'auto_increment'=> TRUE
			),
			'entry_id' => array(
				'type' => 'int',
				'constraint' => '10',
				'unsigned' => TRUE,
				'null' => FALSE
			),
			'member_id' => array(
				'type' => 'int',
				'constraint' => '10',
				'unsigned' => TRUE,
				'null' => FALSE
			),
			'bid_amount' => array(
				'type' => 'decimal',
				'constraint' => '7,2',
				'default' => '0.00',
				'null' => FALSE
			),
			'bid_date' => array(
				'type' => 'int',
				'constraint' => '10',
				'unsigned' => TRUE,
				'default' => '0',
				'null' => FALSE
			)
		);
		$this->EE->dbforge->add_field($fields);
		$this->EE->dbforge->add_key('id', TRUE);
		$this->EE->dbforge->create_table('auction');
		
		return TRUE;
	}
	
	/**
	 * Uninstall the module
	 *
	 * @return boolean TRUE
	 */
	public function uninstall()
	{
		$this->EE->db->select('module_id');
		$query = $this->EE->db->get_where('modules', 
			array( 'module_name' => $this->module_name )
		);
		
		$this->EE->db->where('module_id', $query->row('module_id'));
		$this->EE->db->delete('module_member_groups');
		
		$this->EE->db->where('module_name', $this->module_name);
		$this->EE->db->delete('modules');
		
		$this->EE->db->where('class', $this->module_name);
		$this->EE->db->delete('actions');
		
		$this->EE->db->where('class', $this->module_name.'_mcp');
		$this->EE->db->delete('actions');
		
		$this->EE->load->dbforge();
		$this->EE->dbforge->drop_table('auction');
		
		return TRUE;
	}
	
	/**
	 * Update the module
	 *
	 * @return boolean
	 */
	public function update($current = '')
	{
		if ($current == $this->version) {
			// No updates
			return FALSE;
		}
		
		return TRUE;
	}
	
}

/* End of file upd.auction.php */
/* Location: /system/expressionengine/third_party/auction/upd.auction.php */