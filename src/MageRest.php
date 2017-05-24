<?php

namespace Christianhanggra\Bizzy\Magento2;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\JsonResponse;
use Christianhanggra\Bizzy\Magento2\Contracts\MageRestInterface;

class MageRest implements MageRestInterface
{
	/*
	 * Intialize variable
	 */
	function __construct(Client $client)
	{
		$this->client = $client;
		$this->options = [
			'headers' => [
	            'Content-Type'     => 'application/json',
	            'Authorization'    => 'Bearer '. env('MAGENTO_TOKEN'),
	        ],
		];
	}

	/*
	 * Function buildUrl
	 *
	 * Concat domain with path url
	 *
	 * @param string $url
	 * @return string
	 */
	public function buildUrl($url)
	{
		return (env('MAGENTO_URL') . $url);
	}

	/*
	 * Function request
	 *
	 * General method to handle many verb of call api
	 *
	 * @param string $method: GET,POST,PUT,DELETE
	 * @param string $url: path url api
	 * @param array $params data
	 * @return array
	 */
	public function request($method, $url, $params=[])
	{
		$endpoint = $this->buildUrl($url);
		$method = strtoupper($method);

		if($params){
			if($method == 'GET') $this->options['query'] = $params;
			else $this->options['json'] = $params;
		}

		try {
			$content = $this->client->request($method, $endpoint, $this->options);
			return $this->response($content);
        } catch (RequestException $e) {
        	return $this->handleException($e);
		}
	}

	/*
	 * Function get
	 *
	 * Method to handle call api via GET request
	 *
	 * @param string $url: path url api
	 * @param array $query data
	 * @return array
	 */
	public function get($url, $query=[])
	{
		$endpoint = $this->buildUrl($url);
		if($query) $this->options['query'] = $query;

		try {
            $content = $this->client->get($endpoint, $this->options);
            return $this->response($content);
        } catch (RequestException $e) {
        	return $this->handleException($e);
		}
	}

	/*
	 * Function post
	 *
	 * Method to handle call api via POST request
	 *
	 * @param string $url: path url api
	 * @param array $params data
	 * @return array
	 */
	public function post($url, $params=[])
	{
		$endpoint = $this->buildUrl($url);
		if($params) $this->options['json'] = $params;

		try {
            $content = $this->client->post($endpoint, $this->options);
            return $this->response($content);
        } catch (RequestException $e) {
        	return $this->handleException($e);
		}
	}

	/*
	 * Function put
	 *
	 * Method to handle call api via PUT request
	 *
	 * @param string $url: path url api
	 * @param array $params data
	 * @return array
	 */
	public function put($url, $params=[])
	{
		$endpoint = $this->buildUrl($url);
		if($params) $this->options['json'] = $params;

		try {
            $content = $this->client->put($endpoint, $this->options);
            return $this->response($content);
        } catch (RequestException $e) {
        	return $this->handleException($e);
		}
	}

	/*
	 * Function put
	 *
	 * Method to handle call api via DELETE request
	 *
	 * @param string $url: path url api
	 * @param array $params data
	 * @return array
	 */
	public function delete($url, $params=[])
	{
		$endpoint = $this->buildUrl($url);
		if($params) $this->options['json'] = $params;

		try {
            $content = $this->client->delete($endpoint, $this->options);
            return $this->response($content);
        } catch (RequestException $e) {
        	return $this->handleException($e);
		}
	}

	/*
	 * Function handleException
	 *
	 * Tranform json decoding to array
	 * https://stackoverflow.com/questions/19748105/handle-guzzle-exception-and-get-http-body
	 *
	 * @param string $exception
	 * @return array
	 */
	public function handleException($e)
	{
		if ($e->hasResponse()) {
			$arr['error'] = true;
			$arr['code'] = (int) $e->getCode();
			$exception = (string) $e->getResponse()->getBody();			
			$exception = json_decode($exception, true);
			return array_merge($arr, $exception);
			//return new JsonResponse($exception, $e->getCode());
		}else{
			$arr['error'] = true;
			$arr['code'] = (int) $e->getCode();
			$arr['message'] = $e->getMessage();
			return $arr;
			//return new JsonResponse($e->getMessage(), 503);
		}
	}

	/*
	 * Function response
	 *
	 * Tranform json decoding to array
	 *
	 * @param array $content
	 * @return array
	 */
	public function response($content)
	{
        return json_decode(@$content->getBody(), true);
	}



}