<?php
namespace Techsevin\CustomAddressAttribute\Plugin;

class ShippingInformationManagementPlugin
{
    protected $quoteRepository;
    protected $subscriberFactory;
    protected $extensionAttributesFactory;
    protected $observer;

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

        //$customAddressType = $extAttributes->getCustomAddressType();

        $shippingAddress = $addressInformation->getShippingAddress();
        
        if ($extAttributes) {
            //$quote = $this->quoteRepository->getActive($cartId);
            $customAddressType = $extAttributes->getCustomAddressType();
            $shippingAddress->setCustomAddressType( $customAddressType );
            //$quote->getBillingAddress()->setCustomAddressType( $customAddressType );
            //$quote->getShippingAddress()->setCustomAddressType( $customAddressType );
        }

        //echo '<pre/>'; print_r($quote->getBillingAddress()->getData()); exit;

    }
}