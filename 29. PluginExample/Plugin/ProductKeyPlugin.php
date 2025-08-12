<?php
declare(strict_types=1);

namespace SMG\PluginExample\Plugin;

use SMG\PluginExample\Model\ProductKey;
use Magento\Catalog\Api\Data\ProductInterface;

class ProductKeyPlugin
{

    /**
     * Example Before
     *
     * @param ProductKey $subject
     * @param ProductInterface $product
     * @param string $prefix
     * @return array
     */
    public function beforeGetKey(ProductKey $subject, ProductInterface $product, string $prefix = 'item')
    {
        $prefix = "[" . $prefix ."-". $product->getId() . "]";
        return [$product, $prefix];
    }
    /**
     * Example After
     *
     * @param ProductKey $subject
     * @param string $result
     * @param ProductInterface $product
     * @param string $prefix
     * @return mixed $result
     */
    public function afterGetKey(ProductKey $subject, $result, ProductInterface $product, string $prefix = 'item')
    {
        return $result . " ==> ". $product->getName();
    }
    /**
     * Example Around plugin
     *
     * @param ProductKey $subject
     * @param callable $proceed
     * @param array|mixed $args
     * @return void
     */
    public function aroundGetKey(ProductKey $subject, callable $proceed, ...$args)
    {
        $result =  $proceed(...$args);
        $result .= ' Item ';
        return $result;
    }
}
