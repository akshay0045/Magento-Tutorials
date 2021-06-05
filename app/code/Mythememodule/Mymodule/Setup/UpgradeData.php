<?php

namespace Mythememodule\Mymodule\Setup;

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
            && version_compare($context->getVersion(), '1.1.5') < 0
        ) {
            $tableName = $setup->getTable('mythemmodule_article');

            $data = [
                [
                    "article_subject" => "sunt aut facere repellat provident occaecati excepturi optio reprehenderit",
    				"content" => "quia et suscipit\nsuscipit recusandae consequuntur expedita et cum\nreprehenderit molestiae ut ut quas totam\nnostrum rerum est autem sunt rem eveniet architecto",
                ],
                [
                    "article_subject" => "qui est esse",
    				"content" => "est rerum tempore vitae\nsequi sint nihil reprehenderit dolor beatae ea dolores neque\nfugiat blanditiis voluptate porro vel nihil molestiae ut reiciendis\nqui aperiam non debitis possimus qui neque nisi nulla",
                ],
                [
                    "article_subject" => "ea molestias quasi exercitationem repellat qui ipsa sit aut",
    				"content" => "et iusto sed quo iure\nvoluptatem occaecati omnis eligendi aut ad\nvoluptatem doloribus vel accusantium quis pariatur\nmolestiae porro eius odio et labore et velit aut",
                ],
                [
                    "article_subject" => "eum et est occaecati",
    				"content" => "ullam et saepe reiciendis voluptatem adipisci\nsit amet autem assumenda provident rerum culpa\nquis hic commodi nesciunt rem tenetur doloremque ipsam iure\nquis sunt voluptatem rerum illo velit",
                ],
                [
                    "article_subject" => "nesciunt quas odio",
    				"content" => "repudiandae veniam quaerat sunt sed\nalias aut fugiat sit autem sed est\nvoluptatem omnis possimus esse voluptatibus quis\nest aut tenetur dolor neque",
                ],
                [
                    "article_subject" => "dolorem eum magni eos aperiam quia",
    				"content" => "ut aspernatur corporis harum nihil quis provident sequi\nmollitia nobis aliquid molestiae\nperspiciatis et ea nemo ab reprehenderit accusantium quas\nvoluptate dolores velit et doloremque molestiae",
                ],
                [
                    "article_subject" => "magnam facilis autem",
    				"content" => "dolore placeat quibusdam ea quo vitae\nmagni quis enim qui quis quo nemo aut saepe\nquidem repellat excepturi ut quia\nsunt ut sequi eos ea sed quas",
                ],
                [
                    "article_subject" => "dolorem dolore est ipsam",
    				"content" => "dignissimos aperiam dolorem qui eum\nfacilis quibusdam animi sint suscipit qui sint possimus cum\nquaerat magni maiores excepturi\nipsam ut commodi dolor voluptatum modi aut vitae",
                ],

            ];

            $setup
                ->getConnection()
                ->insertMultiple($tableName, $data);
        }

        if (version_compare($context->getVersion(), '1.1.4', '<')) {
            $setup->getConnection()->changeColumn(
                $setup->getTable('mythemmodule_article'),
                'article_title',
                'article_subject',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'comment' => 'Artical Title',
                    'nullable' => false
                ]
            );
        }

        $setup->endSetup();
    }
}