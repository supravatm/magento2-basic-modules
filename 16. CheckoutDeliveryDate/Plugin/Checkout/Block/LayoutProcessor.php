<?php
declare(strict_types=1);

namespace SMG\CheckoutDeliveryDate\Plugin\Checkout\Block;

/**
 * Plugin Checkout Layout Processor
 */
class LayoutProcessor
{
    /**
     * Plugin After Process Layout
     *
     * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $subject
     * @param array $jsLayout
     * @return array
     */
    public function afterProcess(\Magento\Checkout\Block\Checkout\LayoutProcessor $subject, $jsLayout): array
    {
        $attributeCode = 'delivery_date';
        $fieldConfiguration = [
            'component' => 'Magento_Ui/js/form/element/abstract',
            'config' => [
                'customScope' => 'shippingAddress.custom_attributes',
                'customEntry' => null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/date',
                'tooltip' => [
                    'description' => __('Expect Delivery Date'),
                ],
            ],
            'dataScope' => 'shippingAddress.custom_attributes' . '.' . $attributeCode,
            'label' => __('Delivery Date Pick'),
            'provider' => 'checkoutProvider',
            'sortOrder' => 1000,
            'validation' => [
                'required-entry' => false
            ],
            'options' => [],
            'filterBy' => null,
            'customEntry' => null,
            'visible' => true,
            'value' => ''
        ];

        $jsLayout['components']['checkout']['children']
        ['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shipping-address-fieldset']
        ['children']['delivery_date'] = $fieldConfiguration;

        return $jsLayout;
    }
}
