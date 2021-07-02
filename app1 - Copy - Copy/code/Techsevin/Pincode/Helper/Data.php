<?php

namespace Techsevin\Pincode\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var \Techsevin\Pincode\Model\ResourceModel\Pincode\CollectionFactory
     */
    protected $pincodeCollection;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Techsevin\Pincode\Model\ResourceModel\Pincode\CollectionFactory $pincodeCollection
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Techsevin\Pincode\Model\ResourceModel\Pincode\CollectionFactory $pincodeCollection,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    )
    {
        $this->pincodeCollection = $pincodeCollection;
        $this->scopeConfig = $scopeConfig;
        parent::__construct($context);
    }

    /**
     * Get collection of pincode
     */
    public function getCollection()
    {
        return $this->pincodeCollection->create();
    }

    /**
     * Get pincode status
     */
    public function getPincodeStatus($pincode)
    {
        $collection = $this->getCollection();
        $collection->addFieldToFilter('pincode', array('eq' => $pincode));
        
        if($collection->getData()){
            return true;
        }else{
            return false;
        }

    }
    /**
     * Get pincode status message
     */
    public function getMessage($status, $pincode)
    {
        if($status){
            $message = "<h3>".$this->getSuccessMessage()."</h3>";
        }else{
            $message = "<h3 style='color:red'>".$this->getFailMessage()."</h3>";
        }

        return $message;
    }

    /**
     * Get success message config value
     */
    public function getSuccessMessage()
    {
        //return "Pincode Available";
        return $this->scopeConfig->getValue('pincode/general/successmessage', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * Get fail message config value
     */
    public function getFailMessage()
    {
        //return "Pincode not Available";
        return $this->scopeConfig->getValue('pincode/general/failmessage', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
}