<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace SMG\RestApiProductComment\Block\Product;

use \Magento\Catalog\Api\ProductRepositoryInterface;
use \SMG\RestApiProductComment\Model\ResourceModel\ProductComment\Collection as CommentCollection;
use SMG\RestApiProductComment\Model\ResourceModel\ProductComment\CollectionFactory;

/**
 * Product Reviews Page
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class View extends \Magento\Catalog\Block\Product\View
{
    /**
     *
     * @var CollectionFactory
     */
    protected $_commentColFactory;

    /**
     *
     * @var mixed
     */
    private $commentCollection;
    /**
     *
     * @param \Magento\Catalog\Block\Product\Context $context
     * @param \Magento\Framework\Url\EncoderInterface $urlEncoder
     * @param \Magento\Framework\Json\EncoderInterface $jsonEncoder
     * @param \Magento\Framework\Stdlib\StringUtils $string
     * @param \Magento\Catalog\Helper\Product $productHelper
     * @param \Magento\Catalog\Model\ProductTypes\ConfigInterface $productTypeConfig
     * @param \Magento\Framework\Locale\FormatInterface $localeFormat
     * @param \Magento\Customer\Model\Session $customerSession
     * @param ProductRepositoryInterface $productRepository
     * @param \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency
     * @param \SMG\RestApiProductComment\Model\ResourceModel\ProductComment\CollectionFactory $collectionFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Framework\Url\EncoderInterface $urlEncoder,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Magento\Framework\Stdlib\StringUtils $string,
        \Magento\Catalog\Helper\Product $productHelper,
        \Magento\Catalog\Model\ProductTypes\ConfigInterface $productTypeConfig,
        \Magento\Framework\Locale\FormatInterface $localeFormat,
        \Magento\Customer\Model\Session $customerSession,
        ProductRepositoryInterface $productRepository,
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
        CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->_commentColFactory = $collectionFactory;
        parent::__construct(
            $context,
            $urlEncoder,
            $jsonEncoder,
            $string,
            $productHelper,
            $productTypeConfig,
            $localeFormat,
            $customerSession,
            $productRepository,
            $priceCurrency,
            $data
        );
    }

    /**
     * Render block HTML
     *
     * @return string
     */
    protected function _toHtml()
    {
        $this->getProduct()->setShortDescription(null);

        return parent::_toHtml();
    }

    /**
     * Get collection of Comments
     *
     * @return CommentCollection
     */
    public function getCommentsCollection()
    {
        if (null === $this->commentCollection) {

            $collection = $this->_commentColFactory->create()->addFieldToFilter(
                'product_id',
                $this->getProductId()
            );

            $this->commentCollection = $this->_commentColFactory->create()->addFieldToFilter(
                'product_id',
                $this->getProduct()->getId()
            );
        }
        return $this->commentCollection;
    }
}
