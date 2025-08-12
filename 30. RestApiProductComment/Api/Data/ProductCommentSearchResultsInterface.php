<?php

namespace SMG\RestApiProductComment\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface ProductCommentSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get items list.
     *
     * @return SMG\RestApiProductComment\Api\Data\ProductCommentSearchResultsInterface[]
     */
    public function getItems();
    
    /**
     * Set items list.
     *
     * @param SMG\RestApiProductComment\Api\Data\ProductCommentSearchResultsInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
