<?php

namespace SMG\RestApiProductComment\Controller\Product;

use Magento\Framework\App\ActionInterface;

use Magento\Framework\Controller\ResultFactory;
use SMG\RestApiProductComment\Model\ModelFactory;
use SMG\RestApiProductComment\Model\ModelRepository;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use SMG\RestApiProductComment\Model\ProductCommentFactory;
use SMG\RestApiProductComment\Api\ProductCommentRepositoryInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\Message\ManagerInterface;

class Post extends Action implements HttpGetActionInterface, HttpPostActionInterface
{

    /**
     * @var ResultFactory
     */
    protected $resultFactory;
    /**
     * @var CustomerRepositoryInterface
     */
    protected $customerRepository;
   /**
    * @var ProductCommentFactory
    */
    protected $productCommentFactory;
    /**
     * @var ProductCommentRepositoryInterface
     */
    protected $productCommentRepository;
    /**
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param ProductCommentFactory $productCommentFactory
     * @param CustomerRepositoryInterface $customerRepository
     * @param ProductCommentRepositoryInterface $productCommentRepository
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        ProductCommentFactory $productCommentFactory,
        CustomerRepositoryInterface $customerRepository,
        ProductCommentRepositoryInterface $productCommentRepository
    ) {
        $this->resultFactory = $resultPageFactory;
        $this->productCommentFactory = $productCommentFactory;
        $this->productCommentRepository = $productCommentRepository;
        $this->customerRepository = $customerRepository;
        return parent::__construct($context);
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $data = $this->getRequest()->getPostValue();
        $productId = (int)$this->getRequest()->getParam('id');
        $email = $this->getRequest()->getPost('email');
        
        try {
            $customer = $this->customerRepository->get($email);
            $data = [
                "product_id" => $productId,
                "customer_id" => $customer->getId() ?: 0,
                "title" => $this->getRequest()->getPost('title'),
                "comment" => $this->getRequest()->getPost('comment')
            ];
            $obj = $this->productCommentFactory->create();
            $this->productCommentRepository->save($obj->addData($data)); // Service Contract
            $this->messageManager->addSuccessMessage(__('You submitted your comment for moderation.'));

        } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
            
            $data = [
                "product_id" => $productId,
                "customer_id" => 0,
                "title" => $this->getRequest()->getPost('title'),
                "comment" => $this->getRequest()->getPost('comment')
            ];
            $obj = $this->productCommentFactory->create();
            $this->productCommentRepository->save($obj->addData($data)); // Service Contract
            $this->messageManager->addSuccessMessage(__('You submitted your comment for moderation.'));
        }
        $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;
    }
}
