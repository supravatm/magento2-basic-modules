/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

define([], function () {
    'use strict';
    
    return {
        /**
         * @return {Object}
         */
        getRules: function () {
            return {
                'postcode': {
                    'required': true
                },
                'city': {
                    'required': true
                },
                'country_id': {
                    'required': true
                },
                'telephone': {
                    'required': true
                }
            };
        }
    };
});
