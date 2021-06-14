<?php
namespace Techsevin\Customerfeedback\Model\ResourceModel\Customerfeedback;

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
		$this->_init('Techsevin\Customerfeedback\Model\Customerfeedback', 'Techsevin\Customerfeedback\Model\ResourceModel\Customerfeedback');
	}

}
?>
