<?php
declare(strict_types=1);

namespace SMG\CheckoutDeliverydate\Plugin\Checkout\Model;

use Exception;
use Magento\Quote\Api\CartRepositoryInterface;
use Psr\Log\LoggerInterface;

class ShippingInformationManagement
{
    /**
     * @var CartRepositoryInterface
     */
    public $cartRepository;
    /**
     * @var LoggerInterface
     */
    public $logger;
    /**
     * Construct
     *
     * @param CartRepositoryInterface $cartRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        CartRepositoryInterface $cartRepository,
        LoggerInterface $logger
    ) {
        $this->cartRepository = $cartRepository;
        $this->logger = $logger;
    }
    /**
     * Save address information.
     *
     * @param   Magento\Checkout\Model\ShippingInformationManagement $subject
     * @param   int $cartId
     * @param   ShippingInformationInterface $addressInformation
     * @return  PaymentDetailsInterface
     * @throws  InputException
     * @throws  NoSuchEntityException
     * @throws  StateException
     */
    public function beforeSaveAddressInformation($subject, $cartId, $addressInformation)
    {
        try {
            $quote = $this->cartRepository->getActive($cartId);
            $deliveryDate = $addressInformation->getShippingAddress()
                ->getExtensionAttributes()
                ->getDeliveryDate();
            $this->logger->info("plugin value : " . $deliveryDate);
            $quote->setDeliveryDate($deliveryDate);
            $this->cartRepository->save($quote);
        } catch (Exception $e) {
            $this->logger->info($e->getMessage());
        }
    }
}
