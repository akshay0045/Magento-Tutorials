var config = {

    mixins: {
        'Magento_Checkout/js/action/set-shipping-information': {
            'Techsevin_CustomAddressAttribute/js/action/set-shipping-information-mixin': true
        }
    },
    map: {
        "*": {
            'Magento_Checkout/js/model/shipping-save-processor/default':
                'Techsevin_CustomAddressAttribute/js/model/shipping-save-processor/payload-extender'
            
        }
    }
};