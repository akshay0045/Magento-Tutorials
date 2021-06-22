<?php
namespace Techsevin\CustomAddressAttribute\Observer;

use Magento\Framework\Event\Observer;

class ModelServiceQuoteSubmitSuccess implements \Magento\Framework\Event\ObserverInterface
{

    /**
     * Execute observer
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
     public function execute(Observer $observer)
    {

        /** @var \Magento\Quote\Model\Quote $quote */
        $quote = $observer->getEvent()->getQuote();
        $order =  $observer->getEvent()->getOrder();

        if (!$quote->getId() || !$order->getId()) {
            return $this;
        }


        try {
            if ($quote->getBillingAddress()) {
                $order->getBillingAddress()->setCustomAddressType($quote->getBillingAddress()->getCustomAddressType());
            }

            if (!$quote->isVirtual()) {
                $order->getShippingAddress()->setCustomAddressType($quote->getShippingAddress()->getCustomAddressType());
            }
        } catch (\Exception $e) {
            // add logger
        }
        return $this;
    }
}