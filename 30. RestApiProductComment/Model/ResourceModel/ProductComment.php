<?php

namespace SMG\RestApiProductComment\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class ProductComment extends AbstractDb
{
    /**
     * @var string
     */
    protected $_idFieldName = 'comment_id';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('smg_product_comment', 'comment_id');
    }
}
