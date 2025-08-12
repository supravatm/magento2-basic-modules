<?php
declare(strict_types=1);

namespace SMG\CustomFee\Block\Sales\Order;

use Magento\Framework\View\Element\Template;

class Fee extends Template
{
    /**
     * @var Order
     */
    protected $_order;
   
    /**
     * Get Order
     *
     * @return void
     */
    public function getOrder()
    {
        return $this->_order;
    }
    /**
     * Initialize all order totals relates with tax
     *
     * @return \Magento\Tax\Block\Sales\Order\Tax
     */
    public function initTotals()
    {
        $parent = $this->getParentBlock();
        $this->_order = $parent->getOrder();
        $fee = new \Magento\Framework\DataObject(
            [
                'code' => 'fee',
                'strong' => false,
                'value' => 0,
                'label' => __('Fee'),
            ]
        );

        $parent->addTotal($fee, 'fee');
        return $this;
    }
}
