<?php declare(strict_types=1);
 
namespace SMG\OrderExtensionAttribute\Model;
 
use Magento\Framework\Model\AbstractModel;
use SMG\OrderExtensionAttribute\Model\ResourceModel\SalesOrder as ResourSalesOrder;
 
class SalesOrder extends AbstractModel
{
    /**
     * Initilise Model
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(ResourSalesOrder::class);
    }
}
