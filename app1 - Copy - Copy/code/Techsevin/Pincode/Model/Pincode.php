<?php
namespace Techsevin\Pincode\Model;

class Pincode extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'shipment_patner_pincode_flat';
	const ENTITY_ID = 'pk_i_id';
	const PINCODE = 'pincode';
	const CITY = 'city';
	const STATE = 'state';
	const COUNTRY = 'country';
	const PREPAID = 'prepaid';
	const COD = 'cod';
	const LOGISTIC_PARTNER = 'logistic_partner';

	protected $_cacheTag = 'shipment_patner_pincode_flat';

	protected $_eventPrefix = 'shipment_patner_pincode_flat';

	protected function _construct()
	{
		$this->_init('Techsevin\Pincode\Model\ResourceModel\Pincode');
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