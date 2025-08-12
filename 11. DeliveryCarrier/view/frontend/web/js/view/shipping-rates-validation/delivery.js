/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    'uiComponent',
    'Magento_Checkout/js/model/shipping-rates-validator',
    'Magento_Checkout/js/model/shipping-rates-validation-rules',
    '../../model/shipping-rates-validator',
    '../../model/shipping-rates-validation-rules'
], function (
    Component,
    defaultShippingRatesValidator,
    defaultShippingRatesValidationRules,
    customShippingRatesValidator,
    customShippingRatesValidationRules
) {
    'use strict';
    
    defaultShippingRatesValidationRules.registerRules('delivery', customShippingRatesValidationRules);
    defaultShippingRatesValidator.registerValidator('delivery', customShippingRatesValidator);

    return Component;
});
