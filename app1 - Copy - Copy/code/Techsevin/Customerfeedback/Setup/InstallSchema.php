<?php
namespace Techsevin\Customerfeedback\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    protected $setup;
    protected $context;
        
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();
        if (!$installer->tableExists('techsevin_customer_feedback')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('techsevin_customer_feedback')
            )->addColumn(
                'pk_i_id',
                Table::TYPE_INTEGER,
                11,
                ['identity' => true, 'nullable' => false, 'primary' => true],
                null
            )->addColumn(
                'customer_name',
                Table::TYPE_INTEGER,
                11,
                ['nullable' => false],
                null
            )->addColumn(
                'customer_email',
                Table::TYPE_TEXT,
                200,
                ['nullable' => false],
                null
            )->addColumn(
                'customer_phone',
                Table::TYPE_TEXT,
                200,
                ['nullable' => false],
                null
            )->addColumn(
                'customer_subject',
                Table::TYPE_TEXT,
                200,
                ['nullable' => false],
                null
            )->addColumn(
                'customer_message',
                Table::TYPE_TEXT,
                20,
                ['nullable' => false],
                null
            )->addColumn(
                'rating',
                Table::TYPE_TEXT,
                20,
                ['nullable' => false],
                null
            )->setComment(
                'Customer Feedback Table'
            );
            $installer->getConnection()->createtable($table);
        }
        $installer->endSetup();
    }
}