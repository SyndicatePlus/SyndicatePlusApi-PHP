##SyndicatePlusApi-PHP

####Summary
The SyndicatePlus API is a platform that allows you to connect to the SyndicatePlus database for consumer product information. The main API is the SyndicatePlus Products API which allows you to search and get information on products, brands, categories and manufacturers.

####Api Access
For API access please visit the [SyndicatePlus Developer Portal][1] and [sign up][2] for an API key.

[1]: http://syndicateplus.com/developer-api/
[2]: http://syndicateplus.com/api-signup/

##Usage
Usage of the Products API is best illustrated by taking a look at the [examples][3]. To get started quickly, however, all you need to make a successful call to the SyndicatePlus API is the following code:

```
require "SyndicatePlusApi-PHP/src/productsapi.class.php";

$api = new SyndicatePlus\Api\ProductsApi('your app key', 'your app secret');

// Search products for query "Heineken"
$products = $api->search("Heineken");

// Get a product by its EAN code
$product = $api->getProductByEan(8722700462989)
```

[3]: https://github.com/SyndicatePlus/SyndicatePlusApi-PHP/tree/master/examples