<?php

namespace SMG\ControllerResponseTypes\Controller\Response;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\ForwardFactory;

class Forward extends Action
{
    /**
     *
     * @var ForwardFactory
     */
    protected ForwardFactory $forwardFactory;
    /**
     *
     * @param Context $context
     * @param ForwardFactory $forwardFactory
     */
    public function __construct(
        Context $context,
        ForwardFactory $forwardFactory
    ) {
        $this->forwardFactory = $forwardFactory;
        parent::__construct($context);
    }

    /**
     * Show the Controller Response Types Raw Result.
     *
     * @return \Magento\Framework\Controller\Result\Raw
     */
    public function execute()
    {
        $forwardFactory = $this->forwardFactory->create();
        return $forwardFactory->forward('index');
    }
}
