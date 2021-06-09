<?php
namespace Mythememodule\News\Model\ResourceModel;
use Magento\Framework\Model\AbstractModel;
class Allnews extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function __construct(\Magento\Framework\Model\ResourceModel\Db\Context $context) {

        parent::__construct($context);
    }
    public function _construct()
    {
        $this->_init('mythemmodule_news', 'news_id');
    }
}