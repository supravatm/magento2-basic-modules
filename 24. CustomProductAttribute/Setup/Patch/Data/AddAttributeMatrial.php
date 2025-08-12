<?php

declare(strict_types=1);

namespace SMG\CustomProductAttribute\Setup\Patch\Data;

use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Catalog\Model\Product;
use Psr\Log\LoggerInterface;
use \Magento\Eav\Model\Entity\Attribute\Source\Table as SourceTable;
use SMG\CustomProductAttribute\Model\Attribute\Backend\Material as Backend;
use SMG\CustomProductAttribute\Model\Attribute\Frontend\Material as Frontend;

class AddAttributeMatrial implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private ModuleDataSetupInterface $moduleDataSetup;

    /**
     * @var EavSetupFactory
     */
    private EavSetupFactory $eavSetupFactory;

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory $eavSetupFactory
     * @param LoggerInterface $logger
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory,
        LoggerInterface $logger
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->logger = $logger;
    }

    /**
     * @inheritdoc
     */
    public function apply()
    {
        try {
            //$productTypes = implode(',', [Type::TYPE_SIMPLE, Type::TYPE_VIRTUAL, Type::]);
            $productTypes = 'configurable';
            /** @var EavSetup $eavSetup */
            $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);

            $eavSetup->addAttribute(
                Product::ENTITY,
                'clothing_material',
                [
                    'label'                     => 'Clothing Material',
                    'type'                      => 'varchar',
                    'input'                     => 'select',
                    'group'                     => 'Product Details',
                    'required'                  => false,
                    'visible'                   => true,
                    'frontend_class'            => '',
                    'global'                    => ScopedAttributeInterface::SCOPE_GLOBAL,
                    'source'                    => SourceTable::class,
                    'backend'                   => Backend::class,
                    'frontend'                  => Frontend::class,
                    'user_defined'              => true,
                    'default'                   => null,
                    'searchable'                => true,
                    'filterable'                => true,
                    'comparable'                => true,
                    'visible_on_front'          => true,
                    'used_in_product_listing'   => true,
                    'unique'                    => false,
                    'option'                    => [
                                                        'values'=>
                                                                [
                                                                    'cotton'=> 'Cotton',
                                                                    'linen'=> 'Linen',
                                                                    'silk',
                                                                    'leather',
                                                                    'nylon',
                                                                    'polyester',
                                                                    'velvet'
                                                                ]
                                                    ]
                    
                ]
            );

        } catch (\Exception $e) {
            $this->logger->critical($e);
        }
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function getAliases(): array
    {
        return [];
    }
}
