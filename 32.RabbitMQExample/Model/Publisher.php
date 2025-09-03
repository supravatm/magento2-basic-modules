<?php
/**
 * Package: SMG_RabbitMQExample
 * Author: Supravat Mondal <supravat.com@gmail.com>
 * license: MIT
 * Copyright: 2025
 * Description: Publish to Queue
 */

declare(strict_types= 1);

namespace SMG\RabbitMQExample\Model;

use Magento\Framework\MessageQueue\PublisherInterface;
use Magento\Framework\Serialize\Serializer\Json as SerializerJson;

class Publisher
{
    /**
     * @var PublisherInterface
     */
    private $publisher;

    /**
     * @var SerializerJson
     */
    private $serializerJson;

    /**
     * Publisher constructor
     *
     * @param PublisherInterface $publisher
     * @param SerializerJson $serializerJson
     */
    public function __construct(
        PublisherInterface $publisher,
        SerializerJson $serializerJson
    ) {
        $this->publisher = $publisher;
        $this->serializerJson = $serializerJson;
    }

    /**
     * Publish a message to the queue.
     *
     * @param array|mixed $message
     */
    public function execute($message)
    {
        $json = ["order_id" => random_int(0, 99), "random_bytes" => random_int(0, 99)];

        $jsonData = $this->serializerJson->serialize($json);
        $this->publisher->publish('example.topic', $jsonData);
    }
}
