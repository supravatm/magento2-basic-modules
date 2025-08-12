<?php

declare(strict_types=1);

namespace SMG\PluginExample\ViewModel;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use SMG\PluginExample\Model\ProductKey;

class PluginExample implements ArgumentInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    protected ProductRepositoryInterface $productRepository;
    /**
     * @var ProductKey
     */
    protected ProductKey $productKey;

    /**
     * Example constructor.
     *
     * @param ProductRepositoryInterface $productRepository
     * @param ProductKey $productKey
     */
    public function __construct(ProductRepositoryInterface $productRepository, ProductKey $productKey)
    {
        $this->productRepository = $productRepository;
        $this->productKey = $productKey;
    }
    /**
     * Get Product key
     *
     * @param RequestInterface $request
     * @return string|null
     */
    public function getProductKey(RequestInterface $request):?string
    {
        $productId = $request->getParam('product_id');
        if (null !== $productId) {
            $product = $this->productRepository->getById($productId);
            return $this->productKey->getKey($product, 'Product');
        }
        return null;
    }
}
