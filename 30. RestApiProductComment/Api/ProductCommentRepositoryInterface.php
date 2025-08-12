<?php

namespace SMG\RestApiProductComment\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use \SMG\RestApiProductComment\Api\Data\ProductCommentInterface;

interface ProductCommentRepositoryInterface
{
    /**
     * Save comment
     *
     * @api
     * @param \SMG\RestApiProductComment\Api\Data\ProductCommentInterface $comment
     * @return \SMG\RestApiProductComment\Api\Data\ProductCommentInterface
     */
    public function save(\SMG\RestApiProductComment\Api\Data\ProductCommentInterface $comment);

    /**
     * Delete comment
     *
     * @api
     * @param \SMG\RestApiProductComment\Api\Data\ProductCommentInterface $comment
     * @return \SMG\RestApiProductComment\Api\Data\ProductCommentSearchResultsInterface
     */
    public function delete(ProductCommentInterface $comment);

    /**
     * Delete comment by id
     *
     * @api
     * @param int $id
     * @return void
     */
    public function deleteById($id);

    /**
     * Get comment by id
     *
     * @api
     * @param int $id
     * @return \SMG\RestApiProductComment\Api\Data\ProductCommentInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);

    /**
     * Get list
     *
     * @api
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \SMG\RestApiProductComment\Api\Data\ProductCommentSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $criteria);
}
