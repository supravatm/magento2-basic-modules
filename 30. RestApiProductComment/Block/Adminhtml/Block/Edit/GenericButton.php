<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace SMG\RestApiProductComment\Block\Adminhtml\Block\Edit;

use Magento\Backend\Block\Widget\Context;
use SMG\RestApiProductComment\Api\ProductCommentRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class GenericButton
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var ProductCommentRepositoryInterface
     */
    protected $productCommentRepositoryInterface;

    /**
     * @param Context $context
     * @param ProductCommentRepositoryInterface $productCommentRepositoryInterface
     */
    public function __construct(
        Context $context,
        ProductCommentRepositoryInterface $productCommentRepositoryInterface
    ) {
        $this->context = $context;
        $this->productCommentRepositoryInterface = $productCommentRepositoryInterface;
    }

    /**
     * Return product comment ID
     *
     * @return int|null
     */
    public function getCommentId()
    {
        try {
            $commentId = $this->context->getRequest()->getParam('comment_id');
            if (!empty($commentId)) {
                return $this->productCommentRepositoryInterface->getById(
                    $this->context->getRequest()->getParam('comment_id')
                )->getId();
            }
        } catch (NoSuchEntityException $e) {
            return $e->getMessage();
        }
        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
