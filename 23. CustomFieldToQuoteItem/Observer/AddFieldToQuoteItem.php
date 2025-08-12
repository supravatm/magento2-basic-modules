<?php

declare(strict_types=1);

namespace SMG\CustomFieldToQuoteItem\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Serialize\SerializerInterface;
use Psr\Log\LoggerInterface;

class AddFieldToQuoteItem implements ObserverInterface
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
     * Class construct
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
            $quoteItem = $observer->getQuoteItem();
            $product = $observer->getProduct();
            $additionalData[] = [
                'label' => "Customer IP", //Custom option label
                'value' => "45.64.239.135", //Custom option value
                'material' => "45.64.239.135"
            ];
            $serializeData = $this->serializer->serialize($additionalData);
            $quoteItem->setAdditionalData($serializeData);
            $quoteItem->setMaterial($serializeData);

        } catch (Exception $ex) {
            $this->logger->critical($ex->getMessage());
        }
    }
}
