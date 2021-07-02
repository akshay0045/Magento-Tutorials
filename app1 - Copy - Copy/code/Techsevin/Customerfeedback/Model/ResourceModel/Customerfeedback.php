<?php
namespace Techsevin\Customerfeedback\Model\ResourceModel;


class Customerfeedback extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
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
		$this->_init('techsevin_customer_feedback', 'pk_i_id');
	}
	
}