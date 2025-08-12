<?php
namespace SMG\RestApiProductComment\Api\Data;

interface ProductCommentInterface
{
    /**
     * Return the Comment ID
     *
     * @return int
     */
    public function getCommentId();

    /**
     * Set Comment ID
     *
     * @param int $id
     * @return $this
     */
    public function setCommentId($id);

    /**
     * Return the Product ID associated with Comment
     *
     * @return int
     */
    public function getProductId();

    /**
     * Set the Product ID associated with Comment
     *
     * @param int $productId
     * @return $this
     */
    public function setProductId($productId);

    /**
     * Return the Customer ID associated with comment
     *
     * @return string
     */
    public function getCustomerId();

    /**
     * Set the Customer ID associated with comment
     *
     * @param string $customerId
     * @return $this
     */
    public function setCustomerId($customerId);

    /**
     * Return the Customer Comments
     *
     * @return string
     */
    public function getComment();

    /**
     * Set Comment
     *
     * @param string $comment
     * @return $this
     */
    public function setComment($comment);

    /**
     * Return title
     *
     * @return string
     */
    public function getTitle();

    /**
     * Set Title
     *
     * @param string $title
     * @return $this
     */
    public function setTitle($title);

     /**
      * Return status
      *
      * @return int
      */
    public function getStatus();

    /**
     * Set status
     *
     * @param string $status
     * @return $this
     */
    public function setStatus($status);

    /**
     * Return the Date and Time of record added
     *
     * @return string
     */
    public function getCreationTime();

    /**
     * Set the Date and Time of record added
     *
     * @param string $date
     * @return $this
     */
    public function setCreationTime($date);

    /**
     * Return the Date and Time of record update
     *
     * @return string
     */
    public function getUpdateTime();

    /**
     * Set the Date and Time of record update
     *
     * @param string $date
     * @return $this
     */
    public function setUpdateTime($date);
}
