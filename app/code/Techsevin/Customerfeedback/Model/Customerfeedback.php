<?php

namespace Techsevin\Customerfeedback\Model;

use Techsevin\Customerfeedback\Model\Customerfeedback\FileInfo;
use Magento\Framework\App\ObjectManager;
use Magento\Store\Model\StoreManagerInterface;

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
	protected $_storeManager;
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

	public function getEntityId()
	{
		return $this->getData(self::ENTITY_ID);
	}

	/**
	 * Retrieve the Image URL
	 *
	 * @param string $imageName
	 * @return bool|string
	 * @throws \Magento\Framework\Exception\LocalizedException
	 */
	public function getImageUrl($imageName = null)
	{
		$url = '';
		$image = $imageName;
		if (!$image) {
			$image = $this->getData('image');
		}
		if ($image) {
			if (is_string($image)) {
				$url = $this->_getStoreManager()->getStore()->getBaseUrl(
					\Magento\Framework\UrlInterface::URL_TYPE_MEDIA
				) . '/' . $image;
			} else {
				throw new \Magento\Framework\Exception\LocalizedException(
					__('Something went wrong while getting the image url.')
				);
			}
		}
		return $url;
	}

	/**
	 * Get StoreManagerInterface instance
	 *
	 * @return StoreManagerInterface
	 */
	private function _getStoreManager()
	{
		if ($this->_storeManager === null) {
			$this->_storeManager = ObjectManager::getInstance()->get(StoreManagerInterface::class);
		}
		return $this->_storeManager;
	}
}
