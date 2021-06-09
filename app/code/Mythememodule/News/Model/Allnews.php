<?php
namespace Mythememodule\News\Model;
 
class Allnews extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
        const STATUS_ENABLED = 1;

        const STATUS_DISABLED = 0;

        const CACHE_TAG = 'mythemmodule_news';

        protected $_cacheTag = self::CACHE_TAG;

        protected function _construct()
        {
                $this->_init('Mythememodule\News\Model\ResourceModel\Allnews');
        }
 
        public function getIdentities()
        {
                return [self::CACHE_TAG . '_' . $this->getId()];
        }
 
        public function getDefaultValues()
        {
                $values = [];
 
                return $values;
        }

        public function getsAbailableStatuses() {
                return [self:STATUS_ENABLED => __('Enabled'), self:STATUS_DISABLED => __('Disabled')]

        }
}
?>