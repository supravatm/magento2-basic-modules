define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/additional-validators',
        'SMG_CheckoutValidateBeforePlaceOrder/js/model/validate-rule'
    ],
    function (Component, additionalValidators, validateRule) {
        'use strict';
        additionalValidators.registerValidator(validateRule);
        return Component.extend({});
    }
);