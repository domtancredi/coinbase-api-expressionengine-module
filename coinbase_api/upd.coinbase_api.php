<?php if (! defined('BASEPATH')) exit('Invalid file request');

if (! defined('PATH_THIRD')) define('PATH_THIRD', EE_APPPATH.'third_party/');
require_once PATH_THIRD.'coinbase_api/config.php';


/**
 * Coinbase API Update Class
 *
 * @package   Coinbase
 * @author    Dom Tancredi <dom@domandtom.com>
 * @copyright Copyright (c) 2013 Dom & Tom, Inc
 */
class Coinbase_api_upd {

	var $version = COINBASE_API_VER;

	/**
	 * Constructor
	 */
	function __construct()
	{
		$this->EE =& get_instance();
		
		$this->EE->load->dbforge();
	}

	// --------------------------------------------------------------------

	/**
	 * Install
	 */
	function install()
	{
		$this->EE->db->insert('modules', array(
			'module_name'        => COINBASE_API_MODULE_NAME,
			'module_version'     => COINBASE_API_VER,
			'has_cp_backend'     => 'y',
			'has_publish_fields' => 'n'
		));
		
		$fields = array(
            'config_id'   => array('type' => 'INT', 'constraint' => 5, 'unsigned' => TRUE, 'auto_increment' => TRUE),
            'api_key'   => array('type' => 'varchar', 'constraint' => '255', 'null' => TRUE, 'default' => NULL),
            'price_currency_iso' => array('type' => 'varchar', 'constraint' => '16','null' => TRUE, 'default' => COINBASE_API_PRICE_CURRENCY_ISO)
        );

        $this->EE->dbforge->add_field($fields);
        $this->EE->dbforge->add_key('config_id', TRUE);
        $this->EE->dbforge->create_table('coinbase_api_config');
        
        $data = array(
            'api_key'               => '',
            'price_currency_iso'    => COINBASE_API_PRICE_CURRENCY_ISO
        );

        $this->EE->db->insert('coinbase_api_config', $data);

        return TRUE;
	}

	/**
	 * Uninstall
	 */
	function uninstall()
	{
		$this->EE->db->where('module_name', COINBASE_API_MODULE_NAME)->delete('modules');
		$this->EE->dbforge->drop_table('coinbase_api_config');

		return TRUE;
	}
	
	/**
	 * Update
	 */
	function update($current = '')
    {
        return FALSE;
    }
}
