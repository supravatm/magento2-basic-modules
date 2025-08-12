<?php
declare(strict_types=1);

namespace SMG\CustomFieldToQuoteItem\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;

class OrderItemAdditionalOptions implements ObserverInterface
{
    /**
     * Set additional options to Order Item
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        try {
            $quote = $observer->getQuote();
            $order = $observer->getOrder();
            $quoteItems = [];
            // Map Quote Item with Quote Item Id
            foreach ($quote->getAllVisibleItems() as $quoteItem) {
                $quoteItems[$quoteItem->getId()] = $quoteItem;
            }
            foreach ($order->getAllVisibleItems() as $orderItem) {
                $quoteItemId = $orderItem->getQuoteItemId();
                $quoteItem = $quoteItems[$quoteItemId];
                $additionalOptions = $quoteItem->getOptionByCode('additional_options');

                if ($additionalOptions->getValue()) {
                    // Get Order Item's other options
                    $options = $orderItem->getProductOptions();
                    // Set additional options to Order Item
                    $options['additional_options'] = json_decode($additionalOptions->getValue());
                    $orderItem->setProductOptions($options);
                }
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
