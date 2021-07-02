<?php
namespace Techsevin\HelloWorld\Block\Index;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\View\Element\Template;
class Test extends Template
{
	protected $_coreRegistry;
	protected $_bannerFactory;
    public function __construct(
    	Context $context, array $data = [], 
    	\Magento\Framework\Registry $coreRegistry, 
    	\Techsevin\BannerSlider\Model\BannerFactory $bannerFactory)
    {
    	$this->_coreRegistry = $coreRegistry;
    	$this->_bannerFactory = $bannerFactory;
        parent::__construct($context, $data);
    }

    public function getText() 
    {
    	return $this->_coreRegistry->registry('foo');
    }

    public function getBanner() {
    	$groupId = 1;
    	$collection = $this->_bannerFactory->create()->getCollection()->addFieldToFilter(
            'group_id', $groupId
        )->addFieldToFilter(
            'status', \Techsevin\BannerSlider\Model\Banner::STATUS_ENABLED
        )->setOrder('main_table.order', 'ASC');
        return $collection;
    }
    
}