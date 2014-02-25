<?php
namespace SyndicatePlus\Api;

require_once dirname(__FILE__) ."/querystring.class.php";
require_once dirname(__FILE__) ."/guid.class.php";

use SyndicatePlus\Utility;

abstract class SyndicatePlusApiBase
{
	private $apiKey = "";

	private $apiSecret = "";

	private $apiEndpoint = "http://api.syndicateplus.com";

	private $version = 1;

	protected function __construct($apiKey, $apiSecret, $versionNumber) {
		$this->apiKey = $apiKey;
		$this->apiSecret = $apiSecret;
		$this->version = intval($versionNumber);
	}

	/**
	 * Sends a request to the SyndicatePlus API
	 */
	protected function sendRequest($resource, $queryString) {
		$url = $this->buildUrl($resource, $queryString);

		// Generate the authorization header
		$authorizationHeader = $this->generateAuthorizationHeader("GET", $resource, $queryString);

		$response = file_get_contents($url, false, stream_context_create(array(
			"http" => array(
				"method" => "GET",
				"header" => "Authorization: ". $authorizationHeader ."\r\n".
							"Content-Type: application/x-www-form-urlencode\r\n"
			)
		)));

		if ( $response === false )
			return $response;

		return json_decode($response);
	}

	private function generateAuthorizationHeader($method, $resource, $queryString) {
		// Prepare the query string and other values
		$preparedQueryString = $this->prepareQueryString(new Utility\QueryString($queryString));
		$nonce = Utility\Guid::create();
		$timestamp = time();

		// Create signature:
		$endpoint = $this->buildApiEndpointUrl();
		$str = $this->apiSecret . $method . ($endpoint."/".trim($resource, "/")) . $preparedQueryString . $nonce . $timestamp;
		$signature = base64_encode(sha1($str, true));

		// Create authorization header
		$header = "Key=\"". $this->apiKey ."\",Timestamp=\"". $timestamp ."\",Nonce=\"". $nonce ."\",Signature=\"". $signature ."\"";
		return $header;
	}

	private function buildUrl($resource, $queryString) {
		return $this->buildApiEndpointUrl() ."/". trim($resource, "/") . "?". trim($queryString, "?");
	}

	/**
	 * Turns a QueryString object into an acceptable string representation for
	 * use in signature creation. Sorts alphabetically by keys, and URL encodes
	 * (RFC 3986) both keys and values.
	 * 
	 * @access private
	 * @param $queryString 		The QueryString object
	 * @return string 			The prepared query string
	 */
	private function prepareQueryString(Utility\QueryString $queryString) {
		$queryString = iterator_to_array($queryString);
		ksort($queryString, SORT_STRING);
		foreach ( $queryString as $key => $value ) {
			unset($queryString[$key]);
			$key = $this->urlencode($key);
			$value = $this->urlencode($value);
			$queryString[$key] = $value;
		}
		return implode("&", array_map(function($key, $value) { return $key."=".$value; }, array_keys($queryString), array_values($queryString)));
	}

	private function urlencode($value) {
		$value = rawurlencode($value); $pos = 0;
		while ( ($pos = strpos($value, "%", $pos)) !== false ) {
			// check if it matches a urlencoded value
			$encodedChar = substr($value, $pos, 3);
			if ( preg_match("/^%[0-9A-F]{2}$/", $encodedChar) ) {
				$value = substr_replace($value, strtolower($encodedChar), $pos, 3);
			}
			$pos += 3;
		}
		return $value;
	}

	/**
	 * Builds the API endpoint with the specified version number.
	 */
	private function buildApiEndpointUrl() {
		if ( strpos($this->apiEndpoint, "/v".$this->version) === false ) 
			return trim($this->apiEndpoint, "/") . "/v". $this->version;
		return $this->apiEndpoint;
	}
}