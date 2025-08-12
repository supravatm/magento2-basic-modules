<?php

namespace SMG\ControllerResponseTypes\Controller\Response;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\RedirectFactory;

class Redirect extends Action
{
    /**
     *
     * @var RedirectFactory
     */
    protected RedirectFactory $redirectFactory;
    /**
     * Construct
     *
     * @param Context $context
     * @param RedirectFactory $redirectFactory
     */
    public function __construct(
        Context $context,
        RedirectFactory $redirectFactory
    ) {
        $this->redirectFactory = $redirectFactory;
        parent::__construct($context);
    }

    /**
     * Show the Controller Response Types Raw Result.
     *
     * @return \Magento\Framework\Controller\Result\Raw
     */
    public function execute()
    {
        $resultRedirect = $this->redirectFactory->create();
        return $resultRedirect->setPath('*/*/json', ['origin' => 'redirect']);
    }
}
