<?php
namespace Techsevin\Customerfeedback\Setup;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context){
        if (version_compare($context->getVersion(), '1.0.5') < 0) {
            $connection = $setup->getConnection();
            $connection->addColumn(
                $setup->getTable('techsevin_customer_feedback'),
                'image',
                [
                    'type' => Table::TYPE_TEXT,
                    'length' => 255,
                    'nullable' => true,
                    'default' => '',
                    'comment' => 'Image'
                ]
            );
            $connection->addColumn(
                $setup->getTable('techsevin_customer_feedback'),
                'is_approved',
                [
                    'type' => Table::TYPE_BOOLEAN,
                    'nullable' => false,
                    'unsigned' => true,
                    'default' => '0',
                    'comment' => 'is_approved'
                ]
            );
        }
    }
}