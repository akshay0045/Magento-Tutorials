<?php
namespace Techsevin\Customerfeedback\Block;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Data\Form\FormKey;
use Magento\Framework\View\Element\Template;
class Index extends Template
{
    protected $formKey;
    public function __construct(Context $context, FormKey $formKey, array $data = [])
    {
        $this->formKey = $formKey;
        parent::__construct($context, $data);
    }
    public function getFormKey()
    {
        return $this->formKey->getFormKey();
    }
}