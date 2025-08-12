<?php

namespace SMG\ControllerResponseTypes\Controller\Response;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;

class Json extends Action
{
    /**
     *
     * @var JsonFactory
     */
    protected JsonFactory $jsonFactory;
    /**
     * Construct
     *
     * @param Context $context
     * @param JsonFactory $jsonFactory
     */
    public function __construct(
        Context $context,
        JsonFactory $jsonFactory
    ) {
        $this->jsonFactory = $jsonFactory;
        parent::__construct($context);
    }

    /**
     * Show the Controller Response Types Raw Result.
     *
     * @return \Magento\Framework\Controller\Result\Raw
     */
    public function execute()
    {

        $result = $this->jsonFactory->create();
        $data = [
            'foo'  => 'bar',
            'success' => true
        ];
        if ($this->_request->getParam('origin')) {
            $data = [
                'name' => "Supravat",
                'dob' => '1970-01-01',
                'nationality' => "IND",
            ];
        }
        $result->setData($data);
        return $result;
    }
}
