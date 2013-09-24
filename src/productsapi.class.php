<?php
namespace SyndicatePlus\Api;

require_once dirname(__FILE__) ."/syndicateplusapibase.class.php";

/**
 * The ProductsApi class is a simple wrapper around the SyndicatePlusApiBase
 * class to provide quick access to API resources through named functions.
 * Output of all these functions is the decoded raw json.
 */
class ProductsApi extends SyndicatePlusApiBase
{
	public function __construct($apiKey, $apiSecret, $version = 0) {
		parent::__construct($apiKey, $apiSecret, $version);
	}

	/**
	 * Returns a list of products that matched the product search query
	 *
	 * @access public
	 * @param $productQuery			The string to search for
	 * @return array
	 */
	public function search($productQuery) {
		$results = $this->sendRequest("/products", "q=productname:". rawurlencode($productQuery));
		return $results;
	}

	/**
	 * Returns a single product result if a product is found matching
	 * the specified product Id.
	 *
	 * @access public
	 * @param $productId 			The id of the product to look up
	 * @return object
	 */
	public function getProductById($productId) {
		$result = $this->sendRequest("/products/product/". $productId, "");
		return $result;
	}


	/**
	 * Returns a single product result if a product is found matching
	 * the specified product EAN code.
	 *
	 * @access public
	 * @param $ean 					The to-be-looked up EAN code
	 * @return object
	 */
	public function getProductByEan($ean)  {
		$result = $this->sendRequest("/products/product", "ean=$ean");
		return $result;
	}
}
?>