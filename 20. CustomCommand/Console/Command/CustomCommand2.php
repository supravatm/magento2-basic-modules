<?php
namespace SMG\CustomCommand\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Command\Command;
use Magento\Sales\Cron\CleanExpiredQuotes;

class CustomCommand2 extends Command
{
    /**
     * Name argument
     */
    public const QUOTE_LIFETIME = 'quote-life';

    /**
     * Allow option
     */
    public const QUOTE_LIFETIME_DEFAULT = 'default-life';
    /**
     * @var CleanExpiredQuotes
     */
    protected CleanExpiredQuotes $cleanExpiredQuotes;
    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setName('custom:first:command2')
            ->setDescription('This is my 2nd console command.')
            ->setDefinition([
                new InputArgument(
                    self::QUOTE_LIFETIME,
                    InputArgument::REQUIRED,
                    'Quote life time'
                ),
                new InputOption(
                    self::QUOTE_LIFETIME_DEFAULT,
                    '-d',
                    InputOption::VALUE_NONE,
                    'quote default life'
                ),

            ]);

        parent::configure();
    }
    /**
     * Class Construct
     *
     * @param CleanExpiredQuotes $cleanExpiredQuotes
     */
    public function __construct(CleanExpiredQuotes $cleanExpiredQuotes)
    {
        $this->cleanExpiredQuotes = $cleanExpiredQuotes;
        parent::__construct();
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
            $day = $input->getArgument(self::QUOTE_LIFETIME);
            $todat = $input->getOption(self::QUOTE_LIFETIME_DEFAULT);
            $this->cleanExpiredQuotes->execute();
            $output->writeln('<info>Quote Deleted</info>');
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
