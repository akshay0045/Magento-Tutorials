<?php
namespace Techsevin\Pincode\Setup;

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
        if (!$installer->tableExists('shipment_patner_pincode_flat')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('shipment_patner_pincode_flat')
            )->addColumn(
                'pk_i_id',
                Table::TYPE_INTEGER,
                11,
                ['identity' => true, 'nullable' => false, 'primary' => true],
                null
            )->addColumn(
                'pincode',
                Table::TYPE_INTEGER,
                11,
                ['nullable' => false],
                null
            )->addColumn(
                'city',
                Table::TYPE_TEXT,
                200,
                ['nullable' => false],
                null
            )->addColumn(
                'state',
                Table::TYPE_TEXT,
                200,
                ['nullable' => false],
                null
            )->addColumn(
                'country',
                Table::TYPE_TEXT,
                200,
                ['nullable' => false],
                null
            )->addColumn(
                'prepaid',
                Table::TYPE_TEXT,
                20,
                ['nullable' => false],
                null
            )->addColumn(
                'cod',
                Table::TYPE_TEXT,
                20,
                ['nullable' => false],
                null
            )->addColumn(
                'logistic_partner',
                Table::TYPE_TEXT,
                200,
                ['nullable' => false],
                null
            )->setComment(
                'Shipment Patner Pincode Flat Table'
            );
            $installer->getConnection()->createtable($table);
        }
        $installer->endSetup();
    }
}