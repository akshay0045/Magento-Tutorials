<?php
namespace Techsevin\CustomAddressAttribute\Observer;

use Magento\Framework\Event\Observer;
use \Magento\Checkout\Model\Session as CheckoutSession;
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
            echo "<pre>"; print_r($quote->getId()); die("dead");
            // add logger
        }
        //return $this;
    }
}