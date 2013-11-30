<?php

if (! defined('COINBASE_API_NAME'))
{
	define('COINBASE_API_NAME', 'Coinbase API');
	define('COINBASE_API_MODULE_NAME', 'Coinbase_api');
    define('COINBASE_API_VER',  '1.0.0');
	define('COINBASE_API_DESC', 'A module for the Coinbase API');
	define('COINBASE_API_DOCS', 'https://coinbase.com/api/doc');
	define('COINBASE_API_PRICE_CURRENCY_ISO', 'USD');
}

// NSM Addon Updater
$config['name'] = COINBASE_API_MODULE_NAME;
$config['version'] = COINBASE_API_VER;