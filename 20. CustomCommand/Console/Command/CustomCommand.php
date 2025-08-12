<?php
namespace SMG\CustomCommand\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Command\Command;

class CustomCommand extends Command
{
    /**
     * Name argument
     */
    public const NAME_ARGUMENT = 'name';

    /**
     * Allow option
     */
    public const ALLOW_ANONYMOUS = 'allow-anonymous';

    /**
     * Anonymous name
     */
    public const ANONYMOUS_NAME = 'Anonymous';

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setName('custom:first:command')
            ->setDescription('s.')
            ->setDefinition([
                new InputArgument(
                    self::NAME_ARGUMENT,
                    InputArgument::OPTIONAL,
                    'Name'
                ),
                new InputOption(
                    self::ALLOW_ANONYMOUS,
                    '-a',
                    InputOption::VALUE_NONE,
                    'Allow anonymous'
                ),

            ]);

        parent::configure();
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
            $name = $input->getArgument(self::NAME_ARGUMENT);
            $allowAnonymous = $input->getOption(self::ALLOW_ANONYMOUS);
            if ($name === null) {
                if ($allowAnonymous) {
                    $name = self::ANONYMOUS_NAME;
                } else {
                    throw new \InvalidArgumentException('Argument ' . self::NAME_ARGUMENT . ' is missing.');
                }
            }
            $output->writeln('<info>Hello ' . $name . '!</info>');
            $output->writeln('<info>Success This is my first console command.</info>');
            return \Magento\Framework\Console\Cli::RETURN_SUCCESS;
        } catch (\Exception $e) {
            $output->writeln('<error>' . $e->getMessage() . '</error>');
            if ($output->getVerbosity() >= OutputInterface::VERBOSITY_VERBOSE) {
                $output->writeln($e->getTraceAsString());
            }
            return \Magento\Framework\Console\Cli::RETURN_FAILURE;
        }
    }
}
