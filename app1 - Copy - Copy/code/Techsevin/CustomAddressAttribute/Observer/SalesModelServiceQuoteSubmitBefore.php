<?php
namespace Techsevin\CustomAddressAttribute\Observer;

use Magento\Framework\Event\Observer;

class SalesModelServiceQuoteSubmitBefore implements \Magento\Framework\Event\ObserverInterface
{

    /**
     * Execute observer
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
     public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $quote = $observer->getEvent()->getQuote();

        try {
            if ($quote->getBillingAddress()) {
                $order->getBillingAddress()->setCustomAddressType($quote->getBillingAddress()->getCustomAddressType());
            }

            if (!$quote->isVirtual()) {
                $order->getShippingAddress()->setCustomAddressType($quote->getShippingAddress()->getCustomAddressType());
            }
        } catch (\Exception $e) {
            echo "error"; exit;
        }
        return $this;
    }
}