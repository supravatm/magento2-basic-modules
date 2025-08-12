<?php

namespace SMG\RestApiProductComment\Controller\Adminhtml\Index;

use Magento\Framework\App\Action\HttpPostActionInterface;

use Magento\Backend\Model\Session as BackendSession;

class Delete extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'SMG_RestApiProductComment::productcomment';

    /**
     * @var BackendSession
     */
    protected BackendSession $backendSession;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param BackendSession $backendSession
     */
    public function __construct(\Magento\Backend\App\Action\Context $context, BackendSession $backendSession)
    {
        $this->backendSession = $backendSession;
        parent::__construct($context);
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('comment_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create(\SMG\RestApiProductComment\Model\ProductComment::class);
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the comment.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['comment_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a comment to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
