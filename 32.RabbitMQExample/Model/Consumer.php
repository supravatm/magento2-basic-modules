<?php
/**
 * Package:  SMG_RabbitMQExample
 * Author: Supravat Mondal <supravat.com@gmail.com>
 * license: MIT
 * Copyright: 2025
 * Description: Process of a Queue data
 */

declare(strict_types=1);

namespace SMG\RabbitMQExample\Model;

use Exception;
use Psr\Log\LoggerInterface;
use Magento\Framework\MessageQueue\ConsumerInterface;

class Consumer
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Initialize dependencies.
     *
     * @param LoggerInterface $logger
     */
    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    /**
     * @inheritdoc
     */
    public function process($publishData)
    {
        try {
            // $publishData - is the queue data
            // Bussiness logic impelement based on publishData
            $this->logger->info($publishData);
        } catch (Exception $e) {
            $this->logger->critical($e->getMessage());
        }
    }
}
