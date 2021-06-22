<?php

namespace Techsevin\CustomAddressAttribute\Plugin;

use Magento\Checkout\Block\Checkout\LayoutProcessor;

class CustomAddresstypePlugin
{
    public function afterProcess(LayoutProcessor $subject, $jsLayout) {
        $customAttributeCode = 'custom_address_type';
        $customField = [
            'component' => 'Magento_Ui/js/form/element/select',
            'config' => [
                // customScope is used to group elements within a single form (e.g. they can be validated separately)
                'customScope' => 'shippingAddress.custom_attributes',
                'customEntry' => null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/select',
                'tooltip' => [
                    'description' => 'Custom Address Type',
                ],
            ],
            'dataScope' => 'shippingAddress.custom_attributes' . '.' . $customAttributeCode,
            'label' => 'Custom Address Type',
            'provider' => 'checkoutProvider',
            'sortOrder' => 0,
            'validation' => [
                'required-entry' => true
            ],
            'options' => [
                [
                    'value' => 'home',
                    'label' => 'Home',
                ],
                [
                    'value' => 'office',
                    'label' => 'Office',
                ]
            ],
            'filterBy' => null,
            'customEntry' => null,
            'visible' => true,
        ];

        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']['shippingAddress']['children']['shipping-address-fieldset']['children'][$customAttributeCode] = $customField;

        return $jsLayout;
    }
}