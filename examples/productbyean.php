<?php
/**
 * This SyndicatePlus Api examples searches the SyndicatePlus API for
 * for a specified (valid) EAN code and displays the matching product
 * information as simple HTML
 */

define('APIKEY', 'my api key here');
define('APISECRET', 'my api secret here');

define('EAN', 8722700462989);

require_once "../src/productsapi.class.php";

// Create api client instance, no need to specify version since
// it defaults to the latest version of the API
$api = new SyndicatePlus\Api\ProductsApi(APIKEY, APISECRET);

?><h1>Search by EAN - Result for "<?php echo EAN; ?>"</h1><?php

$product = $api->getProductByEan(EAN);
?>

<img height="80" style="float: left; margin: 10px;" src="<?php echo strtolower($product->ImageUrl); ?>" />
<span>Product: <?php echo $product->Name; ?></span><br />
<span>Brand: <?php echo $product->Brand->Name; ?></span><br />
<span>Manufacturer: <?php echo $product->Manufacturer->Name; ?></span>
<div style="clear: both;"></div>
<hr />