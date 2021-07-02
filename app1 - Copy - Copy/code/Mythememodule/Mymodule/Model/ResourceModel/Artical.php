<?php
namespace Mythememodule\Mymodule\Model\ResourceModel;

class Artical extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function _construct()
    {
        $this->_init('mythemmodule_article', 'article_id');
    }
}