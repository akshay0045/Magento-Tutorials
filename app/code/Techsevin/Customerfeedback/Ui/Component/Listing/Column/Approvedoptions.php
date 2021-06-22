<?php

namespace Techsevin\Customerfeedback\Ui\Component\Listing\Column;

class Approvedoptions implements \Magento\Framework\Option\ArrayInterface
{
    //Here you can __construct Model

    public function toOptionArray()
    {
        return [
            ['value' => '0', 'label' => __('Not Approved')],
            ['value' => '1', 'label' => __('Approved')],
        ];
    }
}