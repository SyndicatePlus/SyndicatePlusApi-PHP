<?php
/**
 * This SyndicatePlus Api examples searches the SyndicatePlus API for
 * for the popular Dutch beer brand called "Heineken" and displays the
 * results as simple HTML.
 */

define('APIKEY', 'mKmXPT4M7K40p1kSmxLgiziT_GRbpiAFdTsTRZyz0J4qAd5bkqBiyvTzp80IUJeEmTeoIzmXny8YEuS9kKWl40gfG7ikt9MJu1xMs2uOCkvh_N3ezAMTDcU4kJsgxwi1weEtK3wC1nBZPZ8Kv8Jnn4SV3iR_IKuv_AGaG7m7KLQ=');
define('APISECRET', 'tKkh7YCrT7MSxOC1QH_K62XXsqlwpZqBkhHUYRWSqLMFeKHM3bcrEAhFLMAsntqCQjWBJRakoQegZBsmBgq2gjvqq2gI0UbmaAH4VNeKXsxv9z2mrHiFMtrqV-bkchO1KwSLS38E8C5z1yoh-aumHDTkjVhDpYhxzdc0KO6Y9xw=');

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