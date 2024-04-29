<?php

declare(strict_types=1);

use App\Controller\ProductController;

require __DIR__ . '/../vendor/autoload.php';

$productID = 'a1';

$product = new ProductController();
print_r($product->detail($productID));