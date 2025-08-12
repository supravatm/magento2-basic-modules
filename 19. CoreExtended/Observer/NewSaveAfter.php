<?php

declare(strict_types=1);

namespace SMG\CoreExtended\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Serialize\SerializerInterface;
use Psr\Log\LoggerInterface;
use SMG\News\Model\News;

class NewSaveAfter implements ObserverInterface
{
    /**
     * @var RequestInterface $_request
     */
    protected $_request;

    /**
     * @var SerializerInterface $serializer
     */
    protected $serializer;
    /**
     * @var LoggerInterface $logger
     */
    protected $logger;

    /**
     *
     * @param RequestInterface $request
     * @param SerializerInterface $serializer
     * @param LoggerInterface $logger
     */
    public function __construct(
        RequestInterface $request,
        SerializerInterface $serializer,
        LoggerInterface $logger
    ) {
        $this->_request = $request;
        $this->serializer = $serializer;
        $this->logger = $logger;
    }

    /**
     * Set Additional Data to Quote_item
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        try {
            if ($observer->getEvent()->getObject() instanceof News) {
                $this->logger->debug("Sample event: how to observe event call");
                $this->logger->debug("what if the model I want to affect has no '_eventPrefix' specified");
            }
            
        } catch (Exception $ex) {
            $this->logger->critical($ex->getMessage());
        }
    }
}
