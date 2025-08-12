<?php

namespace SMG\ControllerResponseTypes\Controller\Response;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\RawFactory;

class Raw extends Action
{
    /**
     * @var RawFactory
     */
    protected RawFactory $rawResultFactory;
    /**
     * Construct
     *
     * @param Context $context
     * @param RawFactory $rawResultFactory
     */
    public function __construct(
        Context $context,
        RawFactory $rawResultFactory
    ) {
        $this->rawResultFactory = $rawResultFactory;
        parent::__construct($context);
    }

    /**
     * Show the Controller Response Types Raw Result.
     *
     * @return \Magento\Framework\Controller\Result\Raw
     */
    public function execute()
    {
        $result = $this->rawResultFactory->create();
        $result->setHeader('Content-Type', 'text/plain; charset=UTF-8');
        $result->setContents("Hello, World!");
        return $result;
    }
}
