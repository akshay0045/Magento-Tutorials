<?php
namespace Techsevin\Pincode\Model\ResourceModel\Pincode;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'pk_i_id';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Techsevin\Pincode\Model\Pincode', 'Techsevin\Pincode\Model\ResourceModel\Pincode');
	}

}
?>
