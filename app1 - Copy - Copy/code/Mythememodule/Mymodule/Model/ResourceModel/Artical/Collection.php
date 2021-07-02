<?php
namespace Mythememodule\Mymodule\Model\ResourceModel\Artical;
 
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
        /**
         * Define resource model
         *
         * @return void
         */
        protected function _construct()
        {
                $this->_init('Mythememodule\Mymodule\Model\Artical', 'Mythememodule\Mymodule\Model\ResourceModel\Artical');
        }
}
?>