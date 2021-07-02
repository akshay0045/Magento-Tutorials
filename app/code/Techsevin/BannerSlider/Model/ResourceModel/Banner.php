<?php
namespace Techsevin\BannerSlider\Model\ResourceModel;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\App\ObjectManager;
use Techsevin\BannerSlider\Model\Banner\ImageUploader;

class Banner extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * ImageUploader
     *
     * @var \Techsevin\BannerSlider\Model\Banner\ImageUploader
     */
    protected $_imageUploader;

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('techsevin_banners_slider', 'id');
    }
}