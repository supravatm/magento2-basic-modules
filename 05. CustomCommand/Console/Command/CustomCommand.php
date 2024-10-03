<?php
namespace SMG\CustomCommand\Console\Command;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;

class CustomCommand extends Command
{
    private $storeManager;

    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->storeManager = $storeManager;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('customcommand:storelist')
            ->setDescription('Displays the list of stores');
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $table = new Table($output);
            $table->setHeaders(['ID', 'Website ID', 'Group ID', 'Name', 'Code', 'Sort Order', 'Is Active']);

            foreach ($this->storeManager->getStores(true, true) as $store) {
                $table->addRow([
                    $store->getId(),
                    $store->getWebsiteId(),
                    $store->getStoreGroupId(),
                    $store->getName(),
                    $store->getCode(),
                    $store->getData('sort_order'),
                    $store->getData('is_active'),
                ]);
            }
            $table->render();
            return \Magento\Framework\Console\Cli::RETURN_SUCCESS;
        } catch(\Exception $e ) {
            $output->writeln('<error>' . $e->getMessage() . '</error>');
            if ($output->getVerbosity() >= OutputInterface::VERBOSITY_VERBOSE) {
                $output->writeln($e->getTraceAsString());
            }
            return \Magento\Framework\Console\Cli::RETURN_FAILURE;
        }
    }
}