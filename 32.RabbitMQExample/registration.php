<?php
/**
 * Package:  M2-Commerce-RabbitMQ
 * Author: Supravat Mondal <supravat.com@gmail.com>
 * license: MIT
 * Copyright: 2025
 * Description: A brief description of the file's purpose.
 */

declare(strict_types=1);

use Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(
    ComponentRegistrar::MODULE,
    'SMG_RabbitMQExample',
    __DIR__
);
