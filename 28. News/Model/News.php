<?php
namespace SMG\News\Model;

use Magento\Framework\Model\AbstractModel;

class News extends AbstractModel
{
    /**
     * @var string
     */
    protected const CACHE_TAG = 'simple_news';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(ResourceModel\News::class);
    }
}
