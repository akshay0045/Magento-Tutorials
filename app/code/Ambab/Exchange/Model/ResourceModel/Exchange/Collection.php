<?php
/**
 * @category   Ambab
 * @package    Ambab_Exchange
 * @author     letsdevelophp@gmail.com
 * @copyright  This file was generated by using Module Creator(http://code.vky.co.in/magento-2-module-creator/) provided by VKY <viky.031290@gmail.com>
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Ambab\Exchange\Model\ResourceModel\Exchange;
 
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'exchange_id';
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
            'Ambab\Exchange\Model\Exchange',
            'Ambab\Exchange\Model\ResourceModel\Exchange'
        );
    }
}