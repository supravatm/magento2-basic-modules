<?php declare(strict_types=1);
 
namespace SMG\OrderExtensionAttribute\Model\ResourceModel\SalesOrder;
 
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use SMG\OrderExtensionAttribute\Model\SalesOrder;
use SMG\OrderExtensionAttribute\Model\ResourceModel\SalesOrder as SMGOrderExtensionSalesOrder;
 
class Collection extends AbstractCollection
{
    /**
     * Inisilize resource model
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(SalesOrder::class, SMGOrderExtensionSalesOrder::class);
    }
}
