<?php

namespace Techsevin\ProductAttributes\Model\Attribute\Frontend;

class Brand extends \Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend
{
    public function getValue(\Magento\Framework\DataObject $object)
    {
        $value = ucfirst($object->getData($this->getAttribute()->getAttributeCode()));
        return "<b>$value</b>";
    }
}