<?php
namespace SMG\CustomCron\Cron;

use Psr\Log\LoggerInterface;

class Test
{
    /**
     * @var Psr\Log\LoggerInterface $logger
     */
    protected $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

   /**
    * Write to system.log
    *
    * @return void
    */
    public function execute()
    {
        $this->logger->info('Cron Works');
    }
}
