<?php
namespace Techsevin\BannerSlider\Model\ResourceModel;

class Group extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('techsevin_banners_slider_group', 'id');
    }
}