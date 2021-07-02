<?php

namespace Techsevin\Customerfeedback\Setup;

use \Magento\Framework\Setup\UpgradeDataInterface;
use \Magento\Framework\Setup\ModuleContextInterface;
use \Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * Class UpgradeData
 *
 * @package Mythememodule\Mymodule\Setup
 */
class UpgradeData implements UpgradeDataInterface
{

    /**
     * Creates sample articles
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if ($context->getVersion()
            && version_compare($context->getVersion(), '1.0.1') < 0
        ) {
            $tableName = $setup->getTable('techsevin_customer_feedback');

            $data = [
                [
                    "customer_name" => "Akshay Shah",
    				"customer_email" => "akshay.shah@techsevin.com",
                    "customer_phone" => "3265987895",
                    "customer_subject" => "Test Subject",
                    "customer_message" => "Test message",
                    "rating" => "Good"
                ]

            ];

            $setup
                ->getConnection()
                ->insertMultiple($tableName, $data);
        }

        if (version_compare($context->getVersion(), '1.0.4', '<')) {
            $setup->getConnection()->changeColumn(
                $setup->getTable('techsevin_customer_feedback'),
                'customer_name',
                'customer_name',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 11,
                    'comment' => 'Customer Name',
                    'nullable' => false
                ]
            );
        }
        $setup->endSetup();
    }
}