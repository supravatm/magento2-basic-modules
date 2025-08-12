<?php

declare(strict_types=1);

namespace SMG\CustomerTelephoneValidate\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Customer\Setup\CustomerSetupFactory;
use Psr\Log\LoggerInterface;
use Magento\Customer\Api\AddressMetadataInterface;
use SMG\CustomerTelephoneValidate\Model\Attribute\Backend\Telephone;

class UpdateTelephone implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var CustomerSetupFactory
     */
    private $customerSetup;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param CustomerSetupFactory $customerSetupFactory
     * @param LoggerInterface $logger
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        CustomerSetupFactory $customerSetupFactory,
        LoggerInterface $logger
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->customerSetup = $customerSetupFactory->create(['setup' => $moduleDataSetup]);
        $this->logger = $logger;
    }

    /**
     * @inheritdoc
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        try {
            $this->customerSetup->addAttribute(
                AddressMetadataInterface::ENTITY_TYPE_ADDRESS,
                'telephone',
                [
                    'type' => 'static',
                    'label' => 'Phone Number',
                    'input' => 'text',
                    'backend' => Telephone::class,
                    'sort_order' => 120,
                    'system' => true,
                    'user_defined' => false,
                    'validate_rules' => '{"max_text_length":255,"min_text_length":3}',
                    'position' => 120,
                    'is_used_in_grid' => true,
                    'is_visible_in_grid' => true,
                    'is_filterable_in_grid' => true,
                    'is_searchable_in_grid' => true,
                ]
            );
        } catch (Exception $e) {
            $this->logger->err($e->getMessage());
        }
        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * @inheritdoc
     */
    public function getAliases(): array
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public static function getDependencies(): array
    {
        return [];
    }
}
