<?php

declare(strict_types=1);

namespace SMG\PluginExample\Model;

use Magento\Catalog\Api\Data\ProductInterface;

class ProductKey
{
    /**
     * Get Product Key
     *
     * @param ProductInterface $product
     * @param string $prefix
     * @return string
     */
    public function getKey(ProductInterface $product, string $prefix = 'Item'): string
    {
        return sprintf('%s : %s', $prefix, $product->getSku());
    }
}
