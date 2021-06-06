<?php

namespace Mythememodule\News\Setup;

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
    protected $date;
 
    public function __construct(
        \Magento\Framework\Stdlib\DateTime\DateTime $date
    ) {
        $this->date = $date;
    }

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
            && version_compare($context->getVersion(), '1.1.1') < 0
        ) {
            $tableName = $setup->getTable('mythemmodule_news');

            $data = [
                [
                    'title' => 'News Title 1',
                    'description' => 'Here is write news description 1',
                    'status' => 1,
                    'updated_at' => $this->date->date(),
                    'created_at' => $this->date->date()
                ],
                [
                    'title' => 'News Title 2',
                    'description' => 'Here is write news description 2',
                    'status' => 1,
                    'updated_at' => $this->date->date(),
                    'created_at' => $this->date->date()
                ]
            ];

            $setup
                ->getConnection()
                ->insertMultiple($tableName, $data);
        }

        $setup->endSetup();
    }
}