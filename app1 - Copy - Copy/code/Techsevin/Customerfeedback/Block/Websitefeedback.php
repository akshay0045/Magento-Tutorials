<?php
namespace Techsevin\Customerfeedback\Block;

use \Magento\Framework\View\Element\Template;

class Websitefeedback extends Template
{
    protected $_customerfeedbackFactory;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Mythememodule\Mymodule\Model\ArticalFactory $articalFactory,
        \Techsevin\Customerfeedback\Model\CustomerfeedbackFactory $customerfeedbackFactory
    ){
        parent::__construct($context);
        $this->_customerfeedbackFactory = $customerfeedbackFactory;
     }

    public function getAllwebsitefeedback() {
        $data = 1;
        $customerfeedbackData = $this->_customerfeedbackFactory->create();
        $collection = $customerfeedbackData->getCollection();
        $collection->addFieldToFilter('is_approved',1);
        return $collection;
    }
}