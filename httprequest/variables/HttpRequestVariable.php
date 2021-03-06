<?php namespace Craft;

class HttpRequestVariable
{
	/**
	 * Interface to the service's get method
	 *
	 * @param string $url URL of the resource to get
	 * @param array $params Associative array containing all the parameters
	 * @param boolean $noCache This will tell the system to get content from the cache
	 *
	 * @return object An object containing the status code, response body and error message if any.
	 */
	public function get($url, $params = [], $fromCache = true)
	{
		$response = craft()->httpRequest_restClient->get($url, $params, $fromCache);
		return $response;
	}

	/**
	 * Interface to the service's post method
	 */
	public function post($url, $params = [], $files = [])
	{
		$response = craft()->httpRequest_restClient->post($url, $params, $files);
		return $response;
	}

	/**
	 * Automatically retrieve a list of parameters values
	 */
	public function getParams($paramNames)
	{
		$params = [];
		foreach($paramNames as $paramName) {
			$params[$paramName] = craft()->request->getParam($paramName);
		}

		return $params;
	}

	/**
	 * Retrieve instances of UploadedFile for specified fields
	 */
	public function getFiles($fieldNames)
	{
		$uploadedFiles = [];
		foreach($fieldNames as $field) {
			$file = UploadedFile::getInstanceByName($field);
			if( $file !== null ) {
				$uploadedFiles[$field] = $file;
			}
		}

		return $uploadedFiles;
	}

	/**
	 * Set cache TTL
	 *
	 * @param int $ttl Number of seconds during which an object in cache will stay valid
	 *
	 * @return null
	 */
	public function setCacheTtl($ttl)
	{
		craft()->httpRequest_restClient->setCacheTtl($ttl);
	}
}