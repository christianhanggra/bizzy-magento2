<?php

namespace Christianhanggra\Bizzy\Magento2\Contracts;

Interface MageRestInterface
{
	/*
	 * Function buildUrl
	 *
	 * Concat domain with path url
	 *
	 * @param string $url
	 * @return string
	 */
	public function buildUrl($url);	

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
	public function request($method, $url, $params=[]);

	/*
	 * Function get
	 *
	 * Method to handle call api via GET request
	 *
	 * @param string $url: path url api
	 * @param array $query data
	 * @return array
	 */
	public function get($url, $query=[]);

	/*
	 * Function post
	 *
	 * Method to handle call api via POST request
	 *
	 * @param string $url: path url api
	 * @param array $params data
	 * @return array
	 */
	public function post($url, $params=[]);

	/*
	 * Function put
	 *
	 * Method to handle call api via PUT request
	 *
	 * @param string $url: path url api
	 * @param array $params data
	 * @return array
	 */
	public function put($url, $params=[]);

	/*
	 * Function put
	 *
	 * Method to handle call api via DELETE request
	 *
	 * @param string $url: path url api
	 * @param array $params data
	 * @return array
	 */
	public function delete($url, $params=[]);

	/*
	 * Function handleException
	 *
	 * Tranform json decoding to array
	 *
	 * @param string $exception
	 * @return array
	 */
	public function handleException($e);

	/*
	 * Function response
	 *
	 * Tranform json decoding to array
	 *
	 * @param array $content
	 * @return array
	 */
	public function response($content);
}