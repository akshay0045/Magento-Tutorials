<?php

namespace Techsevin\Pincode\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
 
class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        if (version_compare($context->getVersion(), '1.0.1') < 0) {
            $setup->startSetup();
            $setup->getConnection()->addColumn(
                $setup->getTable('shipment_patner_pincode_flat'),
                'region_id',
                ['type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                'length' => '11',
                'nullable' => false,
                'default' => '0',
                'comment' => 'Region Id']
            );
            $setup->endSetup();
        }
    }
}

?>