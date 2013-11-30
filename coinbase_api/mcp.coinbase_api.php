<?php if (! defined('BASEPATH')) exit('Invalid file request');

/**
 * Coinbase API Module CP Class
 *
 * @package   Coinbase_api
 * @author    Dom Tancredi <dom@domandtom.com>
 * @copyright Copyright (c) 2013 Dom & Tom, Inc
 */
class Coinbase_api_mcp {

	/**
	 * Constructor
	 */
	function __construct()
	{
		$this->EE =& get_instance();
		
        // Set base URL to the module so there's less typing 
        // elsewhere in this class.
        $this->_base_url = BASE.AMP.'C=addons_modules'.AMP.'M=show_module_cp';
        $this->_base_url .= AMP.'module=coinbase_api';

        $this->_form_base = 
            'C=addons_modules'.AMP.'M=show_module_cp'.AMP.'module=coinbase_api';

        $this->EE->load->helper('text');
	}

	// --------------------------------------------------------------------

	/**
	 * Index
	 */
	function index()
    {
        // Set page title
        $this->EE->cp->set_variable('cp_page_title', lang('coinbase_api_module_name'));

        // Helpers
        $this->EE->load->helper('form');

        if ($this->EE->input->post('api_key'))
        {
            // We passed the test, onward!
            $this->_do_update_config();
        }

        $query = $this->EE->db->get('coinbase_api_config');

        $data = array(
            'form_action'   => $this->_form_base,
            'form_hidden'   => FALSE,
            'api_key'       => $query->result_array()[0]['api_key'],
            'price_currency_iso' => $query->result_array()[0]['price_currency_iso']
        );

        return $this->EE->load->view('index', $data, TRUE);
    }
    
    // ----------------------------------------------------------------

    private function _do_update_config()
    {
        $data = array(
            'api_key'               => $this->EE->input->post('api_key'),
            'price_currency_iso'    => $this->EE->input->post('price_currency_iso')
        );

        $this->EE->db->update('coinbase_api_config', $data, array('config_id' => '1'));

        $this->EE->session->set_flashdata('message_success', lang('coinbase_api_updated'));
        $this->EE->functions->redirect($this->_base_url);
    }
}
