<?php

namespace SMG\News\Controller\Adminhtml\Item;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Registry;
use SMG\News\Model\NewsFactory;

class Edit extends Action implements HttpGetActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'SMG_News::update_or_new';

    /**
     * @var PageFactory
     */
    private $pageFactory;
    
    /**
     * @var NewsFactory
     */
    protected $newsFactory;

    /**
     * @param Context $context
     * @param PageFactory $rawFactory
     * @param NewsFactory $newsFactory
     */
    public function __construct(
        Context $context,
        PageFactory $rawFactory,
        NewsFactory $newsFactory
    ) {
        $this->pageFactory = $rawFactory;
        $this->newsFactory = $newsFactory;
        parent::__construct($context);
    }

    /**
     * Add the main Admin Grid page
     *
     * @return ResultInterface
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('news_id');
        $model = $this->newsFactory->create();

        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This news no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        // 5. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->pageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit News') : __('New News'),
            $id ? __('Edit news') : __('New News')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('News'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getTitle() : __('New News'));
        return $resultPage;
    }

    /**
     * Init page
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function initPage($resultPage)
    {
        $resultPage->setActiveMenu('SMG_News::add')
            ->addBreadcrumb(__('SMG'), __('SMG'))
            ->addBreadcrumb(__('SMG News'), __('SMG News'));
        return $resultPage;
    }

    /**
     * @inheritdoc
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('SMG_News::update_or_new');
    }
}
