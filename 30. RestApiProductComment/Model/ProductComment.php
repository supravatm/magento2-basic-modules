<?php

namespace SMG\RestApiProductComment\Model;

use Magento\Framework\Model\AbstractModel;
use \SMG\RestApiProductComment\Api\Data\ProductCommentInterface;

class ProductComment extends AbstractModel implements ProductCommentInterface
{
    public const CACHE_TAG = "PRODUCT_COMMENT_TAG";
    /**
     * Initialize model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel\ProductComment::class);
    }

    /**
     * @inheritdoc
     */
    public function getCommentId()
    {
        return $this->getData('comment_id');
    }

    /**
     * @inheritdoc
     */
    public function setCommentId($id)
    {
        $this->setData('comment_id', $id);
    }

    /**
     * @inheritdoc
     */
    public function getProductId()
    {
        return $this->getData('product_id');
    }

    /**
     * @inheritdoc
     */
    public function setProductId($productId)
    {
        $this->setData('product_id', $productId);
    }

    /**
     * @inheritdoc
     */
    public function getCustomerId()
    {
        return $this->getData('customer_id');
    }

    /**
     * @inheritdoc
     */
    public function setCustomerId($customerId)
    {
        $this->setData('customer_id', $customerId);
    }

    /**
     * @inheritdoc
     */
    public function getTitle()
    {
        return $this->getData('title');
    }

    /**
     * @inheritdoc
     */
    public function setTitle($title)
    {
        $this->setData('title', $title);
    }

    /**
     * @inheritdoc
     */
    public function getStatus()
    {
        return $this->getData('status');
    }

    /**
     * @inheritdoc
     */
    public function setStatus($status)
    {
        $this->setData('status', $status);
    }

    /**
     * @inheritdoc
     */
    public function getComment()
    {
        return $this->getData('comment');
    }

    /**
     * @inheritdoc
     */
    public function setComment($comment)
    {
        $this->setData('comment', $comment);
    }

    /**
     * @inheritdoc
     */
    public function getCreationTime()
    {
        return $this->getData('creation_time');
    }

    /**
     * @inheritdoc
     */
    public function setCreationTime($date)
    {
        $this->setData('creation_time', $date);
    }

    /**
     * @inheritdoc
     */
    public function getUpdateTime()
    {
        return $this->getData('creation_time');
    }

    /**
     * @inheritdoc
     */
    public function setUpdateTime($date)
    {
        $this->setData('update_time', $date);
    }
}
