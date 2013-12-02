<?php if (! defined('BASEPATH')) exit('Invalid file request');

/**
 * Coinbase API Module Class
 *
 * @package   Coinbase
 * @author    Dom Tancredi <dom@domandtom.com>
 * @copyright Copyright (c) 2013 Dom & Tom, Inc
 */
class Coinbase_api
{
	/**
	 * Constructor
	 */
	function __construct()
	{
		$this->EE =& get_instance();
	}

	// --------------------------------------------------------------------

	/**
	 * Display Buy Button
	 */
    function display_buy_button()
    {
        require_once $this->EE->config->slash_item('third_party_path').'coinbase_api/libraries/coinbase/Coinbase.php';
		
        $cart_items = $this->EE->TMPL->fetch_param('cart_items');
        $cart_total = $this->EE->TMPL->fetch_param('cart_total');

        if (($cart_items == null) ||
            ($cart_total <= 0))
        {
            return $this->EE->TMPL->no_results();
        }
        
        $this->EE->db->limit(1);
        $query = $this->EE->db->get('coinbase_api_config');
        $row = $query->row_array();
        $api_key = $row['api_key'];
        $price_currency_iso = $row['price_currency_iso'];

        $coinbase_api = new Coinbase($api_key);

        $price_currency_iso  = ( ! isset($params['price_currency_iso'])) ? $price_currency_iso : $params['price_currency_iso'];

        $response = $coinbase_api->createButton($cart_items, $cart_total, "USD", "order id", 
            array(
                "include_email"=>true, 
                "include_address"=>true
            )
        );
                
        $response = $coinbase_api->createButton($cart_items, $cart_total, $price_currency_iso, "order id", array(
            "include_email"=>true, 
            "include_address"=>true)
        );
        $html = $response->embedHtml;
        return $html;
    }
	// --------------------------------------------------------------------


}
