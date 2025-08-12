<?php
// phpcs:ignoreFile
namespace SMG\CustomAddProductAttribute\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Eav\Setup\EavSetupFactory;

class UpgradeData implements UpgradeDataInterface
{
    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), "1.0.1", "<")) {
            $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

            $eavSetup->updateAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'sample_attribute',
                'frontend_label',
                'SMG Custom Attribute'
            );
        }
        if (version_compare($context->getVersion(), "1.0.2", "<")) {
            $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

            $eavSetup->updateAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'sample_attribute',
                'frontend_label',
                'Custom Attribute'
            );
        }
        /**
         * adding attribute with dropdown
         */
        if (version_compare($context->getVersion(), "1.0.3", "<")) {
            $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'custom_option_attribute',
                [
                    'type' => 'int',
                    'label' => 'Custom Option Attribute',
                    'input' => 'select',
                    'source' => \Magento\Eav\Model\Entity\Attribute\Source\Table::class,
                    'required' => false,
                    'option' => ['values' => ['Value 1', 'Value 2', 'Value 3']]
                ]
            );
        }
    }
}

