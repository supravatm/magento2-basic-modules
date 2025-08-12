<?php

namespace SMG\News\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class News extends AbstractDb
{
    /**
     * @var string
     */
    protected $_idFieldName = 'news_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init('smg_news', 'news_id');
    }
}
