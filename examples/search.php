<?php
/**
 * This SyndicatePlus Api examples searches the SyndicatePlus API for
 * for the popular Dutch beer brand called "Heineken" and displays the
 * results as simple HTML.
 */

define('APIKEY', 'my api key here');
define('APISECRET', 'my api secret here');

require_once "../src/productsapi.class.php";

// Create api client instance, no need to specify version since
// it defaults to the latest version of the API
$api = new SyndicatePlus\Api\ProductsApi(APIKEY, APISECRET);

?><h1>Results for "Heineken"</h1><?php

$results = $api->search("Heineken");
foreach ( $results as $product ) {
	?>
	<img height="80" style="float: left; margin: 10px;" src="<?php echo $product->ImageUrl; ?>" />
	<span>Product: <?php echo $product->Name; ?></span><br />
	<span>Brand: <?php echo $product->Brand->Name; ?></span><br />
	<span>Manufacturer: <?php echo $product->Manufacturer->Name; ?></span>
	<div style="clear: both;"></div>
	<hr />
	<?php
}
?>