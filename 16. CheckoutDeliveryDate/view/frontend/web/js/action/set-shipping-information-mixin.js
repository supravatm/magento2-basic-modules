/*jshint browser:true jquery:true*/
/*global alert*/
define([
    'jquery',
    'mage/utils/wrapper',
    'Magento_Checkout/js/model/quote'
], function ($, wrapper, quote) {
    'use strict';

    return function (setShippingInformationAction) {
        return wrapper.wrap(setShippingInformationAction, function (originalAction) {
            var shippingAddress = quote.shippingAddress();
            if (shippingAddress['extension_attributes'] === undefined) {
                shippingAddress['extension_attributes'] = {};
            }
            if (shippingAddress.customAttributes !== undefined) {
                shippingAddress['extension_attributes'] = {};
                var attribute = shippingAddress.customAttributes.find(
                    function (element) {
                        return element.attribute_code === 'delivery_date';
                    }
                );
            }
            console.log("Start");
            console.dir(quote);
            console.log("End");
            if (attribute !== undefined) {
                shippingAddress['extension_attributes']['delivery_date'] = attribute.value;
            }         
            // pass execution to original action ('Magento_Checkout/js/action/set-shipping-information')
            return originalAction();
        });
    };
});
