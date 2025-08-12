<?php
declare(strict_types=1);
namespace SMG\ExemptProductType\Model\Product\Type;

use Magento\Catalog\Model\Product\Type\AbstractType;
use Magento\Catalog\Model\Product;

class Exempt extends AbstractType
{
    public const TYPE_EXEMPT = 'exempt';
    /**
     * Check is virtual product
     *
     * @param \Magento\Catalog\Model\Product $product
     * @return bool
     */
    public function isVirtual($product)
    {
        return true;
    }

    /**
     * Check that product of this type has weight
     *
     * @return bool
     */
    public function hasWeight()
    {
        return false;
    }
    /**
     * Delete data specifically for new product type
     *
     * @param \Magento\Catalog\Model\Product $product
     * @return void
     */
    public function deleteTypeSpecificData(Product $product):void
    {
        return; // phpcs:ignore
    }
}
