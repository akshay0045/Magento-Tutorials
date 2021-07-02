<?php

namespace Techsevin\HelloWorld\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\Registry;

class Custom implements ArgumentInterface
{
    protected $_coreRegistry;
    protected $_bannerFactory;

    public function __construct(
        Registry $coreRegistry,
        \Techsevin\BannerSlider\Model\BannerFactory $bannerFactory
    ) {
        $this->_coreRegistry = $coreRegistry;
        $this->_bannerFactory = $bannerFactory;
    }

    public function getText()
    {
        return $this->_coreRegistry->registry('foo');
    }

    public function getBanner()
    {
        $groupId = 1;
        $collection = $this->_bannerFactory->create()->getCollection()->addFieldToFilter(
            'group_id',
            $groupId
        )->addFieldToFilter(
            'status',
            \Techsevin\BannerSlider\Model\Banner::STATUS_ENABLED
        )->setOrder('main_table.order', 'ASC');
        return $collection;
    }
}