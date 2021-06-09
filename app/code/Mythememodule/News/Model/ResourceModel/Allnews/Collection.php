<?php
namespace Mythememodule\News\Model\ResourceModel\Allnews;
 
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
        protected $_idFieldName = "news_id";
        protected $_eventPrefix = "news_allnews_collection";
        protected $_eventObject = "allnews_collection";
        /**
         * Define resource model
         *
         * @return void
         */
        protected function _construct()
        {
                $this->_init('Mythememodule\News\Model\Allnews', 'Mythememodule\News\Model\ResourceModel\Allnews');
        }
}
?>