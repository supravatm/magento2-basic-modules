<?php

namespace SMG\RestApiProductComment\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Backend\Model\Session as BackendSession;
use SMG\RestApiProductComment\Model\ProductCommentFactory as CommentFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

class Edit extends Action implements HttpGetActionInterface, HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'SMG_RestApiProductComment::productcomment';
    
    /**
     *
     * @var CommentFactory
     */
    protected $commentFactory;

    /**
     * @var BackendSession
     */
    protected BackendSession $backendSession;

    /**
     * Class construct
     *
     * @param Context $context
     * @param BackendSession $backendSession
     * @param CommentFactory $commentFactory
     */
    public function __construct(
        Context $context,
        BackendSession $backendSession,
        CommentFactory $commentFactory
    ) {
        $this->backendSession = $backendSession;
        $this->commentFactory = $commentFactory;
        parent::__construct($context);
    }

    /**
     * Add the main Admin Grid page
     *
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('comment_id');
        $model = $this->commentFactory->create();

        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This Comment no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->backendSession->setCommentData($model);
        
        // 5. Build edit form
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Comment') : __('New Comment'),
            $id ? __('Edit Comment') : __('New Comment')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Comments'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getTitle() : __('New Comment'));
        return $resultPage;
    }
    /**
     * Init Page
     *
     * @param ResultInterface $resultPage
     * @return ResultInterface
     */
    protected function initPage($resultPage)
    {
        $resultPage->setActiveMenu('SMG_RestApiProductComment::productcomment')
            ->addBreadcrumb(__('SMG'), __('SMG'))
            ->addBreadcrumb(__('Product Comment'), __('Product Comment'));
        return $resultPage;
    }
}
