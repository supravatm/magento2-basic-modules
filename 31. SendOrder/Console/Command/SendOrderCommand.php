<?php
namespace SMG\SendOrder\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Magento\Framework\Exception\LocalizedException;
use Magento\Sales\Api\OrderRepositoryInterface;
use Magento\Sales\Api\Data\OrderInterface;

class SendOrderCommand extends Command
{
    private const ORDER_NUMBER = 'order-number';

    private const ORDER_INCREMENT_ID = 'increment_id';

    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;

    /**
     * @param OrderRepositoryInterface $orderRepository
     */
    public function __construct(
        OrderRepositoryInterface $orderRepository
    ) {
        $this->orderRepository = $orderRepository;
        parent::__construct();
    }
    /**
     * Configure Command
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName('custom:order');
        $this->setDescription('Displays order data');
        $this->setDefinition($this->getInputList());
            
        parent::configure();
    }
    /**
     * Get Input list
     *
     * @return array
     */
    public function getInputList():array
    {
        return [
            new InputArgument(
                self::ORDER_NUMBER,
                InputArgument::REQUIRED,
                'Magento order number is required'
            ),
            new InputOption(
                self::ORDER_INCREMENT_ID,
                '-ord',
                InputOption::VALUE_OPTIONAL,
                'Order Increment value'
            ),
        ];
    }
    /**
     * Print stores in table formate
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $orderNumber = null;
            $orderNumber = (int) $input->getArgument(self::ORDER_NUMBER);
            if (!$orderNumber) {
                throw new LocalizedException(__("Magento '%1' is required", self::ORDER_NUMBER));
            }
            if ($orderNumber) {
                $order = $this->orderRepository->get($orderNumber);
                $orderpayload = $this->provideOrderInfo($order);
                
            }
            if ($input->getOption(self::ORDER_INCREMENT_ID)) {
                $output->writeln('<error>Provided Order Id is `' . $orderNumber . '`</error>');
            }
            $output->writeln(json_encode($orderpayload, true));
            return \Magento\Framework\Console\Cli::RETURN_SUCCESS;
        } catch (\Exception $e) {
            $output->writeln('<error>' . $e->getMessage() . '</error>');
            if ($output->getVerbosity() >= OutputInterface::VERBOSITY_VERBOSE) {
                $output->writeln($e->getTraceAsString());
            }
            return \Magento\Framework\Console\Cli::RETURN_FAILURE;
        }
    }

    /**
     * Order farmated to api requeste
     *
     * @param OrderInterface $order
     * @return array
     */
    protected function provideOrderInfo($order): array
    {
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
        return $orderData;
    }
}
