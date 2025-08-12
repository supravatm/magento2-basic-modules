<?php

namespace SMG\News\Controller\Adminhtml\Item;

use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

class Index extends Action implements HttpGetActionInterface
{
    public const ADMIN_RESOURCE = 'Magento_Backend::admin';

    /**
     * News
     *
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__('All News'));
        return $resultPage;
    }

    /**
     * @inheritdoc
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('SMG_News::actions_all')
            || $this->_authorization->isAllowed('SMG_News::reviewer')
            || $this->_authorization->isAllowed('SMG_News::bulk_delete')
            || $this->_authorization->isAllowed('SMG_News::update_or_new');
    }
}
