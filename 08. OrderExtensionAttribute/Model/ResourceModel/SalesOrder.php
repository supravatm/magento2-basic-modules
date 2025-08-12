<?php declare(strict_types=1);
 
namespace SMG\OrderExtensionAttribute\Model\ResourceModel;
 
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
 
class SalesOrder extends AbstractDb
{
    /**
     * Initilize Resource Model
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init('smg_sales_order_po_number', 'id');
    }
}
