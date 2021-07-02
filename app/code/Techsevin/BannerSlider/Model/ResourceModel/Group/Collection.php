<?php
namespace Techsevin\BannerSlider\Model\ResourceModel\Group;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Techsevin\BannerSlider\Model\Group', 'Techsevin\BannerSlider\Model\ResourceModel\Group');
    }
}