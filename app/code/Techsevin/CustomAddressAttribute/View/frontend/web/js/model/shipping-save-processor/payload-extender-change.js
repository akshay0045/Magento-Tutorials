define(['jquery'], function ($) {
    'use strict';

    return function (payload) {
        var customAddressType = $('[name="custom_attributes[custom_address_type]"]').val();
        var shippingAddress = payload.addressInformation.shipping_address;
        console.log(shippingAddress);
        console.log(customAddressType);
        console.log(shippingAddress.customAttributes[0].value);

        //if (customAddressType == "" || customAddressType == null) {
            if (shippingAddress.customAttributes == "undefined" || shippingAddress.customAttributes == null) {
                customAddressType = null;
            } else {
                if (shippingAddress.customAttributes[0].value == "undefined" || shippingAddress.customAttributes[0].value == null) {
                    customAddressType = null;
                } else {
                    customAddressType = shippingAddress.customAttributes[0].value;
                }
            }
        //}
        payload.addressInformation['extension_attributes'] = {
            'custom_address_type': customAddressType
        };

        return payload;
    };
});