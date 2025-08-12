<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace SMG\RestApiProductComment\Block\Catalog\Product;

/**
 * Detailed Product Reviews
 *
 * @api
 * @since 100.0.2
 */
class View extends \SMG\RestApiProductComment\Block\Product\View
{
    /**
     * Unused class property
     * @var false
     */
    protected $_forceHasOptions = false;

    /**
     * Get product id
     *
     * @return int|null
     */
    public function getProductId()
    {
        $product = $this->_coreRegistry->registry('product');
        return $product ? $product->getId() : null;
    }

    /**
     * Prepare product review list toolbar
     *
     * @return $this
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        $toolbar = $this->getLayout()->getBlock('product_comment_list.toolbar');
        if ($toolbar) {
            $toolbar->setCollection($this->getCommentsCollection());
            $this->setChild('toolbar', $toolbar);
        }

        return $this;
    }
    
    /**
     * Initialize review form
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('list.phtml');
    }
}
