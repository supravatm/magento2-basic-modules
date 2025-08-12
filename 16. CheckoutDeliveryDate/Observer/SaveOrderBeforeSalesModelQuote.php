<?php

namespace SMG\CheckoutDeliveryDate\Observer;

use Magento\Framework\DataObject\Copy as ObjectCopyService;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

/**
 * Submit quote
 */
class SaveOrderBeforeSalesModelQuote implements ObserverInterface
{
    /**
     * @var ObjectCopyService
     */
    public $objectCopyService;
    /**
     * @var LoggerInterface
     */
    public $logger;
    
    /**
     * Construct
     *
     * @param ObjectCopyService $objectCopyService
     * @param LoggerInterface $logger
     */
    public function __construct(
        ObjectCopyService $objectCopyService,
        LoggerInterface $logger
    ) {
        $this->objectCopyService = $objectCopyService;
        $this->logger = $logger;
    }

    /**
     * Execute function
     *
     * @param Observer $observer
     * @return $this
     */
    public function execute(Observer $observer)
    {
        if ($observer->getEvent()->getQuote()) {
            $quoteDeliveryData = $observer->getEvent()->getQuote()->getDeliveryDate();
            $this->logger->debug("SaveOrderBeforeSalesModelQuote : ". $quoteDeliveryData);
            $observer->getEvent()->getOrder()->setDeliveryDate($quoteDeliveryData);
        }
        return $this;
    }
}
