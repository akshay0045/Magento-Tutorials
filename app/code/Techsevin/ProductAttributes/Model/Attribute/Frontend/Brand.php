<?php

namespace Techsevin\ProductAttributes\Model\Attribute\Frontend;

class Brand extends \Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend
{
    /**
     * @var \Techsevin\ProductAttributes\Model\Attribute\Source\Brand
     */
    private $brandList;

    /**
     * Init
     * @param \Techsevin\ProductAttributes\Model\Attribute\Source\Brand $brandList
     */
    public function __construct(\Techsevin\ProductAttributes\Model\Attribute\Source\Brand $brandList)
    {
        $this->brandList = $brandList;
    }

    public function getValue(\Magento\Framework\DataObject $object)
    {
        $value = $object->getData($this->getAttribute()->getAttributeCode());

        $brandLable = '';

        foreach ($this->brandList->getAllBrand() as $key => $brand) {
            if ($value == $key) {
                $brandLable = $brand;
            }
        }

        return "<b>$brandLable</b>";
    }
}