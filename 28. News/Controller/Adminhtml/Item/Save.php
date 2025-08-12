<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace SMG\News\Controller\Adminhtml\Item;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Backend\App\Action\Context;
use SMG\News\Model\ResourceModel\News as ObjectResourceModel;
use SMG\News\Model\NewsFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Registry;

/**
 * Save CMS block action.
 */
class Save extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    public const ADMIN_RESOURCE = 'SMG_News::save';

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var NewsFactory
     */
    private $newsFactory;

    /**
     * @var ObjectResourceModel
     */
    private $objectResourceModel;

    /**
     * @param Context $context
     * @param Registry $coreRegistry
     * @param DataPersistorInterface $dataPersistor
     * @param NewsFactory|null $newsFactory
     * @param ObjectResourceModel|null $objectResourceModel
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        DataPersistorInterface $dataPersistor,
        NewsFactory $newsFactory = null,
        ObjectResourceModel $objectResourceModel = null
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->newsFactory = $newsFactory
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(NewsFactory::class);
        $this->objectResourceModel = $objectResourceModel
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(ObjectResourceModel::class);
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {

        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {

            if (empty($data['news_id'])) {
                $data['news_id'] = null;
            }

            /** @var \SMG\News\Model\News $model */
            $model = $this->newsFactory->create();

            $id = $this->getRequest()->getParam('news_id');
            if ($id) {
                try {
                    $model = $model->load($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('News no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the news.'));
                $this->dataPersistor->clear('news_data');
                
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the news.'));
            }

            $this->dataPersistor->set('news_data', $data);
            // return $resultRedirect->setPath('*/*/edit', ['news_id' => $id]);
        }
        return $resultRedirect->setPath('*/*/index');
    }
    /**
     * @inheritdoc
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('SMG_News::actions_all')
            || $this->_authorization->isAllowed('SMG_News::update_or_new');
    }
}
