<?php

namespace SMG\SendOrder\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

class SendOrderObserver implements ObserverInterface
{
    /**
     *
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

    /**
     * Construct
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Observer method
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $order = $observer->getOrder();
        $shippingAddress = $order->getShippingAddress();
        $payment = $order->getPayment();
        $paymentMethod = $payment->getMethodInstance();
        $streetLines = $shippingAddress->getStreet();
        $items = [];
        foreach ($order->getAllItems() as $item) {
            if ($item->getHasChildren()) {
                foreach ($item->getChildrenItems() as $child) {
                    $returnItems[] = $child;
                    $items[$item->getId()] = [
                        "skuCode" => $child->getSku(),
                        "skuName" => $child->getName(),
                        "quantity" => $child->getQtyOrdered(),
                        "unitPrice" => $item->getPrice(),
                        "salesPrice" => $item->getRowTotal(),
                        "discount" => $item->getDiscountAmount(),
                        "storeCode" => "PS80",
                        "labels" => [
                            "GIVEAWAY"
                        ]
                    ];
                }
            }
            if (!$item->getParentItemId() && $item->getProductType() == 'simple') {
                $returnItems[] = $item;
                $items[$item->getId()] = [
                    "skuCode" => $item->getSku(),
                    "skuName" => $item->getName(),
                    "quantity" => $item->getQtyOrdered(),
                    "unitPrice" => $item->getPrice(),
                    "salesPrice" => $item->getRowTotal(),
                    "discount" => $item->getDiscountAmount(),
                    "storeCode" => "PS80",
                    "labels" => [
                        "GIVEAWAY"
                    ]
                ];
            }
        }
        $orderData = [
            'orderNumber'=> $order->getData('increment_id'),
            'buyer'=> [
                'firstname' => $shippingAddress->getFirstname(). ' '. $shippingAddress->getLastname()
            ],
            'shippingAddress' => [
                'receiverName' => $shippingAddress->getFirstname(). ' '. $shippingAddress->getLastname(),
                'address1' => $streetLines[0],
                'address2' => '',
                'state' => $shippingAddress->getRegion(),
                'city' => $shippingAddress->getCity(),
                'district' => '',
                'postalCode' => $shippingAddress->getPostcode(),
                'receiverPhone' => $shippingAddress->getTelephone(),
                'latitude' => '',
                'longitude' => ''
            ],
            'deliveryType' => $order->getData('shipping_method'),
            'payments' => [
                "paymentMethod" => $paymentMethod->getTitle(),
                "amount" => $order->getData('grand_total')
            ],
            "shipping" => [
                "courier" => $order->getData('shipping_method'),
                "serviceType" => $order->getData('shipping_description'),
                "shippingFee" => $order->getData('shipping_amount'),
            ],
            "created" =>  $order->getData('created_at'),
            "remark" => "",
            "orderDetails" => $items
        ];

        $this->logger->info(json_encode($orderData));
    }
}
