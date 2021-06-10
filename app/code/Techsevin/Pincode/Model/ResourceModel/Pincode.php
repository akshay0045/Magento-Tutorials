<?php
namespace Techsevin\Pincode\Model\ResourceModel;


class Pincode extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	protected $_idFieldName = 'pk_i_id';
	protected $_date;

	public function __construct(
		\Magento\Framework\Model\ResourceModel\Db\Context $context,
		\Magento\Framework\Stdlib\DateTime\DateTime $date,
		$resourcePrefix = null
	)
	{
		parent::__construct($context, $resourcePrefix);
		$this->_date = $date;
	}
	
	protected function _construct()
	{
		$this->_init('shipment_patner_pincode_flat', 'pk_i_id');
	}
	
}