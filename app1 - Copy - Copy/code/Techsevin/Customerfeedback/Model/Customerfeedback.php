<?php
namespace Techsevin\Customerfeedback\Model;

class Customerfeedback extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = ' techsevin_customer_feedback';
	const ENTITY_ID = 'pk_i_id';
	const PINCODE = 'customer_name';
	const CITY = 'customer_email';
	const STATE = 'customer_phone';
	const COUNTRY = 'customer_subject';
	const PREPAID = 'customer_message';
	const rating = 'cod';

	protected $_cacheTag = ' techsevin_customer_feedback';

	protected $_eventPrefix = ' techsevin_customer_feedback';

	protected function _construct()
	{
		$this->_init('Techsevin\Customerfeedback\Model\ResourceModel\Customerfeedback');
	}

	public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}

	public function getDefaultValues()
	{
		$values = [];

		return $values;
	}

	public function getEntityId() {
		return $this->getData(self::ENTITY_ID);
	}
}