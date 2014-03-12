<?php
/**
 * This SyndicatePlus Api examples searches the SyndicatePlus API for
 * for a specified (valid) EAN code and displays the matching product
 * information as simple HTML
 */

define('APIKEY', 'my api key here');
define('APISECRET', 'my api secret here');

define('PRODUCT_ID', '420d6006-a171-4217-8155-af13c848bbbd');

require_once "../src/productsapi.class.php";

// Create api client instance, no need to specify version since
// it defaults to the latest version of the API
$api = new SyndicatePlus\Api\ProductsApi(APIKEY, APISECRET);

?><h1>Search by Product Id - Result for "<?php echo PRODUCT_ID; ?>"</h1><?php

$product = $api->getProductById(PRODUCT_ID);
?>

<img height="80" style="float: left; margin: 10px;" src="<?php echo strtolower($product->ImageUrl); ?>" />
<span>Product: <?php echo $product->Name; ?></span><br />
<span>Brand: <?php echo $product->Brand->Name; ?></span><br />
<span>Manufacturer: <?php echo $product->Manufacturer->Name; ?></span>
<div style="clear: both;"></div>
<hr />