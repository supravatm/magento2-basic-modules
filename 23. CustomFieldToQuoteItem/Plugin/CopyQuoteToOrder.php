<?php
declare(strict_types=1);

namespace SMG\CustomFieldToQuoteItem\Plugin;

class CopyQuoteToOrder
{
    /**
     * Convert Quote to Order
     *
     * @param \Magento\Quote\Model\Quote\Item\ToOrderItem $subject
     * @param \Closure $proceed
     * @param \Magento\Quote\Model\Quote\Item\AbstractItem $item
     * @param array $additional
     * @return void
     */
    public function aroundConvert(
        \Magento\Quote\Model\Quote\Item\ToOrderItem $subject,
        \Closure $proceed,
        \Magento\Quote\Model\Quote\Item\AbstractItem $item,
        $additional = []
    ) {
         /** @var \Magento\Sales\Model\Order\Item $orderItem */
         $orderItem = $proceed($item, $additional);
         $orderItem->setManufacturer($item->getManufacturer());
         
         return $orderItem;
    }
}
