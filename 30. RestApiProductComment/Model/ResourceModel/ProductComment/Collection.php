<?php

namespace SMG\RestApiProductComment\Model\ResourceModel\ProductComment;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use \SMG\RestApiProductComment\Model\ProductComment as Comment;
use \SMG\RestApiProductComment\Model\ResourceModel\ProductComment as ResourceComment;

class Collection extends AbstractCollection
{
    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(Comment::class, ResourceComment::class);
    }
}
