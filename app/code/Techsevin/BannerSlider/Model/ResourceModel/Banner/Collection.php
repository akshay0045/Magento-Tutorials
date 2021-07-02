<?php
namespace Techsevin\BannerSlider\Model\ResourceModel\Banner;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'id';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Techsevin\BannerSlider\Model\Banner', 'Techsevin\BannerSlider\Model\ResourceModel\Banner');
	}

}
?>
