<?php
/**
 * Package:  M2-Commerce-RabbitMQ
 * Author: Supravat Mondal <supravat.com@gmail.com>
 * license: MIT
 * Copyright: 2025
 * Description: A brief description of the file's purpose.
 */
declare(strict_types= 1);

namespace SMG\RabbitMQExample\Console\Command;

use Magento\Framework\Console\Cli;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use SMG\RabbitMQExample\Model\Publisher;

class PublishMessageCommand extends Command
{
    /**
     *
     * @var Publisher
     */
    protected $publisher;
    /**
     * Class Constructor
     *
     * @param Publisher $publisher
     */
    public function __construct(Publisher $publisher)
    {
        $this->publisher = $publisher;
        parent::__construct();
    }
    /**
     * Configure function
     *
     * @return void
     */
    protected function configure()
    {
        $this->setName('example:rabbitmq:publish')
            ->setDescription('Publish a message to the RabbitMQ queue');
        parent::configure();
    }
    /**
     * Execute method
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->publisher->execute('Hello, RabbitMQ!');
        $output->writeln('<info>Message published successfully</info>');
        return Cli::RETURN_SUCCESS;
    }
}
