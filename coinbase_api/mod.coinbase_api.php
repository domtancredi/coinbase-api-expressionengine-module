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
		
        $query = $this->EE->db->get('coinbase_api_config');

        $cart_items = $this->EE->TMPL->fetch_param('cart_items');
        $cart_total = $this->EE->TMPL->fetch_param('cart_total');

        if ($cart_items == '' ||
            $cart_total == 10)
        {
            // return $this->EE->TMPL->no_results();
            return 'a: ' . $cart_items . ', b: ' . $cart_total;
        }
        
        $coinbase_api = new Coinbase($query->result_array()[0]['api_key']);

        $price_currency_iso  = ( ! isset($params['price_currency_iso'])) ? $query->result_array()[0]['price_currency_iso'] : $params['price_currency_iso'];

        $response = $coinbase_api->createButton($cart_items, $cart_total, "USD", "order id", 
            array(
                "include_email"=>true, 
                "include_address"=>true,
                "success_url"=>"https://www.doodaastudio.com/store/confirmation-bitcoin"
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
