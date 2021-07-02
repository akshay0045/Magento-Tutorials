<?php
namespace Techsevin\CustomAddressAttribute\Plugin;

class ShippingInformationManagementPlugin
{
    protected $quoteRepository;
    protected $subscriberFactory;
    protected $extensionAttributesFactory;
    protected $observer;
    protected $addressRepository;

    public function __construct(
        \Magento\Quote\Model\QuoteRepository $quoteRepository,
        \Magento\Newsletter\Model\SubscriberFactory $subscriberFactory,
        \Magento\Framework\Api\ExtensionAttributesFactory $extensionAttributesFactory,
        \Magento\Framework\Event\Observer $observer
    ) {
        $this->quoteRepository = $quoteRepository;
        $this->subscriberFactory = $subscriberFactory;
        $this->extensionAttributesFactory = $extensionAttributesFactory;
        $this->observer = $observer;
    }

    /**
     * @param \Magento\Checkout\Model\ShippingInformationManagement $subject
     * @param $cartId
     * @param \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
     */
    public function beforeSaveAddressInformation(
        \Magento\Checkout\Model\ShippingInformationManagement $subject,
        $cartId,
        \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
    ) {
        
        $extAttributes = $addressInformation->getExtensionAttributes();   
        
        $shippingAddress = $addressInformation->getShippingAddress();

        if($shippingAddress->getData() != null) {
            if($shippingAddress->getData('save_in_address_book') == 1) {

                $om = \Magento\Framework\App\ObjectManager::getInstance();  
                $customerSession = $om->get('Magento\Customer\Model\Session');  
                $customerId = $customerSession->getCustomer()->getId();
                $addresss = $om->get('\Magento\Customer\Model\AddressFactory');
                $address = $addresss->create();

                $regionId =$shippingAddress->getData('region_id');

                $address->setCustomerId($customerId)

                ->setFirstname($shippingAddress->getData('firstname'))

               ->setLastname($shippingAddress->getData('lastname'))

                ->setCountryId($shippingAddress->getData('country_id'))

                ->setPostcode($shippingAddress->getData('postcode'))

                ->setCity($shippingAddress->getData('city'))

                ->setRegionId($regionId)

                //->setRegion('Gujarat')

                ->setTelephone($shippingAddress->getData('telephone'))

                ->setCompany($shippingAddress->getData('company'))

                ->setStreet($shippingAddress->getData('street'))

                ->setIsDefaultBilling('0')

                ->setIsDefaultShipping('0')

                ->setSaveInAddressBook('1');

                if ($extAttributes) {

                    $address->setCustomAddressType($extAttributes->getCustomAddressType());
                }

                $address->save(); 

                $shippingAddress->setSaveInAddressBook('0');

            }
        }

        $billingAddress = $addressInformation->getBillingAddress();
        
        if ($extAttributes) {
            $quote = $this->quoteRepository->getActive($cartId);
            $customAddressType = $extAttributes->getCustomAddressType();
            $shippingAddress->setCustomAddressType( $customAddressType );
            $billingAddress->setCustomAddressType( $customAddressType );

            $quote->getBillingAddress()->setCustomAddressType( $customAddressType );
            $quote->getShippingAddress()->setCustomAddressType( $customAddressType );
        }
        
        //echo "<pre>"; get_class_methods($this->observer->getEvent()); die();
    }
}