<?php

namespace  Techsevin\CustomAddressAttribute\Setup;

use Magento\Customer\Model\Customer;
use Magento\Customer\Setup\CustomerSetup;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class UpgradeData implements  UpgradeDataInterface
{
    private $customerSetupFactory;

    public function __construct(\Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory)
    {
        $this->customerSetupFactory = $customerSetupFactory;
    }
    public function upgrade(ModuleDataSetupInterface $setup,
                            ModuleContextInterface $context){
        $setup->startSetup();

        /** @var CustomerSetup $customerSetup */
        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);
        if (version_compare($context->getVersion(), '1.0.0') < 0) {

                $customerSetup->addAttribute('customer_address', 'custom_address_type', [
                    'label' => 'Custom Address Type',
                    'input' => 'select',
                    'type' => \Magento\Framework\DB\Ddl\Table ::TYPE_TEXT,
                    'source' => '',
                    'required' => false,
                    'position' => 333,
                    'visible' => true,
                    'system' => false,
                    'is_used_in_grid' => false,
                    'is_visible_in_grid' => false,
                    'is_filterable_in_grid' => false,
                    'is_searchable_in_grid' => false,
                    'backend' => '',
                    'option' => ['values' => ['office' => 'Office', 'home' => 'Home']],
                ]);

                $attribute = $customerSetup->getEavConfig()->getAttribute('customer_address', 'custom_address_type')
                    ->addData(['used_in_forms' => [
                        'adminhtml_customer_address',
                        'adminhtml_customer',
                        'customer_address_edit',
                        'customer_register_address',
                        'customer_address',
                    ]]);
                $attribute->save();
            }

            if (version_compare($context->getVersion(), '1.0.2') < 0) {

                $customerSetup->addAttribute('customer_address', 'custom_address_type', [
                    'label' => 'Custom Address Type',
                    'input' => 'select',
                    'type' => \Magento\Framework\DB\Ddl\Table ::TYPE_TEXT,
                    'source' => 'Techsevin\CustomAddressAttribute\Model\Config\Source\Options',
                    'required' => false,
                    'position' => 333,
                    'visible' => true,
                    'system' => false,
                    'is_used_in_grid' => false,
                    'is_visible_in_grid' => false,
                    'is_filterable_in_grid' => false,
                    'is_searchable_in_grid' => false,
                    'backend' => '',
                ]);

                $attribute = $customerSetup->getEavConfig()->getAttribute('customer_address', 'custom_address_type')
                    ->addData(['used_in_forms' => [
                        'adminhtml_customer_address',
                        'adminhtml_customer',
                        'customer_address_edit',
                        'customer_register_address',
                        'customer_address',
                    ]]);
                $attribute->save();
            }

        $setup->endSetup();
    }
}