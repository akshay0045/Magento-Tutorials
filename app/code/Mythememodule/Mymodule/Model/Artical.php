<?php
namespace Mythememodule\Mymodule\Model;
 
class Artical extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
        const CACHE_TAG = 'TESTING_SIMPLE_ARTICAL';
        protected function _construct()
        {
                $this->_init('Mythememodule\Mymodule\Model\ResourceModel\Artical');
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
}
?>