<?php

namespace Christianhanggra\Bizzy\Magento2;

use GuzzleHttp\Client;

class MageRest
{
	function __construct()
	{

	}

	public function get($url)
	{	
		$client = new Client();
		try {
            $content = $client->get($url);
            if (empty($content)) return ['status' => false];
            $arr = json_decode(@$content->getBody(), true);
            return $arr;

        } catch (\Exception $e) {

            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
	}

}