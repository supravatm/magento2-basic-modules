<?php
declare(strict_types=1);

namespace SMG\CustomFieldToQuoteItem\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\Serialize\SerializerInterface;

class SetAdditionalOptions implements ObserverInterface
{
    /**
     * @var RequestInterface $_request;
     */
    protected $_request;
    /**
     * @var SerializerInterface $serializer;
     */
    protected $serializer;
    /**
     * @param RequestInterface $request
     * @param SerializerInterface $serializer
     */
    public function __construct(
        RequestInterface $request,
        SerializerInterface $serializer
    ) {
        $this->_request = $request;
        $this->serializer = $serializer;
    }

    /**
     * Set Data to product custom option
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        // Check and set information according to your need
        $product = $observer->getProduct();
        if ($this->_request->getFullActionName() == 'checkout_cart_add') { //checking when product is adding to cart
            $product = $observer->getProduct();
            $additionalOptions = [];
            $additionalOptions[] = [
                'label' => "Some Label", //Custom option label
                'value' => "Your Information", //Custom option value
            ];
            $product->addCustomOption('additional_options', $this->serializer->serialize($additionalOptions));
        }
    }
}
