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

            $.each(shippingAddress.customAttributes, function (index, eachCustomAttribute) {
                console.log('akshay');
                console.log(eachCustomAttribute);
                if (eachCustomAttribute.attribute_code == 'custom_address_type') {
                    shippingAddress['extension_attributes']['custom_address_type'] = eachCustomAttribute.value;
                }
            });
        });
    };
});