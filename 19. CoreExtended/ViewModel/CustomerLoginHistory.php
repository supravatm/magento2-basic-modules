<?php

declare(strict_types=1);

namespace SMG\CoreExtended\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Customer\Model\Session;

class CustomerLoginHistory implements ArgumentInterface
{
    /**
     * @var Session
     */
    private $_customerSession;
    /**
     *
     * @param \Magento\Customer\Model\Session $customerSession
     */
    public function __construct(
        Session $customerSession
    ) {
        $this->_customerSession = $customerSession;
    }
    /**
     * Example of return text value
     *
     * @return string|null
     */
    public function getCustomerData()
    {
        $customer = $this->_customerSession->getCustomer();
        return $this->_customerSession->getCustomer();
    }
}
