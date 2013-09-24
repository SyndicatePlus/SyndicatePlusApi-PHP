<?php
/**
 * This SyndicatePlus Api examples searches the SyndicatePlus API for
 * for the popular Dutch beer brand called "Grolsch" and displays the
 * results as simple HTML.
 */

define('APIKEY', 'my api key here');
define('APISECRET', 'my api secret here');

require_once "../src/productsapi.class.php";

// Create api client instance, no need to specify version since
// it defaults to the latest version of the API
$api = new SyndicatePlus\Api\ProductsApi(APIKEY, APISECRET);

$results = $api->search("Grolsch");
foreach ( $results as $product ) {
	var_dump($product);
}
?>