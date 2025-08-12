<?php
 
declare(strict_types=1);
 
namespace SMG\CheckoutDeliveryDate\Plugin\Api;
 
use SMG\OrderExtensionAttribute\Model\ResourceModel\SalesOrder\Collection;
use SMG\OrderExtensionAttribute\Model\ResourceModel\SalesOrder\CollectionFactory;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Sales\Api\Data\OrderInterface;

class AddDeliveryDateToSalesOrder
{
    /**
     * Get Order Plugin
     *
     * @param OrderRepositoryInterface $subject
     * @param OrderInterface $result
     * @return mixed
     */
    public function afterGet(
        OrderRepositoryInterface $subject,
        $result
    ) {
        // Then, we get the extension attributes that are currently assigned to this order.
        $extensionAttributes = $result->getExtensionAttributes();
 
        // We then call "setData" on the property we want to set, wtih the value from our custom table.
        $extensionAttributes->setData('delivery_date', $result->getData('delivery_date'));
 
        // Then, just re-set the extension attributes containing the newly added data...
        $result->setExtensionAttributes($extensionAttributes);
 
        // ...and finally, return the result.
        return $result;
    }
 
    /**
     * Plugin Get Order List
     *
     * @param OrderRepositoryInterface $subject
     * @param OrderInterface $result
     * @return mixed
     */
    public function afterGetList(
        OrderRepositoryInterface $subject,
        $result
    ) {
        // We do the same thing here, and can save some time by passing the logic to afterGet.
        foreach ($result->getItems() as $order) {
            $this->afterGet($subject, $order);
        }
        return $result;
    }
}
